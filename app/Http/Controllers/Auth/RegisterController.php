<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Egulias\EmailValidator\EmailValidator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Mail\EmailVerification;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            // 'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verify_token' => base64_encode($data['email']),
            'role' => 'member',
        ]);

        $url = URL::temporarySignedRoute(
            'register.showform',
            now()->addMinutes(10),
            [
                'token' => $user->email_verify_token,
                'user' => $user->id
            ]
        );

        $email = new EmailVerification($user, $url);
        Mail::to($user->email)->send($email);

        return $user; 
    }

    public function register(Request $request)
    {
        event(new Registered($user = $this->create(
            $request->all()
        )));

        return view('auth.registered');
    }

    /**
     * Create a again user instance after a valid registration.
     *
     * @param  user_id
     * @return \App\User
     */
    protected function CreateAgain($data)
    {
        $user = User::find($data);
        if (isset($user)) {
        $url = URL::temporarySignedRoute(
            'register.showform',
            now()->addMinutes(10),
            [
                'token' => $user->email_verify_token,
                'user' => $user->id
            ]
            );
        } else {
            $user = null;
            return  $user;
        }

        $email = new EmailVerification($user, $url);
        Mail::to($user->email)->send($email);

        return $user;
    }

    public function RegisterAgain( $user_id )
    {
        event(new Registered($user = $this->CreateAgain(
            $user_id
        )));

        $register_view = $user? 'auth.registered_again': 'auth.registered_not';
        return view( $register_view );
    } 
    /**
     * 仮登録の確認画面表示
     *
     * 
     * @return \views\auth\register_check.blade
     */
    public function pre_check(Request $request)
    {
        $this->validator($request->all())->validate();
        //flash data
        $request->flashOnly('email');

        $bridge_request = $request->all();
        // password マスキング
        $bridge_request['password_mask'] = '******';

        return view('auth.register_check')->with($bridge_request);
    }

    /**
     * 本登録ファーム表示
     *
     * 
     * @return \views\auth\auth.main.register
     */
    public function showForm(Request $request)
    {
        $email_token = $request->token;
        $user_id = $request->user;
        
        //時間判定
        if ( !$request->hasValidSignature() ) {
            return view('auth.main.register', compact('user_id'))->with('message', 'URLの有効期限が無効です。');
        };
        // 使用可能なトークンか
        if (!User::where('email_verify_token', $email_token)->exists()) {
            return view('auth.main.register')->with('message', '無効なトークンです。');
        } else {
            $user = User::where('email_verify_token', $email_token)->first();
            // 本登録済みユーザーか
            if ($user->status == config('const.USER_STATUS.REGISTER')) //REGISTER=1
            {
                logger("status" . $user->status);
                return view('auth.main.register')->with('message', 'すでに本登録されています。ログインして利用してください。');
            }
            // ユーザーステータス更新
            $user->status = config('const.USER_STATUS.MAIL_AUTHED');
            if ($user->save()) {
                return view('auth.main.register', compact('email_token'));
            } else {
                return view('auth.main.register')->with('message', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
            }
        }
    }

    /**
     * 本登録確認表示
     *
     * 
     * @return \views\auth\auth.main.register_check
     */
    public function mainCheck(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'name_pronunciation' => 'required|string',
        ]);
        //データ保持用
        $email_token = $request->email_token;

        $user = new User();
        $user->name = $request->name;
        $user->name_pronunciation = $request->name_pronunciation;

        return view('auth.main.register_check', compact('user', 'email_token'));
    }

    /**
     * 本登録
     *
     * 
     * @return \views\auth\auth.main.registered
     */
    public function mainRegister(Request $request)
    {
        $user = User::where('email_verify_token', $request->email_token)->first();
        $user->status = config('const.USER_STATUS.REGISTER');
        $user->name = $request->name;
        $user->name_pronunciation = $request->name_pronunciation;
        $user->save();

        return view('auth.main.registered');
    }
}
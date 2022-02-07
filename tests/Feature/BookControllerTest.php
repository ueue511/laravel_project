<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions; //テスト用seeder 終わったら削除
use Illuminate\Http\UploadedFile;

use App\User;
use App\Book;

class BookControllerTest extends TestCase
{
    // use DatabaseTransactions; //テスト用seeder 終わったら削除
    /**
     * テスト前の準備作業
     *
     * @access  public
     * @return  void
     */
    public function setUp(): void
    {
        $_SERVER['HTTP_HOST']   = 'localhost:8000';
        $_SERVER['REQUEST_URI'] = '/';

        parent::setUp();
        // $this->seed(['TagTableSeeder', 'BooksTableSeeder']);

        $this->user = User::find(49);
        
        // テスト用ユーザーの生成
        // $this->user=User::create([
        //     'name' => 'testTaro',
        //     'email' => 'example777@mail.com',
        //     'password' => "testPass",
        // ]);
        // $this->user->update([
        //     'role' => 'admin'
        // ]);
        
    }
    
    /**
     * db booksにある item_name: 'あかさたな'表示で成功 2_assert
     *
     * @return void
     * @test
     */
    public function BookShowのuserに関係するbookの取得()
    {
        $response = $this
            ->actingAs($this->user)
            ->get( route( 'top.contact' ));
        $response
            ->assertStatus(200)
            ->assertSee( 'あかさたな' );
    }

    /**
     * 本の一覧表示
     * session（message）別に通れば成功 8_assert
     * @test
     * @dataProvider RakutenInputData
     * Bookcontroller BookShow
     */
    public function BookShow_redirect時の条件分岐( $params ) 
    {
        // 新規登録
        $response = $this
            ->actingAs( $this->user )
            ->withSession(['message_id' => 'create'])
            ->get( route('top.contact') );
        $response
            ->assertStatus( 200 )
            ->assertSessionHas( 'message', '新規登録' );

        // 記述ミス
        $response = $this
            ->actingAs( $this->user )
            ->withSession( ['message_id' => 'danger'] )
            ->get(route( 'top.contact' ));
        $response
            ->assertStatus( 200 )
            ->assertSessionHas( 'message', '記述に誤りがあります' );
        
        // 削除
        $response = $this
            ->actingAs( $this->user )
            ->withSession(['message_id' => 'delete'])
            ->get(route( 'top.contact' ));
        $response
            ->assertStatus( 200 )
            ->assertSessionHas( 'message', '削除しました' );
        
        // 楽天APIでの入力処理 memo:_old_inputがない場合、500エラー
        $response = $this
            ->actingAs( $this->user )
            ->withSession([
                'message_id' => 'rakuten',
                '_old_input' => [
                    'item_img'  => $params['requestData']['item_img'],
                    'item_name' => $params['requestData']['item_name'],
                    'item_url'  => $params['requestData']['url']
                ]
            ])
            ->get(route( 'top.contact' ));
        $response
            ->assertStatus( 200 )
            ->assertSessionHas( 'message', 'tagを選択してください' );
    }

    /**
     * 本の新規追加
     *DBに保存できたら成功 8_assert
     * @test
     * @dataProvider BookCreateData
     * Bookcontroller BookCreate
     */
    public function BookCreateDBとCloudinaryの保存確認( $params )
    {
        $response = $this
            ->actingAs( $this->user)
            ->post( route( 'new_contact' ), $params['formData'] );
        $response
            ->assertStatus( 302 )
            ->assertRedirect( '/admin' ); 
        
    }
/*
|--------------------------------------------------------------------------
|  DataProvider
|--------------------------------------------------------------------------
*/
    public function RakutenInputData()
    {
        return [
            'inputdata' => [
                [
                    'requestData' => [
                        'item_img'  => 'https://www.mertz.com/',
                        'item_name' => 'testbook',
                        'url'       => 'https://www.kshlerin.com/',
                    ],
                ]
            ]
        ];
    }
    public function BookCreateData()
    {
        return [
            'inputdata' => [
                [
                    'formData' => [
                        'user_id'     => $this->user->id,
                        'item_name'   => '詳細 PHP 8+MySQL 入門ノート XAMPP+MAMP対応',
                        'book_tag'    => ['3', '4'],
                        'item_amount' => 3520,
                        'published'   => '2021-07-05',
                        'item_url'    => 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet',
                        'item_img'    => UploadedFile::fake()->image('design.jpg'), 
                    ],
                ]
            ]
        ];
    }
}
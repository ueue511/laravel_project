<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * book_user_good使用
     */
    public function GoodsBooks()
    {
        return $this->belongsToMany( 'App\Book', 'book_user_good' )->withTimestamps();
    }

    /**
     * book_user_pet使用
     */
    public function PetsBooks()
    {
        return $this->belongsToMany( 'App\Book', 'book_user_pet' )->withTimestamps();
    }

    /**
     * book_user_comment使用
     */
    // public function CommentsBooks()
    // {
    //     return $this->belongsToMany( 'App\Book', 'book_user_comment' )->withPivot( 'comment' );
    // }

    /**
     * comment使用
     */
    public function comments()
    {
        return $this->morphToMany('App\Comment', 'commentables');
    }
}
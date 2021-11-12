<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'item_name', 
        'comment', 
        'item_amount', 
        'item_img', 
        'published'
    ];
    
    /**
     * book_tag使用
     */
    public function Tags()
    {
        return $this->belongsToMany( Tag::class )->withTimestamps();
    }

    /**
     * book_user_good使用
     */
    public function GoodsUsers()
    {
        return $this->belongsToMany( 'App\User', 'book_user_good')->withTimestamps();
    }

    /**
     * book_user_pet使用
     */
    public function PetsUsers()
    {
        return $this->belongsToMany( 'App\User', 'book_user_pet')->withTimestamps();
    }

    /**
     * book_user_comment使用
     */
    public function CommentsUsers()
    {
        return $this->belongsToMany( 'App\User', 'book_user_comment')->withTimestamps();
    }
}
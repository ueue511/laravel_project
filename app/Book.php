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
     * comment使用
     */
    public function Comments()
    {
        return $this->morphToMany( 'App\Comment', 'commentables' );
    }

    /**
     * scope
     */

    // Book読み込み
    public function scopeReadDB( $query ) 
    {
        return $query->with(['comments', 'tags', 'petsusers', 'goodsusers']);
    }
    
    // tag 
    public function scopeWhereHasTag( $query, $tagbook ) 
    {
        return $query->whereHas( 'tags',
            function ( $query ) use ( $tagbook ) 
            {
                return $query->where('tags.id', $tagbook);
            }
        );
    }
    
    // お気に入り
    public function scopeWhereHasLike( $query, $user ) 
    {
        return $query->whereHas( 'goodsusers',
            function ( $query ) use ( $user ) 
            {
                return $query->where('user_id', $user);
            }
        );
    }

    // いいねボタン
    public function scopeWhereHasGood( $query, $user )
    {
        return $query->whereHas( 'petsusers',
            function ( $query ) use ( $user ) {
                return $query->where( 'user_id', $user );
            }
        );
    }
    
    // タイトル
    public function scopeWhereTitle( $query, $titlebook )
    {
        return $query->where( 'item_name', 'like', '%'.$titlebook.'%' );
    }
}
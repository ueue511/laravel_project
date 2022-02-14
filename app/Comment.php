<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'editor_id',
        'editor_type'
    ];

    protected $casts = [
        'comment' => 'json',
        'editor_id' => 'json',
        'editor_type' => 'json'
    ];

    
    /**
     * Book使用
     */
    public function Books()
    {
        return $this->morphedByMany('App\Book', 'commentables');
    }

    /**
     * user使用
     */
    public function Users()
    {
        return $this->morphedByMany('App\User', 'commentables');
    }
}
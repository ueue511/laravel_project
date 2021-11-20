<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment'
    ];
    /**
     * Book使用
     */
    public function Books()
    {
        return $this->morphedByMany('App\book', 'commentables');
    }

    /**
     * user使用
     */
    public function Users()
    {
        return $this->morphedByMany('App\user', 'commentables');
    }
}
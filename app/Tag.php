<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'tab',
    ];

    public function Books()
    {
        return $this->belongsToMany( Book::class )->withTimestamps();
    }

    // public function Comments()
    // {
    //     return $this
    //         ->with( 'Books' )
    //         ->where('id', '1');
    // }
}
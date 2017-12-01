<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
	protected $fillable = [
        'user_id',
        'post_id',
        'isLike'
        // add all other fields
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'likes';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Notes');
    }
}

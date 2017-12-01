<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $fillable = [
        'title',
        'text',
        'user_id',
        'for_id',
        'deadline',
        // add all other fields
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'notes';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Likes');
    }    

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }   
}

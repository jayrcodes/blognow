<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    public static $rules = array(
        'title' => 'required',                      
        'message' => 'required'
    );

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

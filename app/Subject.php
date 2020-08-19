<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table="subjects";


    public function getMessages()
    {
        return $this->hasMany('App\Message');
    }
}

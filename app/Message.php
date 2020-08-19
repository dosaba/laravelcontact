<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table="messages";
    protected $fillable=["body","fromName","toEmail","fromEmail","subjectId","spamScore"];



    public function getSubject()
    {

        return $this->belongsTo('App\Subject', 'subjectId', 'id');
    }
}

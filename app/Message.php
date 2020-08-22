<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {
    protected $fillable = [
        'teacher_id ', 'student_id' ,'lesson_id','messagestudent','dateteacher','timestudent','studentread'
    ];
    public $timestamps = false;
    protected $guarded = [];

}

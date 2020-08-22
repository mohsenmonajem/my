<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function teacher()
    {

        return $this->belongstoMany(Teacher::class);
    }
    public function lesson()
    {

        return $this->belongstoMany(Lesson::class);
    }
    public function student()
    {
        return $this->belongstoMany(Student::class);
    }
    protected $fillable = [
        'address', 'id','startdate','enddate','capacity','cost'
    ];
    public $timestamps = false;


}

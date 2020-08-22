<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded=[];
    public function teacher()
    {
       return $this->belongsToMany(Teacher::class);
    }
    public $timestamps = false;
    protected $fillable = [
        'id ', 'namedars','payenumber'
    ];
    public function room()
    {

        return $this->belongsToMany(Room::class);

    }
}

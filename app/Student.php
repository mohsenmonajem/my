<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function user()
    {

        return $this->belongsTo(User::class);

    }
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'id'
    ];
    public function room()
    {

        return $this->belongsToMany(Room::class);

    }

}

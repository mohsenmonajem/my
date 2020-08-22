<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Teacher extends Model
{
    public function user()
    {

        return $this->belongsTo(User::class);

    }
    public function lesson()
    {
       return $this->belongsToMany(Lesson::class);
    }
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'id'
    ];
    public function room()
    {

        return $this->belongsToMany(Room::class);

    }
    use Notifiable;
}

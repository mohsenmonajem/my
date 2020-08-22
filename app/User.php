<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'password','family','role','username','image'
    ];
    public function student()
    {
        return $this->hasOne(Student::class);

    }
    public function teacher()
    {
        return $this->hasOne(Teacher::class);

    }
}

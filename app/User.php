<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Message;
use App\Note;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password']=bcrypt($password);
    }

    public function roles(){

        return $this->belongsToMany(Role::class,'assigned_roles');
    }

    public function hasRole(array $roles)
    {
        //Vemos si el array de usuarios es igual al que se pasa por parametro
        return $this->roles->pluck('key')->intersect($roles)->count();
    }

    public function isAdmin()
    {
        return $this->hasRole(['admin']);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function note()
    {
        return $this->morphOne(Note::class,'notable');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable')->withTimestamps();
    }

}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable=['name_tag'];

    public function messages()
    {

        return $this->morphByMany(Message::class,'taggable');
    }
    public function users()
    {

        return $this->morphByMany(User::class,'taggable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public function notes(){
        //muitas notas por um usuario
       return $this->hasMany(Note::class);
    }

}

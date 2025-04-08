<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function user(){
        //unico user por muitas notas
        return $this->belongsTo(User::class);
    }
}

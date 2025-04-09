<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function user(){

        //lado de muitos para um do relacionamento
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{

    use SoftDeletes;

    public function user(){

        //lado de muitos para um do relacionamento
        return $this->belongsTo(User::class);
    }
}

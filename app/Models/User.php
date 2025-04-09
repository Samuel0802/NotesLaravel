<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public function notes(){
        // um para muitos
       return $this->hasMany(Note::class);
    }

}

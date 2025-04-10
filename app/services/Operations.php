<?php


namespace App\services;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


Class Operations
{
  //Criação de metodos descriptando o id da nota
    public static function decryptId($value){

        try {
            $value = Crypt::decrypt($value);

          } catch (DecryptException $e) {

              return redirect()->route('home');
          }

          return $value;
    }

}

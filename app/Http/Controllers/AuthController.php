<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(){
     return view('login');
    }

    public function loginSubmit(Request $request){

        //Form validation
       $regras = [
           'email' => 'required|email',
           'senha' => 'required|min:6|max:30',

       ];

       $feedback = [
          'email.email' => 'Por favor, Informe um E-mail Valido.',
          'senha.min' => 'O campo senha deve ter no mínimo :min caracteres.',
          'senha.max' => 'O campo senha deve ter no máximo :max caracteres.',
          'required' => 'O campo :attribute é obrigatório.',
       ];

       $request->validate($regras, $feedback);


         $username = $request->input('text_username');
         $password = $request->input('text_password');

         //teste database connection
         try{
            DB::connection()->getPdo();
            echo 'Connection success';

         }
         catch(\PDOException $e){
            echo 'Connection failed:' . $e->getMessage();

         }

         echo 'Fim';



    }

    public function logout(){

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\services\Operations;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function index(){

        //load user's notes
        $id = session('user.id');

        //buscando notas do user logado
        //Chama o relacionamento notes() definido no modelo User
        $notes = User::find($id)->notes()->get()->toArray();

        //show home view
       return view('home', ['notes' => $notes]);
    }

    public function editNote($id){

       $id = Operations::decryptId($id);

       echo "$id";


    }

    public function deleteNote($id){

        $id = Operations::decryptId($id);

        echo "$id";




    }



    public function newNote(){
        echo "Criar uma nova nota!";

    }

}

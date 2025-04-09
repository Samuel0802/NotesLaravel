<?php

namespace App\Http\Controllers;

use App\Models\Note;
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

        //show new note view
        return view('new_note');

    }

    public function newNoteSubmit(Request $request){

     //Validação dos dados do formulário
     $regras = [
       'title' => 'required|min:3|max:200',
       'text' => 'required|min:3|max:3000',
     ];

     $feedback = [

     'title.min' => 'O campo deve ter no minimo :min caracteres.',
     'title.max' => 'O campo deve ter no máxino :max caracteres',
     'title.required' => 'O campo Titulo é Obrigátorio',
     'text.min' => 'O campo deve ter no minimo :min caracteres',
     'text.max' => 'O campo deve ter no máximo :max caracteres',
     'text.required' => 'O campo Nota é Obrigatório',

     ];

     $request->validate($regras, $feedback);


     //Buscar id do user
     $id = session('user.id');

     //Criar nova nota
     $nota = new Note();
     $nota->user_id = $id;
     $nota->title = $request->input('title');
     $nota->text = $request->input('text');
     $nota->save();

     //Redirecionar para a home
    return redirect()->route('home');


    }

}

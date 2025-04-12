<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\services\Operations;
use Illuminate\Http\Request;


class MainController extends Controller
{
    //Tela home
    public function index()
    {

        //load user's notes
        $id = session('user.id');

        //buscando notas do user logado
        //Chama o relacionamento notes() definido no modelo User
        $notes = User::find($id)->notes()->whereNull('deleted_at')->paginate(5);

        //show home view
        return view('home', ['notes' => $notes]);
    }

    //Tela view get para nova nota
    public function newNote()
    {

        //show new note view
        return view('new_note');
    }

    //Tela post para nova nota
    public function newNoteSubmit(Request $request)
    {

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

        try {
            //Criar nova nota
            $nota = new Note();
            $nota->user_id = $id;
            $nota->title = $request->input('title');
            $nota->text = $request->input('text');
            $nota->save();

            //Redirecionar para a home
            return redirect()->route('home')->with('success', 'Uma nova nota criada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('erro', 'Erro ao cadastrar a nota. Tente novamente.');
        }
    }

    //Tela get para editar nota
    public function editNote($id)
    {

        //função para decrypt do id da nota
        $id = Operations::decryptId($id);

        if ($id === null) {
            return redirect()->route('home');
        }

        //Carregar nota
        $note = Note::find($id);

        return view('edit_note', ['note' => $note]);
    }

    //Tela post para editar nota
    public function editNoteSubmit(Request $request)
    {

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

        //check se note_id existe
        if ($request->note_id == null) {
            // die('erro');
            return redirect()->route('home');
        }

        //decrypt note_id
        $id = Operations::decryptId($request->note_id);

        if ($id === null) {
            return redirect()->route('home');
        }

        //Carregar nota
        $note = Note::find($id);

        try {
            //Update nota
            $note->title = $request->input('title');
            $note->text = $request->input('text');
            $note->save();

             //Redirect Home
        return redirect()->route('home')->with('success', 'Nota editada com sucesso.');

        } catch (\Exception $e) {
        return redirect()->route('home')->with('erro', 'Erro ao editar a nota. Tente novamente.');
        }

    }

    public function deleteNote($id)
    {

        $id = Operations::decryptId($id);

        if ($id === null) {
            return redirect()->route('home');
        }

        //Carregar nota
        $note = Note::find($id);

        return view('delete_note', ['note' => $note]);
    }

    public function deleteNoteConfirm($id)
    {

        //check se $id no encrypted existe
        $id = Operations::decryptId($id);

        if ($id === null) {
            return redirect()->route('home');
        }

        //carregar note
        $note = Note::find($id);

        //1. Hard delete: remover o registro fisicamente
        //  $note->delete();

        //2. Soft delete
        //  $note->deleted_at = date('Y-m-d H:i:s');
        //  $note->save();

        //3. Soft delete usando model
        $note->delete();

        //4. Hard Delete usando model
        //$note->forceDelete();

        //redirect home
        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {

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

        //Recupera os dados enviados
        $email = $request->input('email');
        $senha = $request->input('senha');

        //Busca o usuário no banco
        $user = User::where('email', $email)
            ->where('deleted_at', NULL)
            ->first();

        //Verifica se encontrou e se a email está correto
        if (!$user) {
            //back: Volta atrás, withInput: dados do input form, with: mensagem de feedback
            return redirect()->back()->withInput()->with('loginError', 'Email Ou Senha incorreto.');
        }

        //Verifica se encontrou e se a senha está correta
        if (!password_verify($senha, $user->senha)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Email Ou Senha incorreto.');
        }

       // Registra a data/hora do último login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        //Armazena o usuário logado na sessão
        session([
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
            ]
        ]);

        //redirect to home
        return redirect()->to('/');
    }

    public function logout()
    {

        //Remover o user da sessão
        session()->forget('user');

        return redirect()->to('/login');
    }
}

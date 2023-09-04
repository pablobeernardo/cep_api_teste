<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function updateUser(Request $request, $id)
    {
        // Pegar o usuário logado
        $user = User::find($id);

        // Pegar os dados do formulário
        $data = $request->all();

        // Verificar se existe imagem
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Verificar se o usuário já tem uma imagem
            if ($user->image) {
                // Se tiver, deletar a imagem antiga
                Storage::delete($user->image);
            }

            // Pegar a imagem
            $image = $request->file('image');

            // Pegar a extensão da imagem
            $extension = $image->extension();

            // Definir o nome da imagem
            $name = uniqid(date('HisYmd'));

            // Definir o nome completo
            $nameFile = "{$name}.{$extension}";

            // Fazer o upload da imagem
            $upload = $image->storeAs('users', $nameFile);

            // Verificar se o upload foi feito com sucesso
            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            }

            // Definir o nome da imagem no banco de dados
            $data['image'] = $nameFile;
        }

        // Atualizar os dados do usuário
        $update = $user->update($data);

        // Verificar se os dados foram atualizados
        if ($update) {
            // Recarregar o usuário com os dados atualizados
            $user = User::find($id);

            // Armazenar o usuário na sessão
            session(['user' => $user]);

            return redirect()
                ->route('home')
                ->with('success', 'Dados atualizados com sucesso!');
        }

        // Se não, retornar com erro
        return redirect()
            ->back()
            ->with('error', 'Falha ao atualizar os dados')
            ->withInput();
    }
}

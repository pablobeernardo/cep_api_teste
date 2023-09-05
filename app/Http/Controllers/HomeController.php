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
        $user = User::find($id);

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($user->image) {
                Storage::delete($user->image);
            }

            $image = $request->file('image');

            $extension = $image->extension();

            $name = uniqid(date('HisYmd'));

            $nameFile = "{$name}.{$extension}";

            $upload = $image->storeAs('users', $nameFile);

            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            }

            $data['image'] = $nameFile;
        }

        $update = $user->update($data);

        if ($update) {
            $user = User::find($id);

            session(['user' => $user]);

            return redirect()
                ->route('data.user')
                ->with('success', 'Dados atualizados com sucesso!');
        }

        return redirect()
            ->back()
            ->with('error', 'Falha ao atualizar os dados')
            ->withInput();
    }

    public function getDataUser()
    {
        $user = Auth::user();

        return view('data-user', ['user' => $user]);
    }
}

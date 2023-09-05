<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $name = uniqid(date('HisYmd')) . '.' . $extension;

            $path = $image->storeAs('uploads', $name, 'public');

            if ($path) {
                $data['image'] = $name;
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            }
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

    public function getImage($filename)
    {
        $path = storage_path('app/public/users/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }
}

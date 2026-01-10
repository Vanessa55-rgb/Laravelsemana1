<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        $users = User::orderBy('id', 'asc')->paginate();
        return view('users.index',compact('users'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show($id){
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit($id){
        $user = User::find($id);
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->update($request->only(['name', 'email']));
        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id){
        if (auth()->id() == $id) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminar tu propia cuenta. Esto evita accidentes y que se cierre tu sesión inesperadamente.');
        }

        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
        }

        return redirect()->route('users.index')->with('error', 'Usuario no encontrado.');
    }
}

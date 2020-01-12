<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    /**
     * Lista todos os usuários
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::orderBy('name', 'ASC')->get()->all();
        return response()->json(['data'=> $users]); 

    }

    /**
     * Salva um novo usuário no banco
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validação do parâmetros
        $this->validate($request, [
            'name'=>'required',
            'email'=>'email|unique:users',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        $data = $request->all();

        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];

        //cria um novo usuário
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        return response()->json(['data'=> $user]); 

    }

}

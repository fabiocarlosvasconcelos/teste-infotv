<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    /**
     * Método responável pela validação do usuário 
     * e criação do token JWT
     *
     * @return \Illuminate\Http\Response
     */
    public function token(Request $request)
    {

        //validação do parâmetros
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required'
        ]);

        $data = $request->all();

        $email = $data['email']; //email do usuário
        $password = $data['password']; //senha in text do usuário

        //recupera o usuário por email
        $user = User::where('email', $email)->first();

        if($user){//se achou o usuário

            //hash da senha do usuário no banco de dados
            $hash = $user->password;

            //compara a senha passada por parametro com o hash
            if(Hash::check($password, $hash)){
                return response()->json(['data'=> ["status"=>"success"]]);
            } 

        }

        return response()->json(['error'=> "Email or password is invalid"]);
        
    }
}
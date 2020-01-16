<?php

namespace App\Http\Controllers;

use App\Auth\Jwt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    /**
     * Método responável pela criação do JWT para autenticação
     * nas endpoints da api 
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
            $userName =$user->name;

            //compara a senha passada por parametro com o hash
            if(Hash::check($password, $hash)){

                $jwt = new Jwt();

                $token = $jwt->getToken();//token

                return response()->json(['data'=> ["status"=>"success", "user"=>$userName, "token" => $token]]);
            } 

        }

        return response()->json(['error'=> "Email or password is invalid"]);
        
    }
}

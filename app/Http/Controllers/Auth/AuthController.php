<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{

    // Cadastrar um novo usuário no sistema.
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token, 
            'token_type' => 'Bearer', 
        ]);
    }


    // Fazer login no sistema.
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'E-mail ou senha está incorreto'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
                'message' => 'Oi '.$user->name.', Bem vindo!',
                'username' => $user->name,
                'id' => $user->id,
                'access_token' => $token, 
                'token_type' => 'Bearer', 
            ]);
    }

    // Fazer logoff e excluir tokens.
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Você realizou o logoff com sucesso e o token foi deletado com sucesso!'
        ];
    }
}

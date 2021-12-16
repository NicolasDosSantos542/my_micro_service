<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller 
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {

        $users = User::all();

        return response()->json($users);
    }

    public function create(Request $request)
    {

        //validate incoming request 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $plainPassword = $request->input('password');
        $user->password = app('hash')->make($plainPassword);

        $user->save();

        return response()->json($user);
    }

    public function show($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        // dd($request->input());
        foreach ($request->input() as $key => $value) {
            switch ($key) {
                case "name":
                    $user->name = $request->input('name');
                    break;
                case "email":
                    $user->email = $request->input('email');
                    break;
                case "password":
                    $user->password = $request->input('password');
                    break;
            }
        }

        $user->save();
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json('user removed successfully');
    }


    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);
       
        if (!$token = Auth::attempt($credentials)) {

            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }
}

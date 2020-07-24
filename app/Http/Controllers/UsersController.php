<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    function login(Request $request){
        if($request->isJson()){
            $data = $request->json()->all();
            $user = User::where('use_email', $data['use_email'])->first();

            if ($user == null) {
                return response()->json(['response' => 'email']);

            }else if (Hash::check($data['use_password'], $user->use_password)){
                return response()->json(['response' => $user], 200);

            }else{
                return response()->json(['response' => 'password'], 401);

            }
        }
        return response()->json(['response' => 'No autorizado'], 401);

    }

    public function getUsers(Request $request) {
        if ($request->isJson()) {
            $response = User::all();

            return $response;
        }

        return response()->json(['response' => false], 401);

    }

    public function addUser(Request $request) {

        if ($request->isJson()){
            $this->validate($request, [
                "use_nombre" => 'required',
                "use_app" => 'required',
                "use_apm" => 'required',
                "use_email" => 'required|unique:users,use_email',
                "use_password" => 'required',
                "use_telefono" => 'required|numeric|digits:10|unique:users,use_telefono',
                "use_role" => 'required'
            ]);

            $data = [
                "use_nombre" => $request['use_nombre'],
                "use_app" => $request['use_app'],
                "use_apm" => $request['use_apm'],
                "use_email" => $request['use_email'],
                "use_password" => Hash::make($request['use_password']),
                "use_telefono" => $request['use_telefono'],
                "use_role" => $request['use_role']
            ];

            $create = User::create($data);

            return $create;
        }

        return response()->json(['response' => false], 401);
    }

    public function updateUser(Request $request) {

        if ($request->isJson()) {
            $this->validate($request, [
                "use_nombre" => 'required',
                "use_app" => 'required',
                "use_apm" => 'required',
                "use_email" => Rule::unique('users')->ignore($request['use_id'], 'use_id'),
                "use_telefono" => Rule::unique('users')->ignore($request['use_id'], 'use_id'),
                "use_role" => 'required'
            ]);

            $data = $request->json()->all();
            $update = User::where('use_id', $request['use_id'])->update($data);

            if ($update == 1) {
                return $data;
            }

            return response()->json(['response' => false], 401);

        }

        return response()->json(['response' => false], 401);
    }

    public function deleteUser(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
               'use_id' => 'required'
            ]);

            $data = User::find($request['use_id']);

            if (isset($data)) {
                $data->delete();
                return response()->json(['response' => true], 200);
            }

            return response()->json(['response' => false], 401);
        }

        return response()->json(['response' => false], 401);
    }


}

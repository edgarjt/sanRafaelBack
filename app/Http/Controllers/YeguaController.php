<?php

namespace App\Http\Controllers;

use App\Yegua;
use Illuminate\Http\Request;

class YeguaController extends Controller
{
    public function getYeguas(Request $request) {
        if ($request->isJson()) {
            return Yegua::all();
        }

        return response()->json(['response' => false], 401);
    }

    public function addYegua(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'yeg_nombre' => 'required',
                'yeg_capa' => 'required',
                'yeg_nacimiento' => 'required',
                'yeg_semental' => 'required',
                'yeg_fot1' => 'required',
                'yeg_fot2' => 'required',
                'yeg_fot3' => 'required',
                'yeg_video' => 'required',
                'fk_id_user' => 'required',
                'fk_id_finca' => 'required'
            ]);

            $data = $request->json()->all();
            $add = Yegua::create($data);

            return $add;
        }

        return response()->json(['response' => false], 401);
    }

    public function updateYegua(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'yeg_id' => 'required',
                'yeg_nombre' => 'required',
                'yeg_capa' => 'required',
                'yeg_nacimiento' => 'required',
                'yeg_semental' => 'required',
                'yeg_fot1' => 'required',
                'yeg_fot2' => 'required',
                'yeg_fot3' => 'required',
                'yeg_video' => 'required',
                'fk_id_user' => 'required',
                'fk_id_finca' => 'required'
            ]);

            $data = $request->json()->all();

            $response = Yegua::where('yeg_id', $data['yeg_id'])->update($data);

            if ($response == 1) {
                return $data;
            }

            return response()->json(['response' => false], 401);
        }

        return response()->json(['response' => false], 401);
    }

    public function deleteYegua(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'yeg_id' => 'required'
            ]);

            $data = $request->json()->all();

            $delete = Yegua::where('yeg_id', $data['yeg_id'])->first();

            if (isset($delete)) {
                $delete->delete();
                return response()->json(['response' => true], 200);
            }
        }

        return response()->json(['response' => false], 401);
    }
}

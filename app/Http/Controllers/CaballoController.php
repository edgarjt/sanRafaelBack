<?php

namespace App\Http\Controllers;

use App\Caballo;
use Illuminate\Http\Request;

class CaballoController extends Controller
{
    public function getCaballos(Request $request) {
        if ($request->isJson()) {
            return Caballo::all();
        }

        return response()->json(['response' => false], 401);
    }

    public function addCaballo(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'cab_nombre' => 'required',
                'cab_capa' => 'required',
                'cab_nacimiento' => 'required',
                'cab_semental' => 'required',
                'cab_fot1' => 'required',
                'cab_fot2' => 'required',
                'cab_fot3' => 'required',
                'cab_video' => 'required',
                'fk_id_user' => 'required',
                'fk_id_finca' => 'required'
            ]);

            $data = $request->json()->all();

            $response = Caballo::create($data);

            return $response;

        }

        return response()->json(['response' => false], 401);
    }

    public function updateCaballo(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'cab_id' => 'required',
                'cab_nombre' => 'required',
                'cab_capa' => 'required',
                'cab_nacimiento' => 'required',
                'cab_semental' => 'required',
                'cab_fot1' => 'required',
                'cab_fot2' => 'required',
                'cab_fot3' => 'required',
                'cab_video' => 'required',
                'fk_id_user' => 'required',
                'fk_id_finca' => 'required'
            ]);

            $data = $request->json()->all();

            $update = Caballo::where('cab_id', $data['cab_id'])->update($data);

            if ($update == 1) {
                return $data;
            }

            return response()->json(['response' => false], 401);
        }

        return response()->json(['response' => false], 401);
    }

    public function deleteCaballo(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'cab_id' => 'required'
            ]);

            $data = $request->json()->all();

            $delete = Caballo::where('cab_id', $data['cab_id'])->first();

            if (isset($delete)) {
                $delete->delete();
                return response()->json(['response' => true], 200);
            }

            return response()->json(['response' => false], 401);
        }

        return response()->json(['response' => false], 401);
    }
}

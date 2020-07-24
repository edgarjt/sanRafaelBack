<?php

namespace App\Http\Controllers;

use App\Finca;
use Illuminate\Http\Request;

class FincaController extends Controller
{
    public function getFincas(Request $request) {
        if ($request->isJson()) {
            return Finca::all();
        }

        return response()->json(['response' => false], 401);
    }

    public function addFinca(Request $request) {
        if ($request->isJson()) {
            $data = $request->json()->all();

            $this->validate($request, [
               'fin_nombre' => 'required',
               'fin_direccion' => 'required',
               'fin_horario' => 'required'
            ]);

            $create = Finca::create($data);
            return $create;


        }

        return response()->json(['response' => false], 401);
    }

    public function updateFinca(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
               'fin_id' => 'required',
               'fin_nombre' => 'required',
               'fin_direccion' => 'required',
               'fin_horario' => 'required',
            ]);

            $data = $request->json()->all();

            $update = Finca::where('fin_id', $data['fin_id'])->update($data);

            if ($update == 1) {
                return $data;
            }

            return response()->json(['response' => false], 401);
        }

        return response()->json(['response' => false], 401);
    }

    public function deleteFinca(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'fin_id' => 'required'
            ]);

            $response = Finca::find($request['fin_id']);

            if (isset($response)) {
                $response->delete();
                return response()->json(['response' => true], 200);
            }

            return response()->json(['response' => false], 401);
        }

        return response()->json(['response' => false], 401);
    }
}

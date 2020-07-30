<?php

namespace App\Http\Controllers;

use App\InfoWeb;
use Illuminate\Http\Request;

class InfowebController extends Controller
{
    public function getInfos(Request $request) {
        if ($request->isJson()) {
            return InfoWeb::all();
        }

        return response()->json(['response' => false], 401);
    }

    public function updateInfo(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'inf_id' => 'required',
                'inf_logo' => 'required',
                'inf_telefono' => 'required',
                'inf_email' => 'required',
                'inf_historia' => 'required',
                'fk_id_user' => 'required'
            ]);

            $data = $request->json()->all();

            $update = InfoWeb::where('inf_id', $data['inf_id'])->update($data);

            if ($update == 1) {
                return InfoWeb::where('inf_id', $data['inf_id'])->first();
            }

            return response()->json(['response' => false], 401);
        }

        return response()->json(['response' => false], 401);
    }
}

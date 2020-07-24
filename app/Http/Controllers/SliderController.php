<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function getSliders(Request $request) {
        if ($request->isJson()) {
            return Slider::all();
        }

        return response()->json(['response' => false], 401);
    }

    public function updateslider(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'sli_id' => 'required'
            ]);

            $data = $request->json()->all();

            $update = Slider::where('sli_id', $data['sli_id'])->update($data);

            if ($update == 1) {
                return Slider::where('sli_id', $data['sli_id'])->first();
            }

            return response()->json(['response' => false], 401);
        }

        return response()->json(['response' => false], 401);
    }
}

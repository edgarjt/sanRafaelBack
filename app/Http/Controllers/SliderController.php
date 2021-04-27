<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    const DIR_PATH = 'Slider/';
    const LOCAL_DISK = 'local';
    public function getSliders(Request $request) {
        if ($request->isJson()) {
            return Slider::all();
        }

        return response()->json(['response' => false], 401);
    }

    public function updateslider(Request $request) {
        $request->validate([
            'sli_id' => 'required',
            'sli_nombre' => 'required',
            'fk_id_user' => 'required',
        ]);

        $slid = $request->file('sli_link');
        $update = Slider::where('sli_id', $request['sli_id'])->first();
        $url_img = $update->sli_link;

            if ($slid) {
                $url_img = self::DIR_PATH.$update->sli_id.'/fotSlider.png';
                Storage::disk(self::LOCAL_DISK)->put($url_img,File::get($slid));
            }

        $data = [
            'sli_nombre' => $request['sli_nombre'],
            'sli_link' => $url_img,
            'fk_id_user' => $request['sli_id']
        ];

        $update->update($data);

        if ($update) {
            return $update;
        }
    }
}

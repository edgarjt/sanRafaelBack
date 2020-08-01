<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
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

            if ($slid) {
                $name = str_replace(' ', '_', time().$slid->getClientOriginalName());
                Storage::disk('slid')->put($name,File::get($slid));
                $url_img = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/slid/'.$name;

                $foto = $update->sli_link;
                $name_foto = substr($foto, 73);
                Storage::disk('slid')->delete($name_foto);
            }else {
                $url_img = $request['sli_link'];
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

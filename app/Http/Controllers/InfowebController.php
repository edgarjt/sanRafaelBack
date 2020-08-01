<?php

namespace App\Http\Controllers;

use App\InfoWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InfowebController extends Controller
{
    public function getInfos(Request $request)
    {
        if ($request->isJson()) {
            return InfoWeb::all()->first();
        }

        return response()->json(['response' => false], 401);
    }

    public function updateInfo(Request $request)
    {
        $this->validate($request, [
                'inf_id' => 'required',
                'inf_telefono' => 'required',
                'inf_email' => 'required',
                'inf_historia' => 'required',
                'fk_id_user' => 'required'
            ]);

        $logo = $request->file('inf_logo');

        $update = InfoWeb::where('inf_id', $request['inf_id'])->first();


        if ($logo) {
            $name = str_replace(' ', '_', time().$logo->getClientOriginalName());
            Storage::disk('logo')->put($name,File::get($logo));
            $url_img = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/logo/'.$name;

            $foto = $update->inf_logo;
            $name_foto = substr($foto, 73);
            Storage::disk('logo')->delete($name_foto);
        } else {
            $url_img = $request['inf_logo'];
        }

        $data = [
            'inf_logo' => $url_img,
            'inf_telefono' => $request['inf_telefono'],
            'inf_email' => $request['inf_email'],
            'inf_historia' => $request['inf_historia'],
            'fk_id_user' => 1,
        ];

        $update->update($data);

        if ($update) {
            return $update;
        }

    }
}

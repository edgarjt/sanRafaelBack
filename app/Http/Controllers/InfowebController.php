<?php

namespace App\Http\Controllers;

use App\InfoWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InfowebController extends Controller
{
    const DIR_PATH = 'InfoWeb/';
    const LOCAL_DISK = 'local';

    public function getInfos(Request $request)
    {
        if ($request->isJson()) {
            return InfoWeb::all();
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
        $url_img = $update->inf_logo;


        if ($logo) {
            $url_img = self::DIR_PATH.$update->inf_id.'/infoWeb.png';
            Storage::disk(self::LOCAL_DISK)->put($url_img,File::get($logo));
        }

        $data = [
            'inf_logo' => $url_img,
            'inf_telefono' => $request['inf_telefono'],
            'inf_email' => $request['inf_email'],
            'inf_historia' => $request['inf_historia'],
            'fk_id_user' => $request['inf_id'],
        ];

        $update->update($data);

        if ($update) {
            return $update;
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Trofeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TrofeoController extends Controller
{
    public function getTrofeos() {
        $data = Trofeo::all();
        return $data;
    }

    public function whereTrofeoCaballo() {
        return $this->hasMany(Trofeo::class);

    }

    public function addTrofeo(Request $request) {
        $this->validate($request, [
            'trf_titulo' => 'required',
            'trf_foto' => 'required',
            'trf_fecha' => 'required',
            'trf_descripcion' => 'required',
            'fk_id_caballo' => 'required'
        ]);

        $foto_trofeo = $request->file('trf_foto');

        if ($foto_trofeo) {
            $name = str_replace(' ', '_', time().$foto_trofeo->getClientOriginalName());
            //Storage::disk('trofeo')->put($name,File::get($foto_trofeo));
            $url_img = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/trofeo/'.$name;
        }

        $data = [
            'trf_titulo' => $request->trf_titulo,
            'trf_foto' => $url_img,
            'trf_fecha' => $request->trf_fecha,
            'trf_descripcion' => $request->trf_descripcion,
            'fk_id_caballo' => $request->fk_id_caballo
        ];

        $add = Trofeo::create($data);
        return$data;
    }
}

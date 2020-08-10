<?php

namespace App\Http\Controllers;

use App\TrofeoYegua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TrofeoYeguaController extends Controller
{
    public function getTrofeosYeguas(Request $request) {
        if ($request->isJson()) {
            $data = TrofeoYegua::all();

            if (count($data) > 0) {
                return $data;
            }
        }

        return response()->json(['response' => false], 401);

    }

    public function addTrofeoYegua(Request $request) {
        $this->validate($request, [
            'trf_titulo' => 'required',
            'trf_fecha' => 'required',
            'trf_descripcion' => 'required',
            'fk_id_yegua' => 'required'
        ]);

        $foto_trofeo = $request->file('trf_foto');

        if ($foto_trofeo) {
            $name = str_replace(' ', '_', time().$foto_trofeo->getClientOriginalName());
            Storage::disk('trofeo')->put($name,File::get($foto_trofeo));
            $url_img = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/trofeo/'.$name;
        }

        $data = [
            'trf_titulo' => $request->trf_titulo,
            'trf_foto' => $url_img,
            'trf_fecha' => $request->trf_fecha,
            'trf_descripcion' => $request->trf_descripcion,
            'fk_id_yegua' => $request->fk_id_yegua
        ];

        $add = TrofeoYegua::create($data);
        return $add;

    }

    public function updateTrofeoYegua(Request $request) {
        $file = $request->file('trf_foto');

        $update = TrofeoYegua::where('trf_id', $request->trf_id)->first();

        if ($file) {
            $name = str_replace(' ', '_', time().$file->getClientOriginalName());
            Storage::disk('trofeo')->put($name,File::get($file));
            $url_img = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/trofeo/'.$name;

            $foto = $update->trf_foto;
            $name_foto = substr($foto, 75);
            Storage::disk('trofeo')->delete($name_foto);
        } else {
            $url_img = $request->trf_foto;
        }

        $data = [
            'trf_titulo' => $request->trf_titulo,
            'trf_foto' => $url_img,
            'trf_fecha' => $request->trf_fecha,
            'trf_descripcion' => $request->trf_descripcion,
            'fk_id_yegua' => $request->fk_id_yegua
        ];

        $update->update($data);

        if ($update) {
            return $update;
        }

        return response()->json(['response' => false], 401);

    }

    public function whereTrofeoYegua(Request $request) {
        if ($request->isJson()) {
            $data = TrofeoYegua::where('fk_id_yegua', $request->fk_id_yegua)->get();

            if (count($data) > 0){
                return $data;
            }

            return response()->json(['response' => false], 204);
        }

        return response()->json(['response' => false], 401);

    }

    public function deleteTrofeoYegua(Request $request) {
        if ($request->isJson()) {

            $delete = TrofeoYegua::where('trf_id', $request->trf_id)->first();

            if (isset($delete)) {
                $foto = $delete->trf_foto;


                $name_foto = substr($foto, 75);

                Storage::disk('trofeo')->delete($name_foto);

                $delete->delete();
                return response()->json(['response' => true], 200);
            }
        }

        return response()->json(['response' => false], 401);

    }
}

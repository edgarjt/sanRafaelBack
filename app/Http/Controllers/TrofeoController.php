<?php

namespace App\Http\Controllers;

use App\Trofeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TrofeoController extends Controller
{
    const DIR_PATH = 'TrofeoCab/';
    const LOCAL_DISK = 'local';

    public function getTrofeosCaballos() {
        $response = DB::table('trofeoCaballo')
            ->join('caballo', 'trofeoCaballo.fk_id_caballo', 'caballo.cab_id')
            ->select('trofeoCaballo.*', 'caballo.cab_nombre')
            ->get();

        if (count($response) > 0) {
            return $response;
        }

        return response()->json(['response' => false], 204);

    }

    public function whereTrofeoCaballo(Request $request) {
        if ($request->isJson()) {
            $data = Trofeo::where('fk_id_caballo', $request->fk_id_caballo)->get();

            if (count($data) > 0){
                return $data;
            }

            return response()->json(['response' => false], 204);
        }

        return response()->json(['response' => false], 401);

    }

    public function addTrofeoCaballo(Request $request) {
        $this->validate($request, [
            'trf_titulo' => 'required',
            'trf_fecha' => 'required',
            'trf_descripcion' => 'required',
            'fk_id_caballo' => 'required'
        ]);

        $foto_trofeo = $request->file('trf_foto');
        $url_img = null;

        if ($foto_trofeo) {
            $url_img = self::DIR_PATH.$request->fk_id_caballo.'/fotOne.png';
            Storage::disk(self::LOCAL_DISK)->put($url_img,File::get($foto_trofeo));
        }

        $data = [
            'trf_titulo' => $request->trf_titulo,
            'trf_foto' => $url_img,
            'trf_fecha' => $request->trf_fecha,
            'trf_descripcion' => $request->trf_descripcion,
            'fk_id_caballo' => $request->fk_id_caballo
        ];

        $add = Trofeo::create($data);
        return $add;
    }

    public function updateTrofeoCaballos(Request $request) {
        $file = $request->file('trf_foto');

        $update = Trofeo::where('trf_id', $request->trf_id)->first();

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
            'fk_id_caballo' => $request->fk_id_caballo
        ];

        $update->update($data);

        if ($update) {
            return $update;
        }

        return response()->json(['response' => false], 401);
    }

    public function deleteTrofeoCaballos(Request $request) {
        if ($request->isJson()) {

            $delete = Trofeo::where('trf_id', $request->trf_id)->first();

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

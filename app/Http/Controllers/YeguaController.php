<?php

namespace App\Http\Controllers;

use App\Yegua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class YeguaController extends Controller
{
    const DIR_PATH = 'Yeguas/';
    const LOCAL_DISK = 'local';

    public function getYeguas(Request $request) {
        if ($request->isJson()) {
            return Yegua::all();
        }

        return response()->json(['response' => false], 401);
    }

    public function whereYegua(Request $request) {
        if ($request->isJson()) {
            $response = Yegua::where('yeg_id', $request->yeg_id)->first();

            if (isset($response)) {
                return $response;
            }
        }
        return response()->json(['response' => false], 401);
    }

    public function ultimateYeguas(Request $request) {
        if ($request->isJson()) {
            $response = Yegua::latest()->take(3)->get();

            if (isset($response)) {
                return $response;
            }
        }
        return response()->json(['response' => false], 401);
    }

    public function addYegua(Request $request) {

        $validator = Validator::make($request->all(), [
            'yeg_nombre' => 'required',
            'yeg_capa' => 'required',
            'yeg_semental' => 'required',
            'fk_id_user' => 'required',
            'fk_id_finca' => 'required'
        ]);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => 'Datos invalidos'], 404);

        $fot1 =  $request->file('yeg_fot1');
        $fot2 =  $request->file('yeg_fot2');
        $fot3 =  $request->file('yeg_fot3');
        $yeg_video =  $request->file('yeg_video');
        $path_one = null;
        $path_two = null;
        $path_tree = null;
        $path_video = null;

        if ($fot1) {
            $path_one = self::DIR_PATH.$request->yeg_nombre.'/fotOne.png';
            Storage::disk(self::LOCAL_DISK)->put($path_one, File::get($fot1));
        }

        if ($fot2) {
            $path_two = self::DIR_PATH.$request->yeg_nombre.'/fotTwo.png';
            Storage::disk(self::LOCAL_DISK)->put($path_two, File::get($fot2));
        }

        if ($fot3) {
            $path_tree = self::DIR_PATH.$request->yeg_nombre.'/fotTree.png';
            Storage::disk(self::LOCAL_DISK)->put($path_tree, File::get($fot3));
        }

        if ($yeg_video) {
            $path_video = self::DIR_PATH.$request->yeg_nombre.'/video.mp4';
            Storage::disk(self::LOCAL_DISK)->put($path_video, File::get($yeg_video));
        }

            $add = Yegua::create([
                'yeg_nombre' => $request['yeg_nombre'],
                'yeg_capa' => $request['yeg_capa'],
                'yeg_nacimiento' => $request['yeg_nacimiento'],
                'yeg_semental' => $request['yeg_semental'],
                'yeg_altura' => $request['yeg_altura'],
                'yeg_fot1' => $path_one,
                'yeg_fot2' => $path_two,
                'yeg_fot3' => $path_tree,
                'yeg_video' => $path_video,
                'fk_id_user' => $request['fk_id_user'],
                'fk_id_finca' => $request['fk_id_finca']
            ]);

        if (!is_null($add)) {
            return $add;
        }

        return response()->json(['status' => false, 'message' => 'Ocurrio un error al insertar los datos'], 404);

    }

    public function updateYegua(Request $request) {

        $validator = Validator::make($request->all(), [
            'yeg_id' => 'required',
            'yeg_nombre' => 'required',
            'yeg_capa' => 'required',
            'yeg_semental' => 'required',
            'fk_id_user' => 'required',
            'fk_id_finca' => 'required'
        ]);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => 'Datos invalidos'], 404);

        $fot1 =  $request->file('yeg_fot1');
        $fot2 =  $request->file('yeg_fot2');
        $fot3 =  $request->file('yeg_fot3');
        $yeg_video =  $request->file('yeg_video');
        $path_one = $request->yeg_fot1;
        $path_two = $request->yeg_fot2;
        $path_tree = $request->yeg_fot3;
        $path_video = $request->yeg_video;


        $update = Yegua::where('yeg_id', $request['yeg_id'])->first();

        if (is_null($update)){
            return response()->json(['status' => false, 'message' => 'Datos no encontrado'], 404);
        }

        if ($fot1) {
            $path_one = self::DIR_PATH.$request->yeg_nombre.'/fotOne.png';
            Storage::disk(self::LOCAL_DISK)->put($path_one, File::get($fot1));
        }

        if ($fot2) {
            $path_two = self::DIR_PATH.$request->yeg_nombre.'/fotTwo.png';
            Storage::disk(self::LOCAL_DISK)->put($path_two, File::get($fot2));
        }

        if ($fot3) {
            $path_tree = self::DIR_PATH.$request->yeg_nombre.'/fotTree.png';
            Storage::disk(self::LOCAL_DISK)->put($path_tree, File::get($fot3));
        }

        if ($yeg_video) {
            $path_video = self::DIR_PATH.$request->yeg_nombre.'/video.mp4';
            Storage::disk(self::LOCAL_DISK)->put($path_video, File::get($yeg_video));
        }

        $data = [
            'yeg_nombre' => $request['yeg_nombre'],
            'yeg_capa' => $request['yeg_capa'],
            'yeg_nacimiento' => $request['yeg_nacimiento'],
            'yeg_semental' => $request['yeg_semental'],
            'yeg_altura' => $request['yeg_altura'],
            'yeg_fot1' => $path_one,
            'yeg_fot2' => $path_two,
            'yeg_fot3' => $path_tree,
            'yeg_video' => $path_video,
            'fk_id_user' => $request['fk_id_user'],
            'fk_id_finca' => $request['fk_id_finca']
        ];

        $update->update($data);

        if ($update) {
            return $update;
        }

    }

    public function deleteYegua(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'yeg_id' => 'required'
            ]);

            $data = $request->json()->all();

            $delete = Yegua::where('yeg_id', $data['yeg_id'])->first();

            if (isset($delete)) {
                $foto1 = $delete->yeg_fot1;
                $foto2 = $delete->yeg_fot2;
                $foto3 = $delete->yeg_fot3;
                $video = $delete->yeg_video;

                $name_foto1 = substr($foto1, 81);
                $name_foto2 = substr($foto2, 81);
                $name_foto3 = substr($foto3, 81);
                $name_video = substr($video, 81);

                Storage::disk('fotos_yeguas')->delete([$name_foto1, $name_foto2, $name_foto3]);
                Storage::disk('video_yeguas')->delete($name_video);

                $delete->delete();
                return response()->json(['response' => true], 200);
            }
        }

        return response()->json(['response' => false], 401);
    }
}

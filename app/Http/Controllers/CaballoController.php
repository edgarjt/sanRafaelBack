<?php

namespace App\Http\Controllers;

use App\Caballo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class CaballoController extends Controller
{
    const DIR_PATH = 'Caballos/';
    const LOCAL_DISK = 'local';

    public function getCaballos(Request $request) {
        if ($request->isJson()) {
            return Caballo::all();
        }

        return response()->json(['response' => false], 401);
    }

    public function whereCaballo(Request $request) {
        if ($request->isJson()) {
            $response = Caballo::where('cab_id', $request->cab_id)->first();

            if (isset($response)) {
                return $response;
            }
        }
        return response()->json(['response' => false], 401);
    }

    public function ultimateCaballos(Request $request) {
        if ($request->isJson()) {
            $response = Caballo::latest()->take(3)->get();

            if (isset($response)) {
                return $response;
            }
        }
        return response()->json(['response' => false], 401);
    }

    public function addCaballo(Request $request) {

        $validator = Validator::make($request->all(), [
            'cab_nombre' => 'required',
            'cab_capa' => 'required',
            'cab_semental' => 'required',
            'fk_id_user' => 'required',
            'fk_id_finca' => 'required'
        ]);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => 'Datos invalidos'], 404);

            $fot1 =  $request->file('cab_fot1');
            $fot2 =  $request->file('cab_fot2');
            $fot3 =  $request->file('cab_fot3');
            $cab_video =  $request->file('cab_video');
            $path_one = null;
            $path_two = null;
            $path_tree = null;
            $path_video = null;

            if ($fot1) {
                $path_one = self::DIR_PATH.$request->cab_nombre.'/fotOne.png';
                Storage::disk(self::LOCAL_DISK)->put($path_one, File::get($fot1));
            }

            if ($fot2) {
                $path_two = self::DIR_PATH.$request->cab_nombre.'/fotTwo.png';
                Storage::disk(self::LOCAL_DISK)->put($path_two, File::get($fot2));
            }

            if ($fot3) {
                $path_tree = self::DIR_PATH.$request->cab_nombre.'/fotTree.png';
                Storage::disk(self::LOCAL_DISK)->put($path_tree, File::get($fot3));
            }

            if ($cab_video) {
                $path_video = self::DIR_PATH.$request->cab_nombre.'/video.mp4';
                Storage::disk(self::LOCAL_DISK)->put($path_video, File::get($cab_video));
            }

            $response = Caballo::create([
                'cab_nombre' => $request['cab_nombre'],
                'cab_capa' => $request['cab_capa'],
                'cab_nacimiento' => $request['cab_nacimiento'],
                'cab_semental' => $request['cab_semental'],
                'cab_altura' => $request['cab_altura'],
                'cab_fot1' => $path_one,
                'cab_fot2' => $path_two,
                'cab_fot3' => $path_tree,
                'cab_video' => $path_video,
                'fk_id_user' => $request['fk_id_user'],
                'fk_id_finca' => $request['fk_id_finca']
            ]);

            return $response;
    }

    public function updateCaballo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cab_id' => 'required',
            'cab_nombre' => 'required',
            'cab_capa' => 'required',
            'cab_semental' => 'required',
            'fk_id_user' => 'required',
            'fk_id_finca' => 'required'
        ]);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => 'Datos invalidos'], 404);

        $fot1 =  $request->file('cab_fot1');
        $fot2 =  $request->file('cab_fot2');
        $fot3 =  $request->file('cab_fot3');
        $cab_video =  $request->file('cab_video');

        $update = Caballo::where('cab_id', $request['cab_id'])->first();

        $path_one = $request->cab_fot1;
        $path_two = $request->cab_fot2;
        $path_tree = $request->cab_fot3;
        $path_video = $request->cab_video;

        if ($fot1) {
            $path_one = self::DIR_PATH.$request->cab_nombre.'/fotOne.png';
            Storage::disk(self::LOCAL_DISK)->put($path_one, File::get($fot1));
        }

        if ($fot2) {
            $path_two = self::DIR_PATH.$request->cab_nombre.'/fotTwo.png';
            Storage::disk(self::LOCAL_DISK)->put($path_two, File::get($fot2));
        }

        if ($fot3) {
            $path_tree = self::DIR_PATH.$request->cab_nombre.'/fotTree.png';
            Storage::disk(self::LOCAL_DISK)->put($path_tree, File::get($fot3));
        }

        if ($cab_video) {
            $path_video = self::DIR_PATH.$request->cab_nombre.'/video.mp4';
            Storage::disk(self::LOCAL_DISK)->put($path_video, File::get($cab_video));
        }

        $data = [
            'cab_nombre' => $request['cab_nombre'],
            'cab_capa' => $request['cab_capa'],
            'cab_nacimiento' => $request['cab_nacimiento'],
            'cab_semental' => $request['cab_semental'],
            'cab_altura' => $request['cab_altura'],
            'cab_fot1' => $path_one,
            'cab_fot2' => $path_two,
            'cab_fot3' => $path_tree,
            'cab_video' => $path_video,
            'fk_id_user' => $request['fk_id_user'],
            'fk_id_finca' => $request['fk_id_finca']
        ];

        $update->update($data);

       if (!is_null($update)) {
            return $update;
        }

        return response()->json(['response' => false], 401);
    }

    public function deleteCaballo(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'cab_id' => 'required'
            ]);

            $data = $request->json()->all();

            $delete = Caballo::where('cab_id', $data['cab_id'])->first();

            if (isset($delete)) {
                $foto1 = $delete->cab_fot1;
                $foto2 = $delete->cab_fot2;
                $foto3 = $delete->cab_fot3;
                $video = $delete->cab_video;

                $name_foto1 = substr($foto1, 83);
                $name_foto2 = substr($foto2, 83);
                $name_foto3 = substr($foto3, 83);
                $name_video = substr($video, 83);

                Storage::disk('fotos_caballos')->delete([$name_foto1, $name_foto2, $name_foto3]);
                Storage::disk('video_caballos')->delete($name_video);

                $delete->delete();
                return response()->json(['response' => true], 200);
            }

            return response()->json(['response' => false], 401);
        }

        return response()->json(['response' => false], 401);
    }

    public function viewFile(Request $request) {

        if (Storage::disk(self::LOCAL_DISK)->exists($request->nameFile)) {
            $rest = substr($request->nameFile, -3);
            $file = Storage::disk(self::LOCAL_DISK)->get($request->nameFile);

            if ($rest == 'mp4')
                return response($file)->header('Content-Type', 'video/mp4');

            return $file;


        }

        return response()->json(['status' => false, 'message' => 'Recurso no encontrado'], 404);


    }
}

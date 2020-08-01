<?php

namespace App\Http\Controllers;

use App\Caballo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CaballoController extends Controller
{
    public function getCaballos(Request $request) {
        if ($request->isJson()) {
            return Caballo::all();
        }

        return response()->json(['response' => false], 401);
    }

    public function addCaballo(Request $request) {

            $this->validate($request, [
                'cab_nombre' => 'required',
                'cab_capa' => 'required',
                'cab_nacimiento' => 'required',
                'cab_semental' => 'required',
                'cab_fot1' => 'required',
                'cab_fot2' => 'required',
                'cab_fot3' => 'required',
                'cab_video' => 'required',
                'fk_id_user' => 'required',
                'fk_id_finca' => 'required'
            ]);

            $fot1 =  $request->file('cab_fot1');
            $fot2 =  $request->file('cab_fot2');
            $fot3 =  $request->file('cab_fot3');
            $cab_video =  $request->file('cab_video');

            if ($fot1) {
                $name1 = str_replace(' ', '_', time().$fot1->getClientOriginalName());
                Storage::disk('fotos_caballos')->put($name1,File::get($fot1));
                $url_img1 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_caballos/'.$name1;
            } else {
                $url_img1 = 'http://google.com';
            }

            if ($fot2) {
                $name2 = str_replace(' ', '_', time().$fot2->getClientOriginalName());
                Storage::disk('fotos_caballos')->put($name2,File::get($fot2));
                $url_img2 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_caballos/'.$name2;
            } else {
                $url_img2 = 'http://google.com';
            }

            if ($fot3) {
                $name3 = str_replace(' ', '_', time().$fot3->getClientOriginalName());
                Storage::disk('fotos_caballos')->put($name3,File::get($fot3));
                $url_img3 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_caballos/'.$name3;
            } else {
                $url_img3 = 'http://google.com';
            }

        if ($cab_video) {
            $nameVideo = str_replace(' ', '_', time().$cab_video->getClientOriginalName());
            Storage::disk('video_caballos')->put($nameVideo,File::get($cab_video));
            $url_video = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/video_caballos/'.$nameVideo;
        } else {
            $url_video = 'http://google.com';
        }

            $response = Caballo::create([
                'cab_nombre' => $request['cab_nombre'],
                'cab_capa' => $request['cab_capa'],
                'cab_nacimiento' => $request['cab_nacimiento'],
                'cab_semental' => $request['cab_semental'],
                'cab_fot1' => $url_img1,
                'cab_fot2' => $url_img2,
                'cab_fot3' => $url_img3,
                'cab_video' => $url_video,
                'fk_id_user' => $request['fk_id_user'],
                'fk_id_finca' => $request['fk_id_finca']
            ]);

            return $response;
    }

    public function updateCaballo(Request $request) {
        if ($request->isJson()) {
            $this->validate($request, [
                'cab_id' => 'required',
                'cab_nombre' => 'required',
                'cab_capa' => 'required',
                'cab_nacimiento' => 'required',
                'cab_semental' => 'required',
                'cab_fot1' => 'required',
                'cab_fot2' => 'required',
                'cab_fot3' => 'required',
                'cab_video' => 'required',
                'fk_id_user' => 'required',
                'fk_id_finca' => 'required'
            ]);

            $data = $request->json()->all();

            $update = Caballo::where('cab_id', $data['cab_id'])->update($data);

            if ($update == 1) {
                return $data;
            }

            return response()->json(['response' => false], 401);
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
}

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
                $url_img1 = $request['cab_fot1'];
            }

            if ($fot2) {
                $name2 = str_replace(' ', '_', time().$fot2->getClientOriginalName());
                Storage::disk('fotos_caballos')->put($name2,File::get($fot2));
                $url_img2 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_caballos/'.$name2;
            } else {
                $url_img2 = $request['cab_fot2'];
            }

            if ($fot3) {
                $name3 = str_replace(' ', '_', time().$fot3->getClientOriginalName());
                Storage::disk('fotos_caballos')->put($name3,File::get($fot3));
                $url_img3 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_caballos/'.$name3;
            } else {
                $url_img3 = $request['cab_fot3'];
            }

        if ($cab_video) {
            $nameVideo = str_replace(' ', '_', time().$cab_video->getClientOriginalName());
            Storage::disk('video_caballos')->put($nameVideo,File::get($cab_video));
            $url_video = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/video_caballos/'.$nameVideo;
        } else {
            $url_video = $request['cab_video'];
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

    public function updateCaballo(Request $request)
    {
        $this->validate($request, [
            'cab_id' => 'required',
            'cab_nombre' => 'required',
            'cab_capa' => 'required',
            'cab_nacimiento' => 'required',
            'cab_semental' => 'required',
            'fk_id_user' => 'required',
            'fk_id_finca' => 'required'
        ]);

        $fot1 =  $request->file('cab_fot1');
        $fot2 =  $request->file('cab_fot2');
        $fot3 =  $request->file('cab_fot3');
        $cab_video =  $request->file('cab_video');

        $update = Caballo::where('cab_id', $request['cab_id'])->first();

        if ($fot1) {
            $name1 = str_replace(' ', '_', time().$fot1->getClientOriginalName());
            Storage::disk('fotos_caballos')->put($name1,File::get($fot1));
            $url_img1 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_caballos/'.$name1;

            $foto1 = $update->cab_fot1;
            $name_foto1 = substr($foto1, 83);
            Storage::disk('fotos_caballos')->delete($name_foto1);
        } else {
            $url_img1 = $request['cab_fot1'];
        }

        if ($fot2) {
            $name2 = str_replace(' ', '_', time().$fot2->getClientOriginalName());
            Storage::disk('fotos_caballos')->put($name2,File::get($fot2));
            $url_img2 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_caballos/'.$name2;

            $foto2 = $update->cab_fot2;
            $name_foto2 = substr($foto2, 83);
            Storage::disk('fotos_caballos')->delete($name_foto2);
        } else {
            $url_img2 = $request['cab_fot2'];
        }

        if ($fot3) {
            $name3 = str_replace(' ', '_', time().$fot3->getClientOriginalName());
            Storage::disk('fotos_caballos')->put($name3,File::get($fot3));
            $url_img3 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_caballos/'.$name3;

            $foto3 = $update->cab_fot3;
            $name_foto3 = substr($foto3, 83);
            Storage::disk('fotos_caballos')->delete($name_foto3);
        } else {
            $url_img3 = $request['cab_fot3'];
        }

        if ($cab_video) {
            $nameVideo = str_replace(' ', '_', time().$cab_video->getClientOriginalName());
            Storage::disk('video_caballos')->put($nameVideo,File::get($cab_video));
            $url_video = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/video_caballos/'.$nameVideo;

            $video = $update->cab_video;
            $name_video = substr($video, 83);
            Storage::disk('video_caballos')->delete($name_video);
        } else {
            $url_video = $request['cab_video'];
        }

        $data = [
            'cab_nombre' => $request['cab_nombre'],
            'cab_capa' => $request['cab_capa'],
            'cab_nacimiento' => $request['cab_nacimiento'],
            'cab_semental' => $request['cab_semental'],
            'cab_fot1' => $url_img1,
            'cab_fot2' => $url_img2,
            'cab_fot3' => $url_img3,
            'cab_video' => $url_video,
            'fk_id_user' => $request['fk_id_user'],
            'fk_id_finca' => $request['fk_id_finca'],
        ];

        $update->update($data);

       if ($update) {
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
}

<?php

namespace App\Http\Controllers;

use App\Yegua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class YeguaController extends Controller
{
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
            $this->validate($request, [
                'yeg_nombre' => 'required',
                'yeg_capa' => 'required',
                'yeg_nacimiento' => 'required',
                'yeg_semental' => 'required',
                'fk_id_user' => 'required',
                'fk_id_finca' => 'required'
            ]);

        $fot1 =  $request->file('yeg_fot1');
        $fot2 =  $request->file('yeg_fot2');
        $fot3 =  $request->file('yeg_fot3');
        $yeg_video =  $request->file('yeg_video');

        if ($fot1) {
            $name1 = str_replace(' ', '_', time().$fot1->getClientOriginalName());
            Storage::disk('fotos_yeguas')->put($name1,File::get($fot1));
            $url_img1 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_yeguas/'.$name1;
        } else {
            $url_img1 = $request['yeg_fot1'];
        }

        if ($fot2) {
            $name2 = str_replace(' ', '_', time().$fot2->getClientOriginalName());
            Storage::disk('fotos_yeguas')->put($name2,File::get($fot2));
            $url_img2 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_yeguas/'.$name2;
        } else {
            $url_img2 = $request['yeg_fot2'];
        }

        if ($fot3) {
            $name3 = str_replace(' ', '_', time().$fot3->getClientOriginalName());
            Storage::disk('fotos_yeguas')->put($name3,File::get($fot3));
            $url_img3 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_yeguas/'.$name3;
        } else {
            $url_img3 = $request['yeg_fot3'];
        }

        if ($yeg_video) {
            $nameVideo = str_replace(' ', '_', time().$yeg_video->getClientOriginalName());
            Storage::disk('video_yeguas')->put($nameVideo,File::get($yeg_video));
            $url_video = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/video_yeguas/'.$nameVideo;
        } else {
            $url_video = $request['yeg_video'];
        }

            $add = Yegua::create([
                'yeg_nombre' => $request['yeg_nombre'],
                'yeg_capa' => $request['yeg_capa'],
                'yeg_nacimiento' => $request['yeg_nacimiento'],
                'yeg_semental' => $request['yeg_semental'],
                'yeg_fot1' => $url_img1,
                'yeg_fot2' => $url_img2,
                'yeg_fot3' => $url_img3,
                'yeg_video' => $url_video,
                'fk_id_user' => $request['fk_id_user'],
                'fk_id_finca' => $request['fk_id_finca']
            ]);

            return $add;

    }

    public function updateYegua(Request $request) {

            $this->validate($request, [
                'yeg_id' => 'required',
                'yeg_nombre' => 'required',
                'yeg_capa' => 'required',
                'yeg_nacimiento' => 'required',
                'yeg_semental' => 'required',
                'fk_id_user' => 'required',
                'fk_id_finca' => 'required'
            ]);

        $fot1 =  $request->file('yeg_fot1');
        $fot2 =  $request->file('yeg_fot2');
        $fot3 =  $request->file('yeg_fot3');
        $yeg_video =  $request->file('yeg_video');

        $update = Yegua::where('yeg_id', $request['yeg_id'])->first();

        if ($fot1) {
            $name1 = str_replace(' ', '_', time().$fot1->getClientOriginalName());
            Storage::disk('fotos_yeguas')->put($name1,File::get($fot1));
            $url_img1 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_yeguas/'.$name1;

            $foto1 = $update->yeg_fot1;
            $name_foto1 = substr($foto1, 81);
            Storage::disk('fotos_yeguas')->delete($name_foto1);
        } else {
            $url_img1 = $request['yeg_fot1'];
        }

        if ($fot2) {
            $name2 = str_replace(' ', '_', time().$fot2->getClientOriginalName());
            Storage::disk('fotos_yeguas')->put($name2,File::get($fot2));
            $url_img2 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_yeguas/'.$name2;

            $foto2 = $update->yeg_fot2;
            $name_foto2 = substr($foto2, 81);
            Storage::disk('fotos_yeguas')->delete($name_foto2);
        } else {
            $url_img2 = $request['yeg_fot2'];
        }

        if ($fot3) {
            $name3 = str_replace(' ', '_', time().$fot3->getClientOriginalName());
            Storage::disk('fotos_yeguas')->put($name3,File::get($fot3));
            $url_img3 = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/fotos_yeguas/'.$name3;

            $foto3 = $update->yeg_fot3;
            $name_foto3 = substr($foto3, 81);
            Storage::disk('fotos_yeguas')->delete($name_foto3);
        } else {
            $url_img3 = $request['yeg_fot3'];
        }

        if ($yeg_video) {
            $nameVideo = str_replace(' ', '_', time().$yeg_video->getClientOriginalName());
            Storage::disk('video_yeguas')->put($nameVideo,File::get($yeg_video));
            $url_video = 'http://'.$_SERVER['SERVER_NAME'].'/yeguadaSanRafaelBack/storage/app/public/video_yeguas/'.$nameVideo;

            $video = $update->yeg_video;
            $name_video = substr($video, 81);
            Storage::disk('video_yeguas')->delete($name_video);
        } else {
            $url_video = $request['yeg_video'];
        }

        $data = [
            'yeg_nombre' => $request['yeg_nombre'],
            'yeg_capa' => $request['yeg_capa'],
            'yeg_nacimiento' => $request['yeg_nacimiento'],
            'yeg_semental' => $request['yeg_semental'],
            'yeg_fot1' => $url_img1,
            'yeg_fot2' => $url_img2,
            'yeg_fot3' => $url_img3,
            'yeg_video' => $url_video,
            'fk_id_user' => $request['fk_id_user'],
            'fk_id_finca' => $request['fk_id_finca'],
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InfoWeb;

class ResourcesController extends Controller
{
    public function contacto(Request $request) {
        $inf = InfoWeb::where('inf_id', 1)->first();
        $mail = $inf->inf_email;
        //validar json
        if ($request->isJson() && $mail) {
            ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $from = $request->email;
            $to = $mail;
            $subject = "Mensaje de contacto Yeguada San Rafael";
            $message = "Nombre: $request->name \n";
            $message .= "Mensaje: $request->message";
            $headers = "From:" . $from;
            mail($to,$subject,$message, $headers);

            return response()->json(['response' => true], 200);

        }
        return response()->json(['response' => false], 401);
    }
}

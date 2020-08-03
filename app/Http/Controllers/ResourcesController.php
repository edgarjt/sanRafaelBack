<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    public function contacto(Request $request) {
        //validar json
        if ($request->isJson()) {
            ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $from = $request->email;
            $to = "edgarjt97@gmail.com";
            $subject = "Mensaje de contacto Yeguada San Rafael";
            $message = $request->message;
            $headers = "From:" . $from;
            mail($to,$subject,$message, $headers);

            return response()->json(['response' => true], 200);

        }
        return response()->json(['response' => false], 401);
    }
}

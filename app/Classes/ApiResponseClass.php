<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiResponseClass
{
    public static function rollback($e, $message = "Quelque chose s'est mal passé ! Processus non terminé")
    {
        DB::rollBack();
        self::throw($e, $message);
    }

    public static function throw($e, $message = "Quelque chose s'est mal passé ! Processus non terminé")
    {
        Log::info($e);
        throw new HttpResponseException(response()->json(["message" => $message], 500));
    }

    public static function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result
        ];
        if (!empty($message)) {
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }
}

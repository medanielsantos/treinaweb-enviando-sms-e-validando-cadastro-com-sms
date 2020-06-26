<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SMS\SmsServiceInterface;


class SmsVerificationController extends Controller
{
    public function send(string $celNumber, SmsServiceInterface $smsService)
    {
        $code = \mt_rand(1000, 9999);

        session(['code' => $code]);

        $response = $smsService->send(
            $celNumber, 
            "Seu codigo de verificacao e: $code"
        );

        if ($response == 200) {
            return 'enviado';
        }

        return response('nao-enviado', $response);
    }
}

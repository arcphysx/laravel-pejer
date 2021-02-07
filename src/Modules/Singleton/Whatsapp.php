<?php

namespace Arcphysx\LaravelPejer\Modules\Singleton;

use Arcphysx\LaravelPejer\LaravelPejer;
use Arcphysx\LaravelPejer\Modules\Contract\HttpClientModuleContract;
use Arcphysx\LaravelPejer\Modules\Wrapper\ResponseWrapper;

class Whatsapp implements HttpClientModuleContract
{
    private static $INSTANCE = null;

    private function __construct(){
        //
    }

    public static function _get()
    {
        if(self::$INSTANCE == null){
            self::$INSTANCE = new Whatsapp();
        }
        return self::$INSTANCE;
    }

    public function sendMessage($to, $message, $type="chat")
    {
        $response = LaravelPejer::httpClient()->post("teams/".LaravelPejer::teamId()."/messages", [
            'form_params' => [
                'to' => $to,
                'type' => $type,
                'body' => $message
            ]
        ]);

        return ResponseWrapper::parse($response);
    }
    
    public function validateAccountExist($phoneNumber)
    {
        $response = LaravelPejer::httpClient()->get("teams/".LaravelPejer::teamId()."/account-exists", [
            'query' => [
                'number' => $phoneNumber
            ]
        ]);

        return ResponseWrapper::parse($response);
    }
}
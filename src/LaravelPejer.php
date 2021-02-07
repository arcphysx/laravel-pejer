<?php

namespace Arcphysx\LaravelPejer;

use GuzzleHttp\Client;
use Arcphysx\LaravelPejer\Modules\Singleton\RequestHandler;
use Arcphysx\LaravelPejer\Modules\Singleton\Whatsapp;

class LaravelPejer
{

    /**
     * The Base API URL.
     *
     * @return string
     */
    public static function baseUrl()
    {
        return config('laravelpejer.base_url');
    }

    /**
     * The Google API Client ID.
     *
     * @return string
     */
    public static function apiToken()
    {
        return config('laravelpejer.api_token');
    }

    /**
     * The Google API Client ID.
     *
     * @return string
     */
    public static function teamId()
    {
        return config('laravelpejer.team_id');
    }

    /**
     * The global Curl client.
     *
     * @return Client
     */
    public static function httpClient($upload=false)
    {   
        return new Client([
            'base_uri' => LaravelPejer::baseUrl(),
            'handler' => RequestHandler::_get()->handler()
        ]);
    }

    /**
     * The global Whatsapp singleton.
     *
     * @return Whatsapp
     */
    public static function whatsapp()
    {
        return Whatsapp::_get();
    }

}
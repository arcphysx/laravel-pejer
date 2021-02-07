<?php

namespace Arcphysx\LaravelPejer\Modules\Singleton;

use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Arcphysx\LaravelPejer\LaravelPejer;
use Arcphysx\LaravelPejer\Modules\Contract\HttpClientModuleContract;

class RequestHandler implements HttpClientModuleContract
{
    private static $INSTANCE = null;

    private $handlerStack = null;

    private function __construct(){
        $this->handlerStack = new HandlerStack();
        $this->handlerStack->setHandler(new CurlHandler());
    }

    public static function _get()
    {
        if(self::$INSTANCE == null){
            self::$INSTANCE = new RequestHandler();
        }
        return self::$INSTANCE;
    }

    public function handler()
    {
        $this->setGlobalRequestConfig();
        return $this->handlerStack;
    }
    
    private function setGlobalRequestConfig()
    {
        $this->appendAcceptJsonHeader();
        $this->appendAuthorizationHeader();
    }

    private function appendAcceptJsonHeader()
    {
        $this->handlerStack->push(Middleware::mapRequest(function (RequestInterface $request) {
            return $request->withHeader('Accept', 'application/json');
        }));
    }

    private function appendAuthorizationHeader()
    {
        $this->handlerStack->push(Middleware::mapRequest(function (RequestInterface $request) {
            return $request->withHeader('Authorization', 'Bearer '.LaravelPejer::apiToken());
        }));
    }
}
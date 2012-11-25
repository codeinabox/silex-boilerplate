<?php

namespace MyApp\Controllers;

use Silex\Application as SilexApplication;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Exception;

class MainControllerProvider implements ControllerProviderInterface {

    protected $app;

    public function connect(SilexApplication $app) {
        $this->app = $app;
        $controllers = $this->app['controllers_factory'];
        $controllers->get('/', array($this, 'indexAction'));
        return $controllers;
    }
    
    public function indexAction(Request $request) {
        return new Response('Hello there '.$request->getClientIp(). ' running on '.APP_ENV);
    }

}
<?php

namespace MyApp;

use Silex\Application as SilexApplication;
use Monolog\Logger;
use MyApp\Monolog\ErrorlogHandler;
use MyApp\Provider\ZendConfigServiceProvider;
use \Exception;

class Application extends SilexApplication {

    public function __construct() {
        parent::__construct();
        $this->_registerDependencies();
        $this->_registerRoutes();
    }

    protected function _registerDependencies() {
        $app = $this;
        
        if(!defined('APP_ENV')) {
            throw new Exception('The constant APP_ENV is not defined');
        }

        // Config
        $this->register(
            new ZendConfigServiceProvider(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.json'),
            array()
        );

        // Logger
        $this['monolog.level'] = $this->isProduction() ? Logger::ERROR : Logger::DEBUG;
        $this->register(new \Silex\Provider\MonologServiceProvider(), array(
            'monolog.name' => 'App',
            'monolog.handler' => function () use ($app) {
                return new ErrorlogHandler($app['monolog.level']);
            }
        ));
        if (!$this->isProduction()) {
            $this['monolog']->pushHandler(new \Monolog\Handler\FirePHPHandler());
            $this['monolog']->pushHandler(new \Monolog\Handler\ChromePHPHandler());
        }
    }

    public function getLogger() {
        return $this['monolog'];
    }

    public function isProduction() {
        $env = defined('APP_ENV') ? constant('APP_ENV') : 'live';
        return $env == 'live';
    }

    protected function _registerRoutes() {
        $this->mount('/', new Controllers\MainControllerProvider());
    }

}

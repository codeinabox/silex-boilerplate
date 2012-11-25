<?php

namespace MyApp\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use \Exception;
use Zend\Config\Factory as ConfigFactory;
use Zend\Config\Config;

class ZendConfigServiceProvider implements ServiceProviderInterface {
    
    protected $filepath;
    
    public function __construct($filepath) {
        $this->filepath = $filepath;
    }

    public function register(Application $app) {
        $config = ConfigFactory::fromFile($this->filepath, true);
        $config->setReadOnly();
        $app['config'] = $config;
        if(($debug = $config->get('debug') !== null)) {
            $app['debug'] = $debug;
        }
    }

    public function boot(Application $app) {
        
    }

}

<?php

namespace ApplicationTest;

use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfig;

/**
 * Bootstrap class to set up Zend Framework 2 to integrate with PHPUnit.
 */
class Bootstrap
{

    /**
     * @var ServiceManager
     */
    public static $serviceManager;

    /**
     * Carry on the setup
     */
    public static function go()
    {
        // Make everything relative to the root
        chdir(dirname(__DIR__));

        // Setup autoloading
        require_once( __DIR__ . '/../vendor/autoload.php' );

        // Run application
        $config = require('config/application.config.php');
        \Zend\Mvc\Application::init($config);

        // Create the service manager and load modules
        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();

        // Make service manager available for tests
        self::$serviceManager = $serviceManager;
    }

    /**
     * @return ServiceManager
     */
    public static function getServiceManager()
    {
        return self::$serviceManager;
    }

}

Bootstrap::go();

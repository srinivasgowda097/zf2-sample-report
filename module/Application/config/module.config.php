<?php

return array(
    /**
     * Console Router
     */
    'console' => array(
        'router' => array(
            'routes' => array(
                'report' => array(
                    'options' => array(
                        'route' => 'report <id>',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action' => 'index',
                        ),
                    ),
                ),
            ),
        ),
    ),
    /**
     * Service Manager
     */
    'service_manager' => array(
        'invokables' => array(
            'ReportService' => 'Application\Service\ReportService',
            'ExchangeService' => 'Application\Service\ExchangeService',
        ),
        'factories' => array(
            'DoctrineHydrator' => 'Application\Service\DoctrineHydratorFactory',
        ),
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
    ),
    /**
     * Controllers
     */
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'Application' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Application/Model')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application\Model' => 'Application',
                ),
            ),
        ),
    ),
);

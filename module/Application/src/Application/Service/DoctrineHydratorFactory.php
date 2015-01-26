<?php

namespace Application\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class DoctrineHydratorFactory implements FactoryInterface
{

    /**
     * Create Doctrine Hydrator.
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return DoctrineHydrator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $hydrator = new DoctrineHydrator($entityManager);

        return $hydrator;
    }

}

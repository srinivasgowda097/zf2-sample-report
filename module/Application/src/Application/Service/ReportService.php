<?php

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Service\ExchangeServiceInterface;
use Application\Model\Merchant;
use Application\Model\Report\TransactionsReport;

class ReportService implements ServiceLocatorAwareInterface
{

    /**
     * Namespace for entity classes
     */
    const ENTITY_NAMESPACE = 'Application\Model';

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var ExchangeServiceInterface
     */
    protected $exchangeService;

    /**
     * @var array
     */
    protected $repositories = array();

    /**
     * Set service locator
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     * 
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Get Doctrine Entity Manager.
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager');
        }
        return $this->entityManager;
    }

    /**
     * Get exchange service
     * 
     * @return ExchangeServiceInterface
     */
    public function getExchangeService()
    {
        if (null === $this->exchangeService) {
            $this->exchangeService = $this->getServiceLocator()->get('ExchangeService');
        }
        return $this->exchangeService;
    }

    public function __call($name, $arguments)
    {
        if (preg_match('/^(get)(\w+)(Repository)$/', $name, $matches)) {
            $entityClass = self::ENTITY_NAMESPACE . '\\' . $matches[2];
            if (class_exists($entityClass)) {
                return $this->getEntityManager()->getRepository($entityClass);
            }
        }
    }

    /**
     * Get report with all transactions for a given merchant.
     * 
     * @param int $id
     * @return TransactionsReport
     */
    public function getTransactionsReport($id)
    {
        // Find required merchant
        $merchant = $this->getMerchantRepository()->findOneById($id);
        if (!$merchant) {
            throw new \InvalidArgumentException('Merchant not found: ' . $id);
        }

        // Found transactions for this merchant
        $transactions = $this->getTransactionRepository()->findByMerchant($merchant);

        // Exchange service
        $exchangeService = $this->getExchangeService();

        // Report object
        /* @var $report Application\Model\Report\TransactionsReport */
        $report = new TransactionsReport($transactions, $exchangeService, $merchant);

        return $report;
    }

}

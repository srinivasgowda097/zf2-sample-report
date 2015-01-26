<?php

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Model\Currency;

class ExchangeService implements ExchangeServiceInterface, ServiceLocatorAwareInterface
{

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * 'Today' exchange rates...
     * @var array
     */
    protected $rates = array(
        'GBP' => 1,
        'EUR' => 0.75084,
        'USD' => 0.66618,
    );

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
     * Get exchange rate for a given currency.
     * 
     * @param Currency $currency
     * @return float
     * @throws \InvalidArgumentException
     */
    public function getRate(Currency $currency)
    {
        $code = $currency->getCode();

        if (!isset($this->rates[$code])) {
            throw new \InvalidArgumentException('Invalid currency code: ' . $code);
        }

        return (float) $this->rates[$code];
    }

    /**
     * Convert some amount in a given currency to GBP.
     * 
     * @param float $amount
     * @param Currency $currency
     * @return float 
     */
    public function convert($amount, Currency $currency)
    {
        $rate = $this->getRate($currency);
        return $amount * $rate;
    }

}

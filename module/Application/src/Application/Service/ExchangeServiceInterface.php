<?php

namespace Application\Service;

use Application\Model\Currency;

interface ExchangeServiceInterface
{

    /**
     * Get exchange rate for a given currency.
     * 
     * @param Currency $currency
     * @return float
     * @throws \InvalidArgumentException
     */
    public function getRate(Currency $currency);

    /**
     * Convert some amount in a given currency to GBP.
     * 
     * @param float $amount
     * @param Currency $currency
     * @return float 
     */
    public function convert($amount, Currency $currency);
}

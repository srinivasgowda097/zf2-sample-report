<?php

namespace Application\Model\Report;

use Application\Service\ExchangeServiceInterface;
use Application\Model\Merchant;
use Application\Model\Transaction;

class TransactionsReport extends AbstractReport
{

    /**
     * Columns headers
     */
    const DATE_HEADER = 'Date';
    const AMOUNT_HEADER = 'Amount';

    /**
     * Columns length
     */
    const DATE_LENGTH = 10;
    const AMOUNT_LENGTH = 14;

    /**
     * Date format
     */
    const DATE_FORMAT = 'Y-m-d';

    /**
     * Currency formats for GBP
     */
    const CURRENCY_SYMBOL = '£';
    const CURRENCY_DECIMALS = 2;

    /**
     * @var ExchangeServiceInterface
     */
    protected $exchangeService;

    /**
     * @var Merchant
     */
    protected $merchant;

    /**
     * Class constructor, requires all dependencies on object instantiation.
     * 
     * @param array $collection
     * @param ExchangeServiceInterface $exchangeService
     * @param Merchant $merchant
     */
    public function __construct(array $collection, ExchangeServiceInterface $exchangeService, Merchant $merchant)
    {
        parent::__construct($collection);
        $this->exchangeService = $exchangeService;
        $this->merchant = $merchant;
    }

    /**
     * Returns report in text format.
     * 
     * @return string
     */
    public function toText()
    {
        // Let's collect each line of the report as an array element
        $lines = array();

        // Report head
        $header = sprintf('Transactions Report for "%s" (ID: %d)', 
                $this->merchant->getName(), $this->merchant->getId());
        $lines[] = $header;
        $lines[] = str_repeat('=', strlen($header));

        // Blank line
        $lines[] = '';

        // Transactions count
        $lines[] = sprintf('Total: %d transaction(s) found.', $this->count());

        // Blank line
        $lines[] = '';

        // Table headers
        $lines[] = sprintf('%s %s', str_pad(self::DATE_HEADER, self::DATE_LENGTH, ' '), str_pad(self::AMOUNT_HEADER, self::AMOUNT_LENGTH, ' '));
        $lines[] = sprintf('%s %s', str_repeat('-', self::DATE_LENGTH), str_repeat('-', self::AMOUNT_LENGTH));

        // Table rows
        /* @var $transaction \Application\Model\Transaction */
        foreach ($this->collection as $transaction) {
            $lines[] = sprintf(
                    '%s %s', 
                    str_pad($this->getTransactionDate($transaction), self::DATE_LENGTH, ' ', STR_PAD_BOTH), 
                    str_pad($this->getTransactionAmount($transaction), self::AMOUNT_LENGTH + 1, ' ', STR_PAD_LEFT)
            );
        }

        // Glue all lines with a line break
        $text = implode(PHP_EOL, $lines) . PHP_EOL;

        return $text;
    }

    /**
     * Returns formatted transaction date.
     * 
     * @param Transaction $transaction
     * @return string
     */
    public function getTransactionDate(Transaction $transaction)
    {
        $date = $transaction->getCreatedDate();
        return $date->format(self::DATE_FORMAT);
    }

    /**
     * Returns formatted transaction amount as GBP value.
     * 
     * @param Transaction $transaction
     * @return string
     */
    public function getTransactionAmount(Transaction $transaction)
    {
        $amount = $this->exchangeService->convert($transaction->getValue(), $transaction->getCurrency());
        return self::CURRENCY_SYMBOL . number_format($amount, self::CURRENCY_DECIMALS);
    }

}

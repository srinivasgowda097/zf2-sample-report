<?php

namespace ApplicationTest\Model;

use Application\Model\Merchant;
use Application\Model\Transaction;
use Doctrine\Common\Collections\Collection;

/**
 * MerchantTest
 */
class MerchantTest extends \PHPUnit_Framework_TestCase
{

    /**
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        // nothing to do
    }

    /**
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        // nothing to do
    }

    /**
     * @covers Application\Model\Merchant::__construct
     * @covers Application\Model\Merchant::getTransactions
     */
    public function testConstruct()
    {
        $merchant = new Merchant();
        $this->assertInstanceOf('Doctrine\Common\Collections\Collection', $merchant->getTransactions());
    }

    /**
     * @covers Application\Model\Merchant::getId
     */
    public function testGetId()
    {
        $merchant = new Merchant();
        $this->assertNull($merchant->getId());
    }

    /**
     * @covers Application\Model\Merchant::setName
     * @covers Application\Model\Merchant::getName
     */
    public function testSetGetName()
    {
        $name = 'Merchant Name';
        $merchant = new Merchant();
        $merchant->setName($name);
        $this->assertEquals($name, $merchant->getName());
    }

    /**
     * @covers Application\Model\Merchant::addTransaction
     */
    public function testAddTransaction()
    {
        $merchant = new Merchant();
        $this->assertEquals(0, $merchant->getTransactions()->count());
        $transaction = new Transaction();
        $merchant->addTransaction($transaction);
        $this->assertEquals(1, $merchant->getTransactions()->count());
    }

    /**
     * @covers Application\Model\Merchant::removeTransaction
     */
    public function testRemoveTransaction()
    {
        $merchant = new Merchant();
        $transaction = new Transaction();
        $merchant->addTransaction($transaction);
        $this->assertEquals(1, $merchant->getTransactions()->count());
        $merchant->removeTransaction($transaction);
        $this->assertEquals(0, $merchant->getTransactions()->count());
    }

}

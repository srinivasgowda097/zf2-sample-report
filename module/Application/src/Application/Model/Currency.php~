<?php

namespace Application\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currency
 * 
 * @ORM\Entity
 */
class Currency
{

    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var strinc
     * @ORM\Column(type="string", unique=true)
     */
    private $code;

    /**
     * @var strinc
     * @ORM\Column(type="string", nullable=true)
     */
    private $symbol;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="merchant", cascade={"remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"created_date" = "DESC"})
     */
    private $transactions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transactions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Currency
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set symbol
     *
     * @param string $symbol
     * @return Currency
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string 
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Add transactions
     *
     * @param \Application\Model\Transaction $transactions
     * @return Currency
     */
    public function addTransaction(\Application\Model\Transaction $transactions)
    {
        $this->transactions[] = $transactions;

        return $this;
    }

    /**
     * Remove transactions
     *
     * @param \Application\Model\Transaction $transactions
     */
    public function removeTransaction(\Application\Model\Transaction $transactions)
    {
        $this->transactions->removeElement($transactions);
    }

    /**
     * Get transactions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
}

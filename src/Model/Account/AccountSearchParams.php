<?php

namespace Localfr\AgendizeClientBundle\Model\Account;

/**
 * Account Search Params
 */
class AccountSearchParams
{
    /**
     * AccountSearchParams search attribute
     * 
     * @var null|string
     */
    public $search = null;

    /**
     * AccountSearchParams tools attribute
     * 
     * @var null|string
     */
    public $tools = null;

    /**
     * AccountSearchParams status attribute
     * 
     * @var null|string
     */
    public $status = null;

    /**
     * AccountSearchParams createdStartDate attribute
     * 
     * @var null|\DateTimeInterface
     */
    public $createdStartDate = null;

    /**
     * AccountSearchParams createdEndDate attribute
     * 
     * @var null|\DateTimeInterface
     */
    public $createdEndDate = null;

    /**
     * Constructor
     * 
     * @param array|null $payload Fields
     */
    public function __construct(?array $payload = [])
    {
        $this->search = $payload['search'] ?? null;
        $this->tools = $payload['tools'] ?? null;
        $this->status = $payload['status'] ?? null;
        $this->createdStartDate = $payload['createdStartDate'] ?? null;
        $this->createdEndDate = $payload['createdEndDate'] ?? null;
    }
}
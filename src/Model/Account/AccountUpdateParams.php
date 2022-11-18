<?php

namespace Localfr\AgendizeClientBundle\Model\Account;

/**
 * Account Update Params
 */
class AccountUpdateParams
{
    /**
     * AccountUpdateParams firstName attribute
     * 
     * @var null|string
     */
    public $firstName = null;

    /**
     * AccountUpdateParams latsName attribute
     * 
     * @var null|string
     */
    public $latsName = null;

    /**
     * AccountUpdateParams currency attribute
     * 
     * @var null|string
     */
    public $currency = null;

    /**
     * AccountUpdateParams resellerId attribute
     * 
     * @var null|string
     */
    public $resellerId = null;

    /**
     * AccountUpdateParams domain attribute
     * 
     * @var null|string
     */
    public $domain = null;

    /**
     * AccountUpdateParams clientName attribute
     * 
     * @var null|string
     */
    public $clientName = null;

    /**
     * AccountUpdateParams status attribute
     * 
     * @var null|string
     */
    public $status = null;

    /**
     * AccountUpdateParams sendSignupEmail attribute
     * 
     * @var null|bool
     */
    public $sendSignupEmail = null;

    /**
     * Constructor
     * 
     * @param array|null $payload Fields
     */
    public function __construct(?array $payload = [])
    {
        $this->firstName = $payload['firstName'] ?? null;
        $this->latsName = $payload['latsName'] ?? null;
        $this->currency = $payload['currency'] ?? null;
        $this->resellerId = $payload['resellerId'] ?? null;
        $this->domain = $payload['domain'] ?? null;
        $this->clientName = $payload['clientName'] ?? null;
        $this->status = $payload['status'] ?? null;
        $this->sendSignupEmail = $payload['sendSignupEmail'] ?? null;
    }
}
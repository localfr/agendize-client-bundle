<?php

namespace Localfr\AgendizeClientBundle\Model\Account;

use Localfr\AgendizeClientBundle\Model\Profile\ProfileAccountCreateParamsParams;
use Localfr\AgendizeClientBundle\Model\Tag\TagAccountCreateParams;

/**
 * Account Create Params
 */
class AccountCreateParams
{
    /**
     * AccountCreateParams email attribute
     * 
     * @var string
     */
    public $email;

    /**
     * AccountCreateParams profile attribute
     * 
     * @var ProfileAccountCreateParamsParams
     */
    public $profile;

    /**
     * AccountCreateParams firstName attribute
     * 
     * @var null|string
     */
    public $firstName = null;

    /**
     * AccountCreateParams latsName attribute
     * 
     * @var null|string
     */
    public $latsName = null;

    /**
     * AccountCreateParams currency attribute
     * 
     * @var null|string
     */
    public $currency = null;

    /**
     * AccountCreateParams resellerId attribute
     * 
     * @var null|string
     */
    public $resellerId = null;

    /**
     * AccountCreateParams domain attribute
     * 
     * @var null|string
     */
    public $domain = null;

    /**
     * AccountCreateParams clientName attribute
     * 
     * @var null|string
     */
    public $clientName = null;

    /**
     * AccountCreateParams status attribute
     * 
     * @var null|string
     */
    public $status = null;

    /**
     * AccountCreateParams sendSignupEmail attribute
     * 
     * @var null|bool
     */
    public $sendSignupEmail = null;

    /**
     * AccountCreateParams tag attribute
     * 
     * @var null|TagAccountCreateParams
     */
    public $tag = null;

    /**
     * Constructor
     * 
     * @param array|null $payload Fields
     */
    public function __construct(?array $payload = [])
    {
        $this->email = $payload['email'] ?? null;
        $this->profile = $payload['profile'] ?? null;
        $this->firstName = $payload['firstName'] ?? null;
        $this->latsName = $payload['latsName'] ?? null;
        $this->currency = $payload['currency'] ?? null;
        $this->resellerId = $payload['resellerId'] ?? null;
        $this->domain = $payload['domain'] ?? null;
        $this->clientName = $payload['clientName'] ?? null;
        $this->status = $payload['status'] ?? null;
        $this->sendSignupEmail = $payload['sendSignupEmail'] ?? null;
        $this->tag = $payload['tag'] ?? null;
    }
}
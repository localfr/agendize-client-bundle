<?php

namespace Localfr\AgendizeClientBundle\Model\Profile;

/**
 * ProfileAccountCreateParams
 */
class ProfileAccountCreateParams
{
    /**
     * ProfileAccountCreateParams id attribute
     * 
     * @var string
     */
    public $id;

    /**
     * Constructor
     * 
     * @param array|null $payload Payload
     */
    public function __construct(?array $payload = [])
    {
        $this->id = $payload['id'] ?? null;
    }
}
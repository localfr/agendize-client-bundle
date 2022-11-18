<?php

namespace Localfr\AgendizeClientBundle\Model\Tag;

/**
 * TagAccountCreateParams
 */
class TagAccountCreateParams
{
    /**
     * Tag tag attribute
     * 
     * @var null|string
     */
    public $tag = null;

    /**
     * Tag color attribute
     * 
     * @var null|string
     */
    public $color = null;

    /**
     * Constructor
     * 
     * @param array|null $payload Payload
     */
    public function __construct(?array $payload = [])
    {
        $this->tag = $payload['tag'] ?? null;
        $this->color = $payload['color'] ?? null;
    }
}
<?php

namespace Localfr\AgendizeClientBundle\Model\Profile;

/**
 * Profile
 */
class Profile
{
    /**
     * Profile id attribute
     * 
     * @var string
     */
    private $_id;

    /**
     * Profile name attribute
     * 
     * @var string
     */
    private $_name;

    /**
     * Constructor
     * 
     * @param array|null $payload Payload
     */
    public function __construct(?array $payload = [])
    {
        $this->_id = $payload['id'] ?? null;
        $this->_name = $payload['name'] ?? null;
    }

    /**
     * Profile id attribute getter
     * 
     * @return string
     */
    public function getId(): string
    {
        return $this->_id;
    }

    /**
     * Profile id attribute setter
     * 
     * @param string $id Profile id
     * 
     * @return self
     */
    public function setId(string $id): self
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * Profile name attribute getter
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * Profile name attribute setter
     * 
     * @param string $name Profile name
     * 
     * @return self
     */
    public function setName(string $name): self
    {
        $this->_name = $name;
        return $this;
    }
}
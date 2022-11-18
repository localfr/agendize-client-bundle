<?php

namespace Localfr\AgendizeClientBundle\Model\Tag;

/**
 * Tag
 */
class Tag
{
    /**
     * Tag id attribute
     * 
     * @var string
     */
    private $_id;

    /**
     * Tag tag attribute
     * 
     * @var string
     */
    private $_tag;

    /**
     * Tag color attribute
     * 
     * @var string
     */
    private $_color;

    /**
     * Constructor
     * 
     * @param array|null $payload Payload
     */
    public function __construct(?array $payload = [])
    {
        $this->_id = $payload['id'] ?? null;
        $this->_tag = $payload['tag'] ?? null;
        $this->_color = $payload['color'] ?? null;
    }

    /**
     * Tag id attribute getter
     * 
     * @return string
     */
    public function getId(): string
    {
        return $this->_id;
    }

    /**
     * Tag id attribute setter
     * 
     * @param string $id Tag id
     * 
     * @return self
     */
    public function setId(string $id): self
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * Tag tag attribute getter
     * 
     * @return string
     */
    public function getTag(): string
    {
        return $this->_tag;
    }

    /**
     * Tag tag attribute setter
     * 
     * @param string $tag Tag tag
     * 
     * @return self
     */
    public function setTag(string $tag): self
    {
        $this->_tag = $tag;
        return $this;
    }

    /**
     * Tag color attribute getter
     * 
     * @return string
     */
    public function getColor(): string
    {
        return $this->_color;
    }

    /**
     * Tag color attribute setter
     * 
     * @param string $color Tag color
     * 
     * @return self
     */
    public function setColor(string $color): self
    {
        $this->_color = $color;
        return $this;
    }
}
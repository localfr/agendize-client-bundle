<?php

namespace Localfr\AgendizeClientBundle\Model;

/**
 * WhiteLabel
 */
class WhiteLabel
{
    /**
     * WhiteLabel logoURL attribute
     * 
     * @var string
     */
    private $_logoURL;

    /**
     * WhiteLabel emailAddress attribute
     * 
     * @var string
     */
    private $_emailAddress;

    /**
     * WhiteLabel headerBackgroundColor attribute
     * 
     * @var string
     */
    private $_headerBackgroundColor;

    /**
     * WhiteLabel menuBackgroundColor attribute
     * 
     * @var string
     */
    private $_menuBackgroundColor;

    /**
     * Constructor
     * 
     * @param array|null $payload Payload
     */
    public function __construct(?array $payload = [])
    {
        $this->_logoURL = $payload['logoURL'] ?? null;
        $this->_emailAddress = $payload['emailAddress'] ?? null;
        $this->_headerBackgroundColor = $payload['headerBackgroundColor'] ?? null;
        $this->_menuBackgroundColor = $payload['menuBackgroundColor'] ?? null;
    }

    /**
     * WhiteLabel logoURL attribute getter
     * 
     * @return string
     */
    public function getLogoURL(): string
    {
        return $this->_logoURL;
    }

    /**
     * WhiteLabel logoURL attribute setter
     * 
     * @param string $logoURL WhiteLabel logoURL
     * 
     * @return self
     */
    public function setLogoURL(string $logoURL): self
    {
        $this->_logoURL = $logoURL;
        return $this;
    }

    /**
     * WhiteLabel emailAddress attribute getter
     * 
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->_emailAddress;
    }

    /**
     * WhiteLabel emailAddress attribute setter
     * 
     * @param string $emailAddress WhiteLabel emailAddress
     * 
     * @return self
     */
    public function setEmailAddress(string $emailAddress): self
    {
        $this->_emailAddress = $emailAddress;
        return $this;
    }

    /**
     * WhiteLabel headerBackgroundColor attribute getter
     * 
     * @return string
     */
    public function getHeaderBackgroundColor(): string
    {
        return $this->_headerBackgroundColor;
    }

    /**
     * WhiteLabel headerBackgroundColor attribute setter
     * 
     * @param string $headerBackgroundColor WhiteLabel headerBackgroundColor
     * 
     * @return self
     */
    public function setHeaderBackgroundColor(string $headerBackgroundColor): self
    {
        $this->_headerBackgroundColor = $headerBackgroundColor;
        return $this;
    }

    /**
     * WhiteLabel menuBackgroundColor attribute getter
     * 
     * @return string
     */
    public function getMenuBackgroundColor(): string
    {
        return $this->_menuBackgroundColor;
    }

    /**
     * WhiteLabel menuBackgroundColor attribute setter
     * 
     * @param string $menuBackgroundColor WhiteLabel menuBackgroundColor
     * 
     * @return self
     */
    public function setMenuBackgroundColor(string $menuBackgroundColor): self
    {
        $this->_menuBackgroundColor = $menuBackgroundColor;
        return $this;
    }
}
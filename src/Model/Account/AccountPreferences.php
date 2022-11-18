<?php

namespace Localfr\AgendizeClientBundle\Model\Account;

/**
 * Account Preferences
 */
class AccountPreferences
{
    /**
     * AccountPreferences timeZone attribute
     * 
     * @var string
     */
    private $_timeZone;

    /**
     * AccountPreferences language attribute
     * 
     * @var string
     */
    private $_language;

    /**
     * AccountPreferences displayName attribute
     * 
     * @var string
     */
    private $_displayName;

    /**
     * Constructor
     * 
     * @param array|null $payload Payload
     */
    public function __construct(?array $payload = [])
    {
        $this->_timeZone = $payload['timeZone'] ?? null;
        $this->_language = $payload['language'] ?? null;
        $this->_displayName = $payload['displayName'] ?? null;
    }

    /**
     * AccountPreferences timeZone attribute getter
     * 
     * @return string
     */
    public function getTimeZone(): string
    {
        return $this->_timeZone;
    }

    /**
     * AccountPreferences timeZone attribute setter
     * 
     * @param string $timeZone AccountPreferences timeZone
     * 
     * @return self
     */
    public function setTimeZone(string $timeZone): self
    {
        $this->_timeZone = $timeZone;
        return $this;
    }

    /**
     * AccountPreferences language attribute getter
     * 
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->_language;
    }

    /**
     * AccountPreferences language attribute setter
     * 
     * @param string $language AccountPreferences language
     * 
     * @return self
     */
    public function setLanguage(string $language): self
    {
        $this->_language = $language;
        return $this;
    }

    /**
     * AccountPreferences displayName attribute getter
     * 
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->_displayName;
    }

    /**
     * AccountPreferences displayName attribute setter
     * 
     * @param string $displayName AccountPreferences displayName
     * 
     * @return self
     */
    public function setDisplayName(string $displayName): self
    {
        $this->_displayName = $displayName;
        return $this;
    }
}

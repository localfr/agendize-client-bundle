<?php

namespace Localfr\AgendizeClientBundle\Model;

/**
 * DateTimeTz
 */
class DateTimeTz
{
    /**
     * DateTimeTz dateTime attribute
     * 
     * @var \DateTimeInterface
     */
    private $_dateTime;

    /**
     * DateTimeTz timeZone attribute
     * 
     * @var string
     */
    private $_timeZone;

    /**
     * Constructor
     * 
     * @param array|null $payload Payload
     */
    public function __construct(?array $payload = [])
    {
        $this->_dateTime = $payload['dateTime'] ?? null;
        $this->_timeZone = $payload['timeZone'] ?? null;
    }

    /**
     * DateTimeTz dateTime attribute getter
     * 
     * @return \DateTimeInterface
     */
    public function getDateTime(): \DateTimeInterface
    {
        return $this->_dateTime;
    }

    /**
     * DateTimeTz dateTime attribute setter
     * 
     * @param string $dateTime DateTimeTz dateTime
     * 
     * @return self
     */
    public function setDateTime(\DateTimeInterface $dateTime): self
    {
        $this->_dateTime = $dateTime;
        return $this;
    }

    /**
     * DateTimeTz timeZone attribute getter
     * 
     * @return string
     */
    public function getTimeZone(): string
    {
        return $this->_timeZone;
    }

    /**
     * DateTimeTz timeZone attribute setter
     * 
     * @param string $timeZone DateTimeTz timeZone
     * 
     * @return self
     */
    public function setTimeZone(string $timeZone): self
    {
        $this->_timeZone = $timeZone;
        return $this;
    }
}
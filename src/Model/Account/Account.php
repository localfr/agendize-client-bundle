<?php

namespace Localfr\AgendizeClientBundle\Model\Account;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Localfr\AgendizeClientBundle\Model\{DateTimeTz, WhiteLabel};
use Localfr\AgendizeClientBundle\Model\Profile\Profile;
use Localfr\AgendizeClientBundle\Model\Tag\Tag;

/**
 * Account
 */
class Account
{
    /**
     * Account id attribute
     * 
     * @var string
     */
    private $_id;

    /**
     * Account userName attribute
     * 
     * @var string
     */
    private $_userName;

    /**
     * Account firstName attribute
     * 
     * @var string
     */
    private $_firstName;

    /**
     * Account lastName attribute
     * 
     * @var string
     */
    private $_lastName;

    /**
     * Account email attribute
     * 
     * @var string
     */
    private $_email;

    /**
     * Account currency attribute
     * 
     * @var null|string
     */
    private $_currency = null;

    /**
     * Account resellerId attribute
     * 
     * @var null|string
     */
    private $_resellerId = null;

    /**
     * Account domain attribute
     * 
     * @var null|string $domain
     */
    private $_domain = null;

    /**
     * Account preferences attribute
     *
     * @var AccountPreferences
     */
    private $_preferences;

    /**
     * Account credit attribute
     * 
     * @var null|float
     */
    private $_credit = null;

    /**
     * Account created attribute
     *
     * @var DateTimeTz
     */
    private $_created;

    /**
     * Account ssoToken attribute
     * 
     * @var string
     */
    private $_ssoToken;

    /**
     * Account profile attribute
     *
     * @var null|Profile
     */
    private $_profile = null;

    /**
     * Account tools attribute
     * 
     * @var Collection|string[]
     */
    private $_tools;

    /**
     * Account whiteLabel attribute
     *
     * @var null|WhiteLabel
     */    
    private $_whiteLabel = null;

    /**
     * Account clientName attribute
     * 
     * @var string
     */
    private $_clientName;

    /**
     * Account status attribute
     *
     * @var null|string
     */
    private $_status = null;

    /**
     * Account sendSignupEmail attribute
     * 
     * @var null|bool
     */
    private $_sendSignupEmail = null;

    /**
     * Account additionalUsers attribute
     * 
     * @var null|int
     */
    private $_additionalUsers = null;

    /**
     * Account tags attribute
     *
     * @var Collection|Tag[]
     */
    private $_tags;

    /**
     * Constructor
     * 
     * @param array|null $payload Payload
     */
    public function __construct(?array $payload = [])
    {
        $this->_id = $payload['id'] ?? null;
        $this->_userName = $payload['userName'] ?? null;
        $this->_firstName = $payload['firstName'] ?? null;
        $this->_lastName = $payload['lastName'] ?? null;
        $this->_email = $payload['email'] ?? null;
        $this->_currency = $payload['currency'] ?? null;
        $this->_resellerId = $payload['resellerId'] ?? null;
        $this->_domain = $payload['domain'] ?? null;
        $this->_preferences = $payload['preferences'] ?? null;
        $this->_credit = $payload['credit'] ?? null;
        $this->_created = $payload['created'] ?? null;
        $this->_ssoToken = $payload['ssoToken'] ?? null;
        $this->_profile = $payload['profile'] ?? null;
        $this->_tools = new ArrayCollection();
        if (array_key_exists('tools', $payload) && is_array($payload['tools'])) {
            foreach ($payload['tools'] as $tool) {
                $this->addTool($tool);
            }
        }
        $this->_whiteLabel = $payload['whiteLabel'] ?? null;
        $this->_clientName = $payload['clientName'] ?? null;
        $this->_status = $payload['status'] ?? null;
        $this->_sendSignupEmail = $payload['sendSignupEmail'] ?? null;
        $this->_additionalUsers = $payload['additionalUsers'] ?? null;
        $this->_tags = new ArrayCollection();
        if (array_key_exists('tags', $payload) && is_array($payload['tags'])) {
            foreach ($payload['tags'] as $tag) {
                $this->addTag($tag);
            }
        }
    }

    /**
     * Account id attribute getter
     * 
     * @return string
     */
    public function getId(): string
    {
        return $this->_id;
    }

    /**
     * Account id attribute setter
     * 
     * @param string $id Account id
     * 
     * @return self
     */
    public function setId(string $id): self
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * Account userName attribute getter
     * 
     * @return string
     */
    public function getUserName(): string
    {
        return $this->_userName;
    }

    /**
     * Account userName attribute setter
     * 
     * @param string $userName Account userName
     * 
     * @return self
     */
    public function setUserName(string $userName): self
    {
        $this->_userName = $userName;
        return $this;
    }

    /**
     * Account firstName attribute getter
     * 
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->_firstName;
    }

    /**
     * Account firstName attribute setter
     * 
     * @param string $firstName Account firstName
     * 
     * @return self
     */
    public function setFirstName(string $firstName): self
    {
        $this->_firstName = $firstName;
        return $this;
    }

    /**
     * Account lastName attribute getter
     * 
     * @return string
     */
    public function getLastName(): string
    {
        return $this->_lastName;
    }

    /**
     * Account lastName attribute setter
     * 
     * @param string $lastName Account lastName
     * 
     * @return self
     */
    public function setLastName(string $lastName): self
    {
        $this->_lastName = $lastName;
        return $this;
    }

    /**
     * Account email attribute getter
     * 
     * @return string
     */
    public function getEmail(): string
    {
        return $this->_email;
    }

    /**
     * Account email attribute setter
     * 
     * @param string $email Account email
     * 
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->_email = $email;
        return $this;
    }

    /**
     * Account currency attribute getter
     * 
     * @return null|string
     */
    public function getCurrency(): ?string
    {
        return $this->_currency;
    }

    /**
     * Account currency attribute setter
     * 
     * @param null|string $currency Account currency
     * 
     * @return self
     */
    public function setCurrency(?string $currency = null): self
    {
        $this->_currency = $currency;
        return $this;
    }

    /**
     * Account resellerId attribute getter
     * 
     * @return null|string
     */
    public function getResellerId(): ?string
    {
        return $this->_resellerId;
    }

    /**
     * Account resellerId attribute setter
     * 
     * @param null|string $resellerId Account resellerId
     * 
     * @return self
     */
    public function setResellerId(?string $resellerId = null): self
    {
        $this->_resellerId = $resellerId;
        return $this;
    }

    /**
     * Account domain attribute getter
     * 
     * @return null|string
     */
    public function getDomain(): ?string
    {
        return $this->_domain;
    }

    /**
     * Account domain attribute setter
     * 
     * @param null|string $domain Account domain
     * 
     * @return self
     */
    public function setDomain(?string $domain = null): self
    {
        $this->_domain = $domain;
        return $this;
    }

    /**
     * Account preferences attribute getter
     * 
     * @return AccountPreferences
     */
    public function getPreferences(): AccountPreferences
    {
        return $this->_preferences;
    }

    /**
     * Account preferences attribute setter
     * 
     * @param AccountPreferences $preferences Account preferences
     * 
     * @return self
     */
    public function setPreferences(AccountPreferences $preferences): self
    {
        $this->_preferences = $preferences;
        return $this;
    }

    /**
     * Account credit attribute getter
     * 
     * @return null|float
     */
    public function getCredit(): ?float
    {
        return $this->_credit;
    }

    /**
     * Account credit attribute setter
     * 
     * @param null|float $credit Account credit
     * 
     * @return self
     */
    public function setCredit(?float $credit = null): self
    {
        $this->_credit = $credit;
        return $this;
    }

    /**
     * Account created attribute getter
     * 
     * @return DateTimeTz
     */
    public function getCreated(): DateTimeTz
    {
        return $this->_created;
    }

    /**
     * Account created attribute setter
     * 
     * @param DateTimeTz $created Account created
     * 
     * @return self
     */
    public function setCreated(DateTimeTz $created): self
    {
        $this->_created = $created;
        return $this;
    }

    /**
     * Account ssoToken attribute getter
     * 
     * @return string
     */
    public function getSsoToken(): string
    {
        return $this->_ssoToken;
    }

    /**
     * Account ssoToken attribute setter
     * 
     * @param string $ssoToken Account ssoToken
     * 
     * @return self
     */
    public function setSsoToken(string $ssoToken): self
    {
        $this->_ssoToken = $ssoToken;
        return $this;
    }

    /**
     * Account profile attribute getter
     * 
     * @return null|Profile
     */
    public function getProfile(): ?Profile
    {
        return $this->_profile;
    }

    /**
     * Account profile attribute setter
     * 
     * @param null|Profile $profile Account profile
     * 
     * @return self
     */
    public function setProfile(?Profile $profile = null): self
    {
        $this->_profile = $profile;
        return $this;
    }

    /**
     * Tools getter
     * 
     * @return Collection|string[]
     */
    public function getTools(): Collection
    {
        return $this->_tools;
    }

    /**
     * Add a tool
     * 
     * @param string $tool Tool to add
     *
     * @return self
     */
    public function addTool(string $tool): self
    {
        if (null === $this->tools) {
            $this->_tools = new ArrayCollection();
        }

        if (!$this->_tools->contains($tool)) {
            $this->_tools[] = $tool;
        }
        return $this;
    }

    /**
     * Remove a tool
     * 
     * @param string $tool Tool to remove
     *
     * @return self
     */
    public function removeTool(string $tool): self
    {
        if (null === $this->_tools) {
            return $this;
        }

        if ($this->_tools->contains($tool)) {
            $this->_tools->removeElement($tool);
        }
        return $this;
    }

    /**
     * Account whiteLabel attribute getter
     * 
     * @return null|WhiteLabel
     */
    public function getWhiteLabel(): ?WhiteLabel
    {
        return $this->_whiteLabel;
    }

    /**
     * Account whiteLabel attribute setter
     * 
     * @param null|WhiteLabel $whiteLabel Account whiteLabel
     * 
     * @return self
     */
    public function setWhiteLabel(?WhiteLabel $whiteLabel = null): self
    {
        $this->_whiteLabel = $whiteLabel;
        return $this;
    }

    /**
     * Account clientName attribute getter
     * 
     * @return string
     */
    public function getClientName(): string
    {
        return $this->_clientName;
    }

    /**
     * Account clientName attribute setter
     * 
     * @param string $clientName Account clientName
     * 
     * @return self
     */
    public function setClientName(string $clientName): self
    {
        $this->_clientName = $clientName;
        return $this;
    }

    /**
     * Account status attribute getter
     * 
     * @return null|string
     */
    public function getStatus(): ?string
    {
        return $this->_status;
    }

    /**
     * Account status attribute setter
     * 
     * @param null|string $status Account status
     * 
     * @return self
     */
    public function setStatus(?string $status = null): self
    {
        $this->_status = $status;
        return $this;
    }

    /**
     * Account sendSignupEmail attribute getter
     * 
     * @return bool
     */
    public function getSendSignupEmail(): bool
    {
        return $this->_sendSignupEmail;
    }

    /**
     * Account sendSignupEmail attribute setter
     * 
     * @param bool $sendSignupEmail Account sendSignupEmail
     * 
     * @return self
     */
    public function setSendSignupEmail(bool $sendSignupEmail): self
    {
        $this->_sendSignupEmail = $sendSignupEmail;
        return $this;
    }

    /**
     * Account additionalUsers attribute getter
     * 
     * @return int
     */
    public function getAdditionalUsers(): int
    {
        return $this->_additionalUsers;
    }

    /**
     * Account additionalUsers attribute getter
     * 
     * @param int $additionalUsers Account additionalUsers
     * 
     * @return self
     */
    public function setAdditionalUsers(int $additionalUsers): self
    {
        $this->_additionalUsers = $additionalUsers;
        return $this;
    }

    /**
     * Tools getter
     * 
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->_tags;
    }

    /**
     * Add a tag
     * 
     * @param Tag $tag Tag to add
     *
     * @return self
     */
    public function addTag(Tag $tag): self
    {
        if (null === $this->tags) {
            $this->_tags = new ArrayCollection();
        }

        if (!$this->_tags->contains($tag)) {
            $this->_tags[] = $tag;
        }
        return $this;
    }

    /**
     * Remove a tag
     * 
     * @param Tag $tag Tag to remove
     *
     * @return self
     */
    public function removeTag(Tag $tag): self
    {
        if (null === $this->_tags) {
            return $this;
        }

        if ($this->_tags->contains($tag)) {
            $this->_tags->removeElement($tag);
        }
        return $this;
    }
}

<?php

namespace Localfr\AgendizeClientBundle\Model\Account;

use Doctrine\Common\Collections\{ArrayCollection, Collection};


/**
 * Accounts List Response
 */
class AccountsListResponse
{
    /**
     * Items
     * 
     * @var Collection|Account[] $items
     */
    private $_items;

    /**
     * Constructor
     * 
     * @param array|null $payload Fields
     */
    public function __construct(?array $payload = [])
    {
        $this->_items = new ArrayCollection();
        if (array_key_exists('items', $payload) && is_array($payload['items'])) {
            foreach ($payload['items'] as $item) {
                $this->addItem($item);
            }
        }
    }

    /**
     * Items getter
     * 
     * @return Collection|Account[]
     */
    public function getItems(): Collection
    {
        return $this->_items;
    }

    /**
     * Add Account
     * 
     * @param Account $item Account to add
     *
     * @return self
     */
    public function addItem(Account $item): self
    {
        if (null === $this->_items) {
            $this->_items = new ArrayCollection();
        }

        if (!$this->_items->contains($item)) {
            $this->_items[] = $item;
        }
        return $this;
    }

    /**
     * Remove Account
     * 
     * @param Account $item Account to remove
     *
     * @return self
     */
    public function removeItem(Account $item): self
    {
        if (null === $this->_items) {
            return $this;
        }

        if ($this->_items->contains($item)) {
            $this->_items->removeElement($item);
        }
        return $this;
    }
}

<?php

namespace Localfr\AgendizeClientBundle\Service\Agendize\AuthProvider;

interface AgendizeProviderInterface
{
    /**
     * @return string|null
     */
    public function getInstanceUrl(): ?string;

    /**
     * @return array
     */
    public function getAuhtorizationHeader(): array;
}

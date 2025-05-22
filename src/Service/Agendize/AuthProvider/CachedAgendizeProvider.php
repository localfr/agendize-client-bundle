<?php

namespace Localfr\AgendizeClientBundle\Service\Agendize\AuthProvider;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Cached Agendize Provider
 */
class CachedAgendizeProvider extends AgendizeProvider
{
    /**
     * @var string
     */
    const KEY_PREFIX = 'agendize_token_';

    /**
     * @var FilesystemAdapter
     */
    private $adapter;

    /**
     * @param HttpClientInterface $httpClient
     * @param string $apiKey
     * @param string $apiToken
     * @param string $url
     */
    public function __construct(
        HttpClientInterface $httpClient,
        string $apiKey,
        string $apiToken,
        ?string $url = null
    ) {
        parent::__construct(
            $httpClient,
            $apiKey,
            $apiToken,
            $url
        );
        $this->adapter = new FilesystemAdapter();
    }
}

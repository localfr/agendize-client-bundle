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
     * @param string $clientId
     * @param string $clientSecret
     * @param string $username
     * @param string $password
     * @param string $url
     */
    public function __construct(
        HttpClientInterface $httpClient,
        string $clientId,
        string $clientSecret,
        string $username,
        string $password,
        ?string $url = null
    ) {
        parent::__construct(
            $httpClient,
            $clientId,
            $clientSecret,
            $username,
            $password,
            $url
        );
        $this->adapter = new FilesystemAdapter();
    }

    /**
     * @inheritdoc
     */
    public function authorize(bool $reauth = false): void
    {
        $this->accessToken = $this->adapter->get(
            $this->getCachedTokenKey(),
            function (ItemInterface $item) {
                parent::authorize();
                $item->expiresAfter($this->accessToken->getExpires() - time() - 300);
                return $this->accessToken;
            }
        );
    }

    /**
     * @return string
     */
    private function getCachedTokenKey(): string
    {
        return sprintf('%s%s', self::KEY_PREFIX, $this->clientId);
    }
}
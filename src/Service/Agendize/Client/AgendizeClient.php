<?php

namespace Localfr\AgendizeClientBundle\Service\Agendize\Client;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Contracts\HttpClient\{HttpClientInterface, ResponseInterface};
use Localfr\AgendizeClientBundle\Model\Account\{
    Account,
    AccountCreateParams,
    AccountSearchParams,
    AccountUpdateParams,
    AccountsListResponse,
};
use Localfr\AgendizeClientBundle\Service\Agendize\AuthProvider\AgendizeProviderInterface;

class AgendizeClient
{
    /**
     * Agendize API root prefix
     * 
     * @var string
     */
    const API_PREFIX = '/api';

    /**
     * Agendize API resellers endpoint
     * 
     * @var string
     */
    const RESELLERS_ENDPOINT = '/resellers';

    /**
     * Default headers
     * 
     * @var array
     */
    const DEFAULT_HEADERS = [
        "Accept" => "application/json",
        "Content-Type" => "application/json"
    ];

    /**
     * HTTP Client
     * 
     * @var HttpClientInterface
     */
    private $_httpClient;

    /**
     * Agendize Provider
     * 
     * @var AgendizeProviderInterface
     */
    private $_agendizeProvider;

    /**
     * Serializer
     * 
     * @var SerializerInterface
     */
    private $_serializer;

    /**
     * Agendize API Version
     * 
     * @var string
     */
    private $_apiVersion = '2.0';

    /**
     * @param HttpClientInterface       $httpClient       Http client
     * @param AgendizeProviderInterface $agendizeProvider Agendize provider
     * @param SerializerInterface       $serializer       Serializer
     * @param string|null               $apiVersion       API version
     */
    public function __construct(
        HttpClientInterface $httpClient,
        AgendizeProviderInterface $agendizeProvider,
        SerializerInterface $serializer,
        ?string $apiVersion = null
    ) {
        $this->_httpClient = $httpClient;
        $this->_agendizeProvider = $agendizeProvider;
        $this->_serializer = $serializer;
        if (isset($apiVersion)) {
            $this->_apiVersion = $apiVersion;
        }
    }

    /**
     * List reseller accounts
     * 
     * @param null|AccountSearchParams $searchParams Search parameters.
     * @param null|bool                $raw          Whether to return raw response or object.
     *
     * @throws ClientException
     * 
     * @return string|AccountsListResponse
     */
    public function listResellerAccounts(?AccountSearchParams $searchParams = null, ?bool $raw = false)
    {
        $url = sprintf(
            '%s/accounts',
            $this->buildResellersUrl()
        );
        if ($searchParams instanceof AccountSearchParams) {
            $url = sprintf('%s?%s', $url, \http_build_query($searchParams));
        }
        
        $response = $this->request('GET', $url);

        if (true === $raw) {
            return $response->getContent();
        }

        return $this->_serializer->deserialize(
            $response->getContent(),
            AccountsListResponse::class,
            'json'
        );
    }

    /**
     * Get a reseller account
     *
     * @param string    $identifier Agendize ID or resellerId (field is identifier).
     * @param null|bool $raw        Whether to return raw response or object.
     * 
     * @throws ClientException
     * 
     * @return string|Account
     */
    public function getResellerAccount(string $identifier, ?bool $raw = false)
    {
        $url = sprintf(
            '%s/accounts/%s',
            $this->buildResellersUrl(),
            $identifier
        );
        
        $response = $this->request('GET', $url);

        if (true === $raw) {
            return $response->getContent();
        }

        return $this->_serializer->deserialize(
            $response->getContent(),
            Account::class,
            'json'
        );
    }

    /**
     * Create a reseller account
     *
     * @param string              $identifier   Agendize ID or resellerId (field is identifier).
     * @param AccountCreateParams $createParams Account parameters.
     * @param null|bool           $raw          Whether to return raw response or object.
     * 
     * @throws ClientException
     * 
     * @return string|Account
     */
    public function createResellerAccount(string $identifier, AccountCreateParams $createParams, ?bool $raw = false)
    {
        $url = sprintf(
            '%s/accounts/%s',
            $this->buildResellersUrl(),
            $identifier
        );

        $options = [];
        $options["body"] = $this->_serializer->serialize(
            $createParams,
            'json',
            [ AbstractObjectNormalizer::SKIP_NULL_VALUES => true ]
        );

        $response = $this->request('POST', $url, $options);

        if (true === $raw) {
            return $response->getContent();
        }

        return $this->_serializer->deserialize(
            $response->getContent(),
            Account::class,
            'json'
        );
    }

    /**
     * Update a reseller account
     *
     * @param string              $identifier   Agendize ID or resellerId (field is identifier).
     * @param AccountUpdateParams $updateParams Parameters to update.
     * @param null|bool           $raw          Whether to return raw response or object.
     * 
     * @throws ClientException
     * 
     * @return string|Account
     */
    public function updateResellerAccount(string $identifier, AccountUpdateParams $updateParams, ?bool $raw = false)
    {
        $url = sprintf(
            '%s/accounts/%s',
            $this->buildResellersUrl(),
            $identifier
        );

        $options = [];
        $options["body"] = $this->_serializer->serialize(
            $updateParams,
            'json',
            [ AbstractObjectNormalizer::SKIP_NULL_VALUES => true ]
        );
        
        $response = $this->request('PUT', $url, $options);

        if (true === $raw) {
            return $response->getContent();
        }

        return $this->_serializer->deserialize(
            $response->getContent(),
            Account::class,
            'json'
        );
    }

    /**
     * Delete a reseller account
     *
     * @param string $identifier Agendize ID or resellerId (field is identifier).
     * 
     * @throws ClientException
     * 
     * @return bool
     */
    public function deleteResellerAccount(string $identifier): bool
    {
        $url = sprintf(
            '%s/accounts/%s',
            $this->buildResellersUrl(),
            $identifier
        );
        
        $response = $this->request('DELETE', $url);

        if (200 !== $response->getStatusCode()) {
            return false;
        }

        return true;
    }

    /**
     * Build resellers url
     * 
     * @return string
     */
    public function buildResellersUrl(): string
    {
        return sprintf(
            '%s%s/%s%s',
            $this->_agendizeProvider->getInstanceUrl(),
            self::API_PREFIX,
            $this->_apiVersion,
            self::RESELLERS_ENDPOINT
        );
    }

    /**
     * Build request headers
     * 
     * @return array
     */
    private function _buildHeaders(): array
    {
        return array_merge(
            self::DEFAULT_HEADERS,
            $this->_agendizeProvider->getAuhtorizationHeader()
        );
    }

    /**
     * Execute request
     * 
     * @param string $method  HTTP Method
     * @param string $url     URL
     * @param array  $options Options passed to http requests
     * 
     * @return ResponseInterface
     * @throws TransportExceptionInterface — When an unsupported option is passed
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        // If body exists, it should be a string representation of JSON
        if (array_key_exists("body", $options) && !is_string($options["body"])) {
            $options["body"] = json_encode($options["body"]);
        }
        $options = array_merge(
            $options,
            [
                "headers" => $this->_buildHeaders()
            ]
        );

        return $this->_httpClient->request(
            $method,
            $url,
            $options
        );
    }
}
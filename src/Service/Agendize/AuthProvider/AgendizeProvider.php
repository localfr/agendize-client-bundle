<?php

namespace Localfr\AgendizeClientBundle\Service\Agendize\AuthProvider;

use Symfony\Contracts\HttpClient\{HttpClientInterface, ResponseInterface};
use UnexpectedValueException;

/**
 * Agendize Authentication Provider
 */
class AgendizeProvider implements AgendizeProviderInterface
{
    /**
     * @var string
     */
    const URL = 'https://api.agendize.com';

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $apiToken;

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     * @param string $apiKey
     * @param string $apiToken
     * @param null|string $url
     */
    public function __construct(
        HttpClientInterface $httpClient,
        string $apiKey,
        string $apiToken,
        ?string $url = null
    ) {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
        $this->apiToken = $apiToken;
        $this->url = $url ?: self::URL;
    }

    /**
     * @inheritdoc
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @inheritdoc
     */
    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    /**
     * @inheritdoc
     */
    public function getInstanceUrl(): string
    {
        return self::URL;
    }

    /**
     * @inheritdoc
     */
    public function getAuhtorizationHeader(): array
    {
        return [
            'apiKey' => $this->getApiKey(),
            'token' => $this->getApiToken(),
        ];
    }

    /**
     * Returns the parsed response.
     *
     * @param  ResponseInterface $response
     * @throws IdentityProviderException
     * @return mixed
     */
    public function getParsedResponse(ResponseInterface $response)
    {
        return $this->parseResponse($response);
    }

    /**
     * Attempts to parse a JSON response.
     *
     * @param  string $content JSON content from response body
     * @return array Parsed JSON data
     * @throws UnexpectedValueException if the content could not be parsed
     */
    protected function parseJson($content)
    {
        $content = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new UnexpectedValueException(
                sprintf(
                    "Failed to parse JSON response: %s",
                    json_last_error_msg()
                )
            );
        }

        return $content;
    }

    /**
     * Returns the content type header of a response.
     *
     * @param  ResponseInterface $response
     * @return string Semi-colon separated join of content-type headers.
     */
    protected function getContentType(ResponseInterface $response)
    {
        return join(';', $response->getHeaders()['content-type']);
    }

    /**
     * Parses the response according to its content-type header.
     *
     * @throws UnexpectedValueException
     * @param  ResponseInterface $response
     * @return array
     */
    protected function parseResponse(ResponseInterface $response)
    {
        $content = $response->getContent();
        $type = $this->getContentType($response);

        if (strpos($type, 'urlencoded') !== false) {
            parse_str($content, $parsed);
            return $parsed;
        }

        // Attempt to parse the string as JSON regardless of content type,
        // since some providers use non-standard content types. Only throw an
        // exception if the JSON could not be parsed when it was expected to.
        try {
            return $this->parseJson($content);
        } catch (UnexpectedValueException $e) {
            if (strpos($type, 'json') !== false) {
                throw $e;
            }

            if ($response->getStatusCode() == 500) {
                throw new UnexpectedValueException(
                    'An OAuth server error was encountered that did not contain a JSON body',
                    0,
                    $e
                );
            }

            return $content;
        }
    }
}

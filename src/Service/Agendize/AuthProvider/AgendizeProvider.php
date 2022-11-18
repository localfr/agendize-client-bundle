<?php

namespace Localfr\AgendizeClientBundle\Service\Agendize\AuthProvider;

use Symfony\Contracts\HttpClient\{HttpClientInterface, ResponseInterface};
use Localfr\AgendizeClientBundle\Service\Agendize\Token\AccessToken;
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
    const TOKEN_ENDPOINT = '/o/oauth2/token';

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var AccessToken
     */
    protected $accessToken;

    /**
     * @param HttpClientInterface $httpClient
     * @param string $clientId
     * @param string $clientSecret
     * @param string $username
     * @param string $password
     * @param null|string $url
     */
    public function __construct(
        HttpClientInterface $httpClient,
        string $clientId,
        string $clientSecret,
        string $username,
        string $password,
        ?string $url = null
    ) {
        $this->httpClient = $httpClient;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->username = $username;
        $this->password = $password;
        $this->url = $url ?: self::URL;
    }

    /**
     * @inheritdoc
     */
    public function authorize(): void
    {
        // We already have a valid token
        if ($this->accessToken instanceof AccessToken && !$this->accessToken->hasExpired()) {
            return;
        }

        $url = sprintf("%s%s", $this->url, self::TOKEN_ENDPOINT);
        $body = null;
        $options = [
            'body' => $body,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ];

        if (!$this->accessToken instanceof AccessToken) {
            // No token, negotiating one
            $options['body'] = \http_build_query(
                [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'username' => $this->username,
                    'password' => $this->password,
                    'grant_type' => 'password'
                ]
            );
        } elseif ($this->accessToken->hasExpired()) {
            // Token has expired, refreshing it
            $options["body"] = \http_build_query(
                [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'refresh_token' => $this->accessToken->getRefreshToken(),
                    'grant_type' => 'refresh_token'
                ]
            );
        }

        $response = $this->httpClient->request(
            'POST',
            $url,
            $options
        );

        $token = $this->getParsedResponse($response);
        $this->accessToken = new AccessToken($token);
    }

    /**
     * @inheritdoc
     */
    public function revoke(): void
    {
        $this->accessToken = null;
    }

    /**
     * @inheritdoc
     */
    public function getToken(): string
    {
        $this->authorize();

        return $this->accessToken->getToken();
    }

    /**
     * @inheritdoc
     */
    public function getTokenType(): string
    {
        $this->authorize();

        return $this->accessToken->getTokenType();
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
            'Authorization' => sprintf(
                '%s %s',
                $this->getTokenType(),
                $this->getToken()
            )
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
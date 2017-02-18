<?php
/**
 * MPlaying Reallife - Control Panel
 * https://cp.MPlaying.eu
 *
 * Author: Francesco Paolocci
 * Created: 18.02.2017 - 19:00
 * IDE: PhpStorm
 */

namespace MPlaying\OAuth2\MPlaying\Provider;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;

class MPlayingProvider extends GenericProvider
{

    private $apiUrl = "https://cp.mplaying.eu/api/v1";

    /**
     * Returns the base URL for authorizing a client.
     *
     * Eg. https://oauth.service.com/authorize
     *
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return "https://cp.mplaying.eu/api/authorize";
    }

    /**
     * Returns the base URL for requesting an access token.
     *
     * Eg. https://oauth.service.com/token
     *
     * @param array $params
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return "https://cp.mplaying.eu/api/access_token";
    }

    /**
     * Returns the URL for requesting the resource owner's details.
     *
     * @param AccessToken $token
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return "https://cp.mplaying.eu/api/v1/user";
    }

    /**
     * @inheritdoc
     */
    protected function getScopeSeparator()
    {
        return " ";
    }

    /**
     * @inheritdoc
     */
    protected function getAccessTokenMethod()
    {
        return self::METHOD_POST;
    }

    /**
     * Returns all options that are required.
     *
     * @return array
     */
    protected function getRequiredOptions()
    {
        return [];
    }

    /**
     * Returns all options that can be configured.
     *
     * @return array
     */
    protected function getConfigurableOptions()
    {
        return array_merge($this->getRequiredOptions(), [
            'responseError',
            'responseCode',
            'scopes',
        ]);
    }

    /**
     * Generates a resource owner object from a successful resource owner
     * details request.
     *
     * @param  array $response
     * @param  AccessToken $token
     * @return ResourceOwnerInterface
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new MPlayingResourceOwner($response);
    }

    /**
     * @param $method
     * @param $endpoint
     * @param AccessToken $accessToken
     * @throws IdentityProviderException
     * @return mixed
     */
    public function getEndpointData($method, $endpoint, AccessToken $accessToken) {
        $request = $this->getAuthenticatedRequest(
            $method,
            $this->apiUrl.$endpoint,
            $accessToken
        );

        return $this->getParsedResponse($request);
    }
}
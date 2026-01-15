<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\OAuthTokens\OAuthToken;
use Increase\OAuthTokens\OAuthTokenCreateParams;
use Increase\OAuthTokens\OAuthTokenCreateParams\GrantType;
use Increase\RequestOptions;
use Increase\ServiceContracts\OAuthTokensRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class OAuthTokensRawService implements OAuthTokensRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an OAuth Token
     *
     * @param array{
     *   grantType: GrantType|value-of<GrantType>,
     *   clientID?: string,
     *   clientSecret?: string,
     *   code?: string,
     *   productionToken?: string,
     * }|OAuthTokenCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<OAuthToken>
     *
     * @throws APIException
     */
    public function create(
        array|OAuthTokenCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = OAuthTokenCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'oauth/tokens',
            body: (object) $parsed,
            options: $options,
            convert: OAuthToken::class,
        );
    }
}

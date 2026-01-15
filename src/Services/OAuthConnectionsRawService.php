<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\OAuthConnections\OAuthConnection;
use Increase\OAuthConnections\OAuthConnectionListParams;
use Increase\OAuthConnections\OAuthConnectionListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\OAuthConnectionsRawContract;

/**
 * @phpstan-import-type StatusShape from \Increase\OAuthConnections\OAuthConnectionListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class OAuthConnectionsRawService implements OAuthConnectionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an OAuth Connection
     *
     * @param string $oauthConnectionID the identifier of the OAuth Connection
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<OAuthConnection>
     *
     * @throws APIException
     */
    public function retrieve(
        string $oauthConnectionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['oauth_connections/%1$s', $oauthConnectionID],
            options: $requestOptions,
            convert: OAuthConnection::class,
        );
    }

    /**
     * @api
     *
     * List OAuth Connections
     *
     * @param array{
     *   cursor?: string,
     *   limit?: int,
     *   oauthApplicationID?: string,
     *   status?: Status|StatusShape,
     * }|OAuthConnectionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<OAuthConnection>>
     *
     * @throws APIException
     */
    public function list(
        array|OAuthConnectionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = OAuthConnectionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'oauth_connections',
            query: Util::array_transform_keys(
                $parsed,
                ['oauthApplicationID' => 'oauth_application_id']
            ),
            options: $options,
            convert: OAuthConnection::class,
            page: Page::class,
        );
    }
}

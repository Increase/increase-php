<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\OAuthConnections\OAuthConnection;
use Increase\OAuthConnections\OAuthConnectionListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\OAuthConnectionsContract;

/**
 * @phpstan-import-type StatusShape from \Increase\OAuthConnections\OAuthConnectionListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class OAuthConnectionsService implements OAuthConnectionsContract
{
    /**
     * @api
     */
    public OAuthConnectionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new OAuthConnectionsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an OAuth Connection
     *
     * @param string $oauthConnectionID the identifier of the OAuth Connection
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $oauthConnectionID,
        RequestOptions|array|null $requestOptions = null
    ): OAuthConnection {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($oauthConnectionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List OAuth Connections
     *
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param string $oauthApplicationID filter results to only include OAuth Connections for a specific OAuth Application
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<OAuthConnection>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?int $limit = null,
        ?string $oauthApplicationID = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'limit' => $limit,
                'oauthApplicationID' => $oauthApplicationID,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

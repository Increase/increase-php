<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\OAuthConnections\OAuthConnection;
use Increase\OAuthConnections\OAuthConnectionListParams\Status;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type StatusShape from \Increase\OAuthConnections\OAuthConnectionListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface OAuthConnectionsContract
{
    /**
     * @api
     *
     * @param string $oauthConnectionID the identifier of the OAuth Connection
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $oauthConnectionID,
        RequestOptions|array|null $requestOptions = null,
    ): OAuthConnection;

    /**
     * @api
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
    ): Page;
}

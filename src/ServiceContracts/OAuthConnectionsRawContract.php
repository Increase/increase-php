<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\OAuthConnections\OAuthConnection;
use Increase\OAuthConnections\OAuthConnectionListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface OAuthConnectionsRawContract
{
    /**
     * @api
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|OAuthConnectionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<OAuthConnection>>
     *
     * @throws APIException
     */
    public function list(
        array|OAuthConnectionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

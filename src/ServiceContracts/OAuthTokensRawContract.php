<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\OAuthTokens\OAuthToken;
use Increase\OAuthTokens\OAuthTokenCreateParams;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface OAuthTokensRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|OAuthTokenCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<OAuthToken>
     *
     * @throws APIException
     */
    public function create(
        array|OAuthTokenCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

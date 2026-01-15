<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardTokens\CardToken;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardTokens\CardTokenCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardTokensRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CardTokenCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardToken>
     *
     * @throws APIException
     */
    public function create(
        array|CardTokenCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams;
use Increase\Simulations\CardAuthorizations\CardAuthorizationNewResponse;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardAuthorizationsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CardAuthorizationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardAuthorizationNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|CardAuthorizationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

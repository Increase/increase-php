<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;
use Increase\RoutingNumbers\RoutingNumberListParams;
use Increase\RoutingNumbers\RoutingNumberListResponse;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface RoutingNumbersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RoutingNumberListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<RoutingNumberListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|RoutingNumberListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

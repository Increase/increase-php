<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardIncrements\CardIncrementCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardIncrementsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CardIncrementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function create(
        array|CardIncrementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

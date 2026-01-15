<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardRefunds\CardRefundCreateParams;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardRefundsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CardRefundCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transaction>
     *
     * @throws APIException
     */
    public function create(
        array|CardRefundCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\AccountRevenuePayments\AccountRevenuePaymentCreateParams;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountRevenuePaymentsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AccountRevenuePaymentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transaction>
     *
     * @throws APIException
     */
    public function create(
        array|AccountRevenuePaymentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardSettlements\CardSettlementCreateParams;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardSettlementsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CardSettlementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transaction>
     *
     * @throws APIException
     */
    public function create(
        array|CardSettlementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

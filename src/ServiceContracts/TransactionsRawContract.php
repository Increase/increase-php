<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;
use Increase\Transactions\Transaction;
use Increase\Transactions\TransactionListParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface TransactionsRawContract
{
    /**
     * @api
     *
     * @param string $transactionID the identifier of the Transaction to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transaction>
     *
     * @throws APIException
     */
    public function retrieve(
        string $transactionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TransactionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Transaction>>
     *
     * @throws APIException
     */
    public function list(
        array|TransactionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

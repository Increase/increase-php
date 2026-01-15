<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\PendingTransactions\PendingTransaction;
use Increase\PendingTransactions\PendingTransactionCreateParams;
use Increase\PendingTransactions\PendingTransactionListParams;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface PendingTransactionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PendingTransactionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PendingTransaction>
     *
     * @throws APIException
     */
    public function create(
        array|PendingTransactionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $pendingTransactionID the identifier of the Pending Transaction
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PendingTransaction>
     *
     * @throws APIException
     */
    public function retrieve(
        string $pendingTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PendingTransactionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<PendingTransaction>>
     *
     * @throws APIException
     */
    public function list(
        array|PendingTransactionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $pendingTransactionID the identifier of the Pending Transaction to release
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PendingTransaction>
     *
     * @throws APIException
     */
    public function release(
        string $pendingTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

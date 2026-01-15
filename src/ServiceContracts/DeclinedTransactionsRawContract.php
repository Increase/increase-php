<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\DeclinedTransactions\DeclinedTransaction;
use Increase\DeclinedTransactions\DeclinedTransactionListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface DeclinedTransactionsRawContract
{
    /**
     * @api
     *
     * @param string $declinedTransactionID the identifier of the Declined Transaction
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeclinedTransaction>
     *
     * @throws APIException
     */
    public function retrieve(
        string $declinedTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DeclinedTransactionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<DeclinedTransaction>>
     *
     * @throws APIException
     */
    public function list(
        array|DeclinedTransactionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

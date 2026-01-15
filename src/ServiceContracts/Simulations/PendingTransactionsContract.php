<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\PendingTransactions\PendingTransaction;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface PendingTransactionsContract
{
    /**
     * @api
     *
     * @param string $pendingTransactionID The pending transaction to release. The pending transaction must have a `inbound_funds_hold` source.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function releaseInboundFundsHold(
        string $pendingTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): PendingTransaction;
}

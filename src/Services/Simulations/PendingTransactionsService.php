<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\PendingTransactions\PendingTransaction;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\PendingTransactionsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class PendingTransactionsService implements PendingTransactionsContract
{
    /**
     * @api
     */
    public PendingTransactionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PendingTransactionsRawService($client);
    }

    /**
     * @api
     *
     * This endpoint simulates immediately releasing an Inbound Funds Hold, which might be created as a result of, for example, an ACH debit.
     *
     * @param string $pendingTransactionID The pending transaction to release. The pending transaction must have a `inbound_funds_hold` source.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function releaseInboundFundsHold(
        string $pendingTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): PendingTransaction {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->releaseInboundFundsHold($pendingTransactionID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

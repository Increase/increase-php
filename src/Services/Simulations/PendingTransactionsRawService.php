<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\PendingTransactions\PendingTransaction;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\PendingTransactionsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class PendingTransactionsRawService implements PendingTransactionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * This endpoint simulates immediately releasing an Inbound Funds Hold, which might be created as a result of, for example, an ACH debit.
     *
     * @param string $pendingTransactionID The pending transaction to release. The pending transaction must have a `inbound_funds_hold` source.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PendingTransaction>
     *
     * @throws APIException
     */
    public function releaseInboundFundsHold(
        string $pendingTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'simulations/pending_transactions/%1$s/release_inbound_funds_hold',
                $pendingTransactionID,
            ],
            options: $requestOptions,
            convert: PendingTransaction::class,
        );
    }
}

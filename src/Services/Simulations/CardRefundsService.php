<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardRefundsContract;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardRefundsService implements CardRefundsContract
{
    /**
     * @api
     */
    public CardRefundsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardRefundsRawService($client);
    }

    /**
     * @api
     *
     * Simulates refunding a card transaction. The full value of the original sandbox transaction is refunded.
     *
     * @param int $amount The refund amount in cents. Pulled off the `pending_transaction` or the `transaction` if not provided.
     * @param string $pendingTransactionID The identifier of the Pending Transaction for the refund authorization. If this is provided, `transaction` must not be provided as a refund with a refund authorized can not be linked to a regular transaction.
     * @param string $transactionID The identifier for the Transaction to refund. The Transaction's source must have a category of card_settlement.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?int $amount = null,
        ?string $pendingTransactionID = null,
        ?string $transactionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Transaction {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'pendingTransactionID' => $pendingTransactionID,
                'transactionID' => $transactionID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

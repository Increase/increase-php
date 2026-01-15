<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardSettlementsContract;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardSettlementsService implements CardSettlementsContract
{
    /**
     * @api
     */
    public CardSettlementsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardSettlementsRawService($client);
    }

    /**
     * @api
     *
     * Simulates the settlement of an authorization by a card acquirer. After a card authorization is created, the merchant will eventually send a settlement. This simulates that event, which may occur many days after the purchase in production. The amount settled can be different from the amount originally authorized, for example, when adding a tip to a restaurant bill.
     *
     * @param string $cardID the identifier of the Card to create a settlement on
     * @param string $pendingTransactionID the identifier of the Pending Transaction for the Card Authorization you wish to settle
     * @param int $amount The amount to be settled. This defaults to the amount of the Pending Transaction being settled.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $cardID,
        string $pendingTransactionID,
        ?int $amount = null,
        RequestOptions|array|null $requestOptions = null,
    ): Transaction {
        $params = Util::removeNulls(
            [
                'cardID' => $cardID,
                'pendingTransactionID' => $pendingTransactionID,
                'amount' => $amount,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

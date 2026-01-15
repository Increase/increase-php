<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardSettlementsRawContract;
use Increase\Simulations\CardSettlements\CardSettlementCreateParams;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardSettlementsRawService implements CardSettlementsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates the settlement of an authorization by a card acquirer. After a card authorization is created, the merchant will eventually send a settlement. This simulates that event, which may occur many days after the purchase in production. The amount settled can be different from the amount originally authorized, for example, when adding a tip to a restaurant bill.
     *
     * @param array{
     *   cardID: string, pendingTransactionID: string, amount?: int
     * }|CardSettlementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transaction>
     *
     * @throws APIException
     */
    public function create(
        array|CardSettlementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardSettlementCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/card_settlements',
            body: (object) $parsed,
            options: $options,
            convert: Transaction::class,
        );
    }
}

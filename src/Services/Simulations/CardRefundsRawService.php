<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardRefundsRawContract;
use Increase\Simulations\CardRefunds\CardRefundCreateParams;
use Increase\Transactions\Transaction;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardRefundsRawService implements CardRefundsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates refunding a card transaction. The full value of the original sandbox transaction is refunded.
     *
     * @param array{
     *   amount?: int, pendingTransactionID?: string, transactionID?: string
     * }|CardRefundCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transaction>
     *
     * @throws APIException
     */
    public function create(
        array|CardRefundCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardRefundCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/card_refunds',
            body: (object) $parsed,
            options: $options,
            convert: Transaction::class,
        );
    }
}

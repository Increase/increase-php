<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardIncrementsRawContract;
use Increase\Simulations\CardIncrements\CardIncrementCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardIncrementsRawService implements CardIncrementsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates the increment of an authorization by a card acquirer. An authorization can be incremented multiple times.
     *
     * @param array{
     *   amount: int, cardPaymentID: string, eventSubscriptionID?: string
     * }|CardIncrementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function create(
        array|CardIncrementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardIncrementCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/card_increments',
            body: (object) $parsed,
            options: $options,
            convert: CardPayment::class,
        );
    }
}

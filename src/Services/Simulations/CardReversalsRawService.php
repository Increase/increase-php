<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardReversalsRawContract;
use Increase\Simulations\CardReversals\CardReversalCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardReversalsRawService implements CardReversalsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates the reversal of an authorization by a card acquirer. An authorization can be partially reversed multiple times, up until the total authorized amount. Marks the pending transaction as complete if the authorization is fully reversed.
     *
     * @param array{
     *   cardPaymentID: string, amount?: int
     * }|CardReversalCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function create(
        array|CardReversalCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardReversalCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/card_reversals',
            body: (object) $parsed,
            options: $options,
            convert: CardPayment::class,
        );
    }
}

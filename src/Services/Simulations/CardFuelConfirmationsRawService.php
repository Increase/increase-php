<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardFuelConfirmationsRawContract;
use Increase\Simulations\CardFuelConfirmations\CardFuelConfirmationCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardFuelConfirmationsRawService implements CardFuelConfirmationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates the fuel confirmation of an authorization by a card acquirer. This happens asynchronously right after a fuel pump transaction is completed. A fuel confirmation can only happen once per authorization.
     *
     * @param array{
     *   amount: int, cardPaymentID: string
     * }|CardFuelConfirmationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function create(
        array|CardFuelConfirmationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardFuelConfirmationCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/card_fuel_confirmations',
            body: (object) $parsed,
            options: $options,
            convert: CardPayment::class,
        );
    }
}

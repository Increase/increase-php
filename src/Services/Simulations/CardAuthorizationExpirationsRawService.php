<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardAuthorizationExpirationsRawContract;
use Increase\Simulations\CardAuthorizationExpirations\CardAuthorizationExpirationCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardAuthorizationExpirationsRawService implements CardAuthorizationExpirationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates expiring a Card Authorization immediately.
     *
     * @param array{
     *   cardPaymentID: string
     * }|CardAuthorizationExpirationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function create(
        array|CardAuthorizationExpirationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardAuthorizationExpirationCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/card_authorization_expirations',
            body: (object) $parsed,
            options: $options,
            convert: CardPayment::class,
        );
    }
}

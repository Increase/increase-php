<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardAuthorizationExpirationsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardAuthorizationExpirationsService implements CardAuthorizationExpirationsContract
{
    /**
     * @api
     */
    public CardAuthorizationExpirationsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardAuthorizationExpirationsRawService($client);
    }

    /**
     * @api
     *
     * Simulates expiring a Card Authorization immediately.
     *
     * @param string $cardPaymentID the identifier of the Card Payment to expire
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $cardPaymentID,
        RequestOptions|array|null $requestOptions = null
    ): CardPayment {
        $params = Util::removeNulls(['cardPaymentID' => $cardPaymentID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

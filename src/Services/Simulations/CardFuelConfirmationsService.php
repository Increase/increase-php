<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardFuelConfirmationsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardFuelConfirmationsService implements CardFuelConfirmationsContract
{
    /**
     * @api
     */
    public CardFuelConfirmationsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardFuelConfirmationsRawService($client);
    }

    /**
     * @api
     *
     * Simulates the fuel confirmation of an authorization by a card acquirer. This happens asynchronously right after a fuel pump transaction is completed. A fuel confirmation can only happen once per authorization.
     *
     * @param int $amount the amount of the fuel_confirmation in minor units in the card authorization's currency
     * @param string $cardPaymentID the identifier of the Card Payment to create a fuel_confirmation on
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        string $cardPaymentID,
        RequestOptions|array|null $requestOptions = null,
    ): CardPayment {
        $params = Util::removeNulls(
            ['amount' => $amount, 'cardPaymentID' => $cardPaymentID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

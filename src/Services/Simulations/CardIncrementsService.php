<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardIncrementsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardIncrementsService implements CardIncrementsContract
{
    /**
     * @api
     */
    public CardIncrementsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardIncrementsRawService($client);
    }

    /**
     * @api
     *
     * Simulates the increment of an authorization by a card acquirer. An authorization can be incremented multiple times.
     *
     * @param int $amount the amount of the increment in minor units in the card authorization's currency
     * @param string $cardPaymentID the identifier of the Card Payment to create a increment on
     * @param string $eventSubscriptionID The identifier of the Event Subscription to use. If provided, will override the default real time event subscription. Because you can only create one real time decision event subscription, you can use this field to route events to any specified event subscription for testing purposes.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        string $cardPaymentID,
        ?string $eventSubscriptionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardPayment {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'cardPaymentID' => $cardPaymentID,
                'eventSubscriptionID' => $eventSubscriptionID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

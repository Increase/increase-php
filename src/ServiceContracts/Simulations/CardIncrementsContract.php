<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardIncrementsContract
{
    /**
     * @api
     *
     * @param int $amount the amount of the increment in minor units in the card authorization's currency
     * @param string $cardPaymentID the identifier of the Card Payment to create an increment on
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
    ): CardPayment;
}

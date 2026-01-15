<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardFuelConfirmationsContract
{
    /**
     * @api
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
    ): CardPayment;
}

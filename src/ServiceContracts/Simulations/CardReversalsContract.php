<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardReversalsContract
{
    /**
     * @api
     *
     * @param string $cardPaymentID the identifier of the Card Payment to create a reversal on
     * @param int $amount The amount of the reversal in minor units in the card authorization's currency. This defaults to the authorization amount.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $cardPaymentID,
        ?int $amount = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardPayment;
}

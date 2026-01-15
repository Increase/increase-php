<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardAuthorizationExpirationsContract
{
    /**
     * @api
     *
     * @param string $cardPaymentID the identifier of the Card Payment to expire
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $cardPaymentID,
        RequestOptions|array|null $requestOptions = null
    ): CardPayment;
}

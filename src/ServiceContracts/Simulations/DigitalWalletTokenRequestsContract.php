<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\DigitalWalletTokenRequests\DigitalWalletTokenRequestNewResponse;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface DigitalWalletTokenRequestsContract
{
    /**
     * @api
     *
     * @param string $cardID the identifier of the Card to be authorized
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $cardID,
        RequestOptions|array|null $requestOptions = null
    ): DigitalWalletTokenRequestNewResponse;
}

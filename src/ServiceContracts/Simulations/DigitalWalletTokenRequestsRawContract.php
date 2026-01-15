<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\DigitalWalletTokenRequests\DigitalWalletTokenRequestCreateParams;
use Increase\Simulations\DigitalWalletTokenRequests\DigitalWalletTokenRequestNewResponse;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface DigitalWalletTokenRequestsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|DigitalWalletTokenRequestCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigitalWalletTokenRequestNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|DigitalWalletTokenRequestCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

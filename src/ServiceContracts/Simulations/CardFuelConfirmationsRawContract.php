<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardFuelConfirmations\CardFuelConfirmationCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardFuelConfirmationsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CardFuelConfirmationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function create(
        array|CardFuelConfirmationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardPurchaseSupplementsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CardPurchaseSupplementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPurchaseSupplement>
     *
     * @throws APIException
     */
    public function create(
        array|CardPurchaseSupplementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

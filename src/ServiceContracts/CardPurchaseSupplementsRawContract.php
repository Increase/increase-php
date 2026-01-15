<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement;
use Increase\CardPurchaseSupplements\CardPurchaseSupplementListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardPurchaseSupplementsRawContract
{
    /**
     * @api
     *
     * @param string $cardPurchaseSupplementID the identifier of the Card Purchase Supplement
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPurchaseSupplement>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardPurchaseSupplementID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CardPurchaseSupplementListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardPurchaseSupplement>>
     *
     * @throws APIException
     */
    public function list(
        array|CardPurchaseSupplementListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

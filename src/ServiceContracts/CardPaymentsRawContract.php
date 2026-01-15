<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CardPayments\CardPayment;
use Increase\CardPayments\CardPaymentListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardPaymentsRawContract
{
    /**
     * @api
     *
     * @param string $cardPaymentID the identifier of the Card Payment
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardPaymentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CardPaymentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardPayment>>
     *
     * @throws APIException
     */
    public function list(
        array|CardPaymentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

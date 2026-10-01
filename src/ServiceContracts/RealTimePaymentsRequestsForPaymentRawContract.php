<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCancelParams;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentListParams;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface RealTimePaymentsRequestsForPaymentRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RealTimePaymentsRequestsForPaymentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsRequestForPayment>
     *
     * @throws APIException
     */
    public function create(
        array|RealTimePaymentsRequestsForPaymentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $realTimePaymentsRequestForPaymentID the identifier of the Real-Time Payments Request for Payment
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsRequestForPayment>
     *
     * @throws APIException
     */
    public function retrieve(
        string $realTimePaymentsRequestForPaymentID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RealTimePaymentsRequestsForPaymentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<RealTimePaymentsRequestForPayment>>
     *
     * @throws APIException
     */
    public function list(
        array|RealTimePaymentsRequestsForPaymentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $realTimePaymentsRequestForPaymentID the identifier of the Real-Time Payments Request for Payment to cancel
     * @param array<string,mixed>|RealTimePaymentsRequestsForPaymentCancelParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsRequestForPayment>
     *
     * @throws APIException
     */
    public function cancel(
        string $realTimePaymentsRequestForPaymentID,
        array|RealTimePaymentsRequestsForPaymentCancelParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

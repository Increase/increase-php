<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestsForPaymentListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundRealTimePaymentsRequestsForPaymentRawContract
{
    /**
     * @api
     *
     * @param string $inboundRealTimePaymentsRequestForPaymentID the identifier of the Inbound Real-Time Payments Request for Payment to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundRealTimePaymentsRequestForPayment>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundRealTimePaymentsRequestForPaymentID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InboundRealTimePaymentsRequestsForPaymentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundRealTimePaymentsRequestForPayment>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundRealTimePaymentsRequestsForPaymentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

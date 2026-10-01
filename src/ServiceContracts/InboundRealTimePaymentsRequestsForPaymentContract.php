<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestsForPaymentListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestsForPaymentListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundRealTimePaymentsRequestsForPaymentContract
{
    /**
     * @api
     *
     * @param string $inboundRealTimePaymentsRequestForPaymentID the identifier of the Inbound Real-Time Payments Request for Payment to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundRealTimePaymentsRequestForPaymentID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundRealTimePaymentsRequestForPayment;

    /**
     * @api
     *
     * @param string $accountID filter Inbound Real-Time Payments Requests for Payment to those belonging to the specified Account
     * @param string $accountNumberID filter Inbound Real-Time Payments Requests for Payment to ones belonging to the specified Account Number
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     *
     * Defaults to `100`.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<InboundRealTimePaymentsRequestForPayment>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ?string $accountNumberID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        int $limit = 100,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}

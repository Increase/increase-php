<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestForPayment;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestsForPaymentListParams;
use Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestsForPaymentListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundRealTimePaymentsRequestsForPaymentRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundRealTimePaymentsRequestsForPayment\InboundRealTimePaymentsRequestsForPaymentListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundRealTimePaymentsRequestsForPaymentRawService implements InboundRealTimePaymentsRequestsForPaymentRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an Inbound Real-Time Payments Request for Payment
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'inbound_real_time_payments_requests_for_payment/%1$s',
                $inboundRealTimePaymentsRequestForPaymentID,
            ],
            options: $requestOptions,
            convert: InboundRealTimePaymentsRequestForPayment::class,
        );
    }

    /**
     * @api
     *
     * List Inbound Real-Time Payments Requests for Payment
     *
     * @param array{
     *   accountID?: string,
     *   accountNumberID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     * }|InboundRealTimePaymentsRequestsForPaymentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundRealTimePaymentsRequestForPayment>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundRealTimePaymentsRequestsForPaymentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundRealTimePaymentsRequestsForPaymentListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'inbound_real_time_payments_requests_for_payment',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'accountNumberID' => 'account_number_id',
                    'createdAt' => 'created_at',
                ],
            ),
            options: $options,
            convert: InboundRealTimePaymentsRequestForPayment::class,
            page: Page::class,
        );
    }
}

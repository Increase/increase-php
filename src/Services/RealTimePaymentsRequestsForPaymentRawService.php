<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCancelParams;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCancelParams\Reason;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams\Debtor;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentListParams;
use Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentListParams\CreatedAt;
use Increase\RequestOptions;
use Increase\ServiceContracts\RealTimePaymentsRequestsForPaymentRawContract;

/**
 * @phpstan-import-type DebtorShape from \Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams\Debtor
 * @phpstan-import-type CreatedAtShape from \Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class RealTimePaymentsRequestsForPaymentRawService implements RealTimePaymentsRequestsForPaymentRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Real-Time Payments Request for Payment
     *
     * @param array{
     *   accountNumberID: string,
     *   amount: int,
     *   debtor: Debtor|DebtorShape,
     *   debtorAccountNumber: string,
     *   debtorRoutingNumber: string,
     *   expiresAt: \DateTimeInterface,
     *   requestedExecutionAt: \DateTimeInterface,
     *   unstructuredRemittanceInformation: string,
     *   creditorName?: string,
     * }|RealTimePaymentsRequestsForPaymentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsRequestForPayment>
     *
     * @throws APIException
     */
    public function create(
        array|RealTimePaymentsRequestsForPaymentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RealTimePaymentsRequestsForPaymentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'real_time_payments_requests_for_payment',
            body: (object) $parsed,
            options: $options,
            convert: RealTimePaymentsRequestForPayment::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Real-Time Payments Request for Payment
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'real_time_payments_requests_for_payment/%1$s',
                $realTimePaymentsRequestForPaymentID,
            ],
            options: $requestOptions,
            convert: RealTimePaymentsRequestForPayment::class,
        );
    }

    /**
     * @api
     *
     * List Real-Time Payments Requests for Payment
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     * }|RealTimePaymentsRequestsForPaymentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<RealTimePaymentsRequestForPayment>>
     *
     * @throws APIException
     */
    public function list(
        array|RealTimePaymentsRequestsForPaymentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RealTimePaymentsRequestsForPaymentListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'real_time_payments_requests_for_payment',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: RealTimePaymentsRequestForPayment::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Cancels a Real-Time Payments Request for Payment that is still awaiting payment.
     *
     * @param string $realTimePaymentsRequestForPaymentID the identifier of the Real-Time Payments Request for Payment to cancel
     * @param array{
     *   additionalInformation?: string, reason?: Reason|value-of<Reason>
     * }|RealTimePaymentsRequestsForPaymentCancelParams $params
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
    ): BaseResponse {
        [$parsed, $options] = RealTimePaymentsRequestsForPaymentCancelParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'real_time_payments_requests_for_payment/%1$s/cancel',
                $realTimePaymentsRequestForPaymentID,
            ],
            body: (object) $parsed,
            options: $options,
            convert: RealTimePaymentsRequestForPayment::class,
        );
    }
}

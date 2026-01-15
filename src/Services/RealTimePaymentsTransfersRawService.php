<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferCreateParams;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferListParams;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferListParams\CreatedAt;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferListParams\Status;
use Increase\RequestOptions;
use Increase\ServiceContracts\RealTimePaymentsTransfersRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class RealTimePaymentsTransfersRawService implements RealTimePaymentsTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Real-Time Payments Transfer
     *
     * @param array{
     *   amount: int,
     *   creditorName: string,
     *   remittanceInformation: string,
     *   sourceAccountNumberID: string,
     *   debtorName?: string,
     *   destinationAccountNumber?: string,
     *   destinationRoutingNumber?: string,
     *   externalAccountID?: string,
     *   requireApproval?: bool,
     *   ultimateCreditorName?: string,
     *   ultimateDebtorName?: string,
     * }|RealTimePaymentsTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|RealTimePaymentsTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RealTimePaymentsTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'real_time_payments_transfers',
            body: (object) $parsed,
            options: $options,
            convert: RealTimePaymentsTransfer::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Real-Time Payments Transfer
     *
     * @param string $realTimePaymentsTransferID the identifier of the Real-Time Payments Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $realTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['real_time_payments_transfers/%1$s', $realTimePaymentsTransferID],
            options: $requestOptions,
            convert: RealTimePaymentsTransfer::class,
        );
    }

    /**
     * @api
     *
     * List Real-Time Payments Transfers
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   externalAccountID?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|RealTimePaymentsTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<RealTimePaymentsTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|RealTimePaymentsTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RealTimePaymentsTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'real_time_payments_transfers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'externalAccountID' => 'external_account_id',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: RealTimePaymentsTransfer::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Approves a Real-Time Payments Transfer in a pending_approval state.
     *
     * @param string $realTimePaymentsTransferID the identifier of the Real-Time Payments Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $realTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'real_time_payments_transfers/%1$s/approve', $realTimePaymentsTransferID,
            ],
            options: $requestOptions,
            convert: RealTimePaymentsTransfer::class,
        );
    }

    /**
     * @api
     *
     * Cancels a Real-Time Payments Transfer in a pending_approval state.
     *
     * @param string $realTimePaymentsTransferID the identifier of the pending Real-Time Payments Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $realTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'real_time_payments_transfers/%1$s/cancel', $realTimePaymentsTransferID,
            ],
            options: $requestOptions,
            convert: RealTimePaymentsTransfer::class,
        );
    }
}

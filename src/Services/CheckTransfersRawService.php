<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CheckTransfers\CheckTransfer;
use Increase\CheckTransfers\CheckTransferCreateParams;
use Increase\CheckTransfers\CheckTransferCreateParams\BalanceCheck;
use Increase\CheckTransfers\CheckTransferCreateParams\FulfillmentMethod;
use Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck;
use Increase\CheckTransfers\CheckTransferCreateParams\ThirdParty;
use Increase\CheckTransfers\CheckTransferListParams;
use Increase\CheckTransfers\CheckTransferListParams\CreatedAt;
use Increase\CheckTransfers\CheckTransferListParams\Status;
use Increase\CheckTransfers\CheckTransferStopPaymentParams;
use Increase\CheckTransfers\CheckTransferStopPaymentParams\Reason;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CheckTransfersRawContract;

/**
 * @phpstan-import-type PhysicalCheckShape from \Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck
 * @phpstan-import-type ThirdPartyShape from \Increase\CheckTransfers\CheckTransferCreateParams\ThirdParty
 * @phpstan-import-type CreatedAtShape from \Increase\CheckTransfers\CheckTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\CheckTransfers\CheckTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckTransfersRawService implements CheckTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Check Transfer
     *
     * @param array{
     *   accountID: string,
     *   amount: int,
     *   fulfillmentMethod: FulfillmentMethod|value-of<FulfillmentMethod>,
     *   sourceAccountNumberID: string,
     *   balanceCheck?: BalanceCheck|value-of<BalanceCheck>,
     *   checkNumber?: string,
     *   physicalCheck?: PhysicalCheck|PhysicalCheckShape,
     *   requireApproval?: bool,
     *   thirdParty?: ThirdParty|ThirdPartyShape,
     *   validUntilDate?: string,
     * }|CheckTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|CheckTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'check_transfers',
            body: (object) $parsed,
            options: $options,
            convert: CheckTransfer::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Check Transfer
     *
     * @param string $checkTransferID the identifier of the Check Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['check_transfers/%1$s', $checkTransferID],
            options: $requestOptions,
            convert: CheckTransfer::class,
        );
    }

    /**
     * @api
     *
     * List Check Transfers
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|CheckTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CheckTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|CheckTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'check_transfers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: CheckTransfer::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Approve a Check Transfer
     *
     * @param string $checkTransferID the identifier of the Check Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['check_transfers/%1$s/approve', $checkTransferID],
            options: $requestOptions,
            convert: CheckTransfer::class,
        );
    }

    /**
     * @api
     *
     * Cancel a Check Transfer with the `pending_approval` status. See [Transfer Approvals](/documentation/transfer-approvals) for more information.
     *
     * @param string $checkTransferID the identifier of the pending Check Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['check_transfers/%1$s/cancel', $checkTransferID],
            options: $requestOptions,
            convert: CheckTransfer::class,
        );
    }

    /**
     * @api
     *
     * Stop payment on a Check Transfer
     *
     * @param string $checkTransferID the identifier of the Check Transfer
     * @param array{
     *   reason?: Reason|value-of<Reason>
     * }|CheckTransferStopPaymentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckTransfer>
     *
     * @throws APIException
     */
    public function stopPayment(
        string $checkTransferID,
        array|CheckTransferStopPaymentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckTransferStopPaymentParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['check_transfers/%1$s/stop_payment', $checkTransferID],
            body: (object) $parsed,
            options: $options,
            convert: CheckTransfer::class,
        );
    }
}

<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundACHTransfers\InboundACHTransfer;
use Increase\InboundACHTransfers\InboundACHTransferCreateNotificationOfChangeParams;
use Increase\InboundACHTransfers\InboundACHTransferDeclineParams;
use Increase\InboundACHTransfers\InboundACHTransferDeclineParams\Reason;
use Increase\InboundACHTransfers\InboundACHTransferListParams;
use Increase\InboundACHTransfers\InboundACHTransferListParams\CreatedAt;
use Increase\InboundACHTransfers\InboundACHTransferListParams\Status;
use Increase\InboundACHTransfers\InboundACHTransferTransferReturnParams;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundACHTransfersRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundACHTransfers\InboundACHTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\InboundACHTransfers\InboundACHTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundACHTransfersRawService implements InboundACHTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an Inbound ACH Transfer
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundACHTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundACHTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['inbound_ach_transfers/%1$s', $inboundACHTransferID],
            options: $requestOptions,
            convert: InboundACHTransfer::class,
        );
    }

    /**
     * @api
     *
     * List Inbound ACH Transfers
     *
     * @param array{
     *   accountID?: string,
     *   accountNumberID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|InboundACHTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundACHTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundACHTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundACHTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'inbound_ach_transfers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'accountNumberID' => 'account_number_id',
                    'createdAt' => 'created_at',
                ],
            ),
            options: $options,
            convert: InboundACHTransfer::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Create a notification of change for an Inbound ACH Transfer
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer for which to create a notification of change
     * @param array{
     *   updatedAccountNumber?: string, updatedRoutingNumber?: string
     * }|InboundACHTransferCreateNotificationOfChangeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundACHTransfer>
     *
     * @throws APIException
     */
    public function createNotificationOfChange(
        string $inboundACHTransferID,
        array|InboundACHTransferCreateNotificationOfChangeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundACHTransferCreateNotificationOfChangeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'inbound_ach_transfers/%1$s/create_notification_of_change',
                $inboundACHTransferID,
            ],
            body: (object) $parsed,
            options: $options,
            convert: InboundACHTransfer::class,
        );
    }

    /**
     * @api
     *
     * Decline an Inbound ACH Transfer
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer to decline
     * @param array{reason?: value-of<Reason>}|InboundACHTransferDeclineParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundACHTransfer>
     *
     * @throws APIException
     */
    public function decline(
        string $inboundACHTransferID,
        array|InboundACHTransferDeclineParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundACHTransferDeclineParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['inbound_ach_transfers/%1$s/decline', $inboundACHTransferID],
            body: (object) $parsed,
            options: $options,
            convert: InboundACHTransfer::class,
        );
    }

    /**
     * @api
     *
     * Return an Inbound ACH Transfer
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer to return to the originating financial institution
     * @param array{
     *   reason: value-of<InboundACHTransferTransferReturnParams\Reason>,
     * }|InboundACHTransferTransferReturnParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundACHTransfer>
     *
     * @throws APIException
     */
    public function transferReturn(
        string $inboundACHTransferID,
        array|InboundACHTransferTransferReturnParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundACHTransferTransferReturnParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'inbound_ach_transfers/%1$s/transfer_return', $inboundACHTransferID,
            ],
            body: (object) $parsed,
            options: $options,
            convert: InboundACHTransfer::class,
        );
    }
}

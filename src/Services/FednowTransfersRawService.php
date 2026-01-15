<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\FednowTransfers\FednowTransfer;
use Increase\FednowTransfers\FednowTransferCreateParams;
use Increase\FednowTransfers\FednowTransferCreateParams\CreditorAddress;
use Increase\FednowTransfers\FednowTransferCreateParams\DebtorAddress;
use Increase\FednowTransfers\FednowTransferListParams;
use Increase\FednowTransfers\FednowTransferListParams\CreatedAt;
use Increase\FednowTransfers\FednowTransferListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\FednowTransfersRawContract;

/**
 * @phpstan-import-type CreditorAddressShape from \Increase\FednowTransfers\FednowTransferCreateParams\CreditorAddress
 * @phpstan-import-type DebtorAddressShape from \Increase\FednowTransfers\FednowTransferCreateParams\DebtorAddress
 * @phpstan-import-type CreatedAtShape from \Increase\FednowTransfers\FednowTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\FednowTransfers\FednowTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class FednowTransfersRawService implements FednowTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a FedNow Transfer
     *
     * @param array{
     *   accountID: string,
     *   amount: int,
     *   creditorName: string,
     *   debtorName: string,
     *   sourceAccountNumberID: string,
     *   unstructuredRemittanceInformation: string,
     *   accountNumber?: string,
     *   creditorAddress?: CreditorAddress|CreditorAddressShape,
     *   debtorAddress?: DebtorAddress|DebtorAddressShape,
     *   externalAccountID?: string,
     *   requireApproval?: bool,
     *   routingNumber?: string,
     * }|FednowTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FednowTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|FednowTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FednowTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'fednow_transfers',
            body: (object) $parsed,
            options: $options,
            convert: FednowTransfer::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a FedNow Transfer
     *
     * @param string $fednowTransferID the identifier of the FedNow Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FednowTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $fednowTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['fednow_transfers/%1$s', $fednowTransferID],
            options: $requestOptions,
            convert: FednowTransfer::class,
        );
    }

    /**
     * @api
     *
     * List FedNow Transfers
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   externalAccountID?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|FednowTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<FednowTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|FednowTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FednowTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'fednow_transfers',
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
            convert: FednowTransfer::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Approve a FedNow Transfer
     *
     * @param string $fednowTransferID the identifier of the FedNow Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FednowTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $fednowTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['fednow_transfers/%1$s/approve', $fednowTransferID],
            options: $requestOptions,
            convert: FednowTransfer::class,
        );
    }

    /**
     * @api
     *
     * Cancel a pending FedNow Transfer
     *
     * @param string $fednowTransferID the identifier of the pending FedNow Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FednowTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $fednowTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['fednow_transfers/%1$s/cancel', $fednowTransferID],
            options: $requestOptions,
            convert: FednowTransfer::class,
        );
    }
}

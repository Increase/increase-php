<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\SwiftTransfersRawContract;
use Increase\SwiftTransfers\SwiftTransfer;
use Increase\SwiftTransfers\SwiftTransferCreateParams;
use Increase\SwiftTransfers\SwiftTransferCreateParams\CreditorAddress;
use Increase\SwiftTransfers\SwiftTransferCreateParams\DebtorAddress;
use Increase\SwiftTransfers\SwiftTransferCreateParams\InstructedCurrency;
use Increase\SwiftTransfers\SwiftTransferListParams;
use Increase\SwiftTransfers\SwiftTransferListParams\CreatedAt;
use Increase\SwiftTransfers\SwiftTransferListParams\Status;

/**
 * @phpstan-import-type CreditorAddressShape from \Increase\SwiftTransfers\SwiftTransferCreateParams\CreditorAddress
 * @phpstan-import-type DebtorAddressShape from \Increase\SwiftTransfers\SwiftTransferCreateParams\DebtorAddress
 * @phpstan-import-type CreatedAtShape from \Increase\SwiftTransfers\SwiftTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\SwiftTransfers\SwiftTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class SwiftTransfersRawService implements SwiftTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Swift Transfer
     *
     * @param array{
     *   accountID: string,
     *   accountNumber: string,
     *   bankIdentificationCode: string,
     *   creditorAddress: CreditorAddress|CreditorAddressShape,
     *   creditorName: string,
     *   debtorAddress: DebtorAddress|DebtorAddressShape,
     *   debtorName: string,
     *   instructedAmount: int,
     *   instructedCurrency: InstructedCurrency|value-of<InstructedCurrency>,
     *   sourceAccountNumberID: string,
     *   unstructuredRemittanceInformation: string,
     *   requireApproval?: bool,
     *   routingNumber?: string,
     * }|SwiftTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SwiftTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|SwiftTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SwiftTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'swift_transfers',
            body: (object) $parsed,
            options: $options,
            convert: SwiftTransfer::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Swift Transfer
     *
     * @param string $swiftTransferID the identifier of the Swift Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SwiftTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['swift_transfers/%1$s', $swiftTransferID],
            options: $requestOptions,
            convert: SwiftTransfer::class,
        );
    }

    /**
     * @api
     *
     * List Swift Transfers
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|SwiftTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<SwiftTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|SwiftTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SwiftTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'swift_transfers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: SwiftTransfer::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Approve a Swift Transfer
     *
     * @param string $swiftTransferID the identifier of the Swift Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SwiftTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['swift_transfers/%1$s/approve', $swiftTransferID],
            options: $requestOptions,
            convert: SwiftTransfer::class,
        );
    }

    /**
     * @api
     *
     * Cancel a pending Swift Transfer
     *
     * @param string $swiftTransferID the identifier of the pending Swift Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SwiftTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['swift_transfers/%1$s/cancel', $swiftTransferID],
            options: $requestOptions,
            convert: SwiftTransfer::class,
        );
    }
}

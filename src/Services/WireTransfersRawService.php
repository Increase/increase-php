<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\WireTransfersRawContract;
use Increase\WireTransfers\WireTransfer;
use Increase\WireTransfers\WireTransferCreateParams;
use Increase\WireTransfers\WireTransferCreateParams\Creditor;
use Increase\WireTransfers\WireTransferCreateParams\Debtor;
use Increase\WireTransfers\WireTransferCreateParams\Remittance;
use Increase\WireTransfers\WireTransferListParams;
use Increase\WireTransfers\WireTransferListParams\CreatedAt;

/**
 * @phpstan-import-type CreditorShape from \Increase\WireTransfers\WireTransferCreateParams\Creditor
 * @phpstan-import-type RemittanceShape from \Increase\WireTransfers\WireTransferCreateParams\Remittance
 * @phpstan-import-type DebtorShape from \Increase\WireTransfers\WireTransferCreateParams\Debtor
 * @phpstan-import-type CreatedAtShape from \Increase\WireTransfers\WireTransferListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class WireTransfersRawService implements WireTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Wire Transfer
     *
     * @param array{
     *   accountID: string,
     *   amount: int,
     *   creditor: Creditor|CreditorShape,
     *   remittance: Remittance|RemittanceShape,
     *   accountNumber?: string,
     *   debtor?: Debtor|DebtorShape,
     *   externalAccountID?: string,
     *   inboundWireDrawdownRequestID?: string,
     *   requireApproval?: bool,
     *   routingNumber?: string,
     *   sourceAccountNumberID?: string,
     * }|WireTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|WireTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WireTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'wire_transfers',
            body: (object) $parsed,
            options: $options,
            convert: WireTransfer::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Wire Transfer
     *
     * @param string $wireTransferID the identifier of the Wire Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['wire_transfers/%1$s', $wireTransferID],
            options: $requestOptions,
            convert: WireTransfer::class,
        );
    }

    /**
     * @api
     *
     * List Wire Transfers
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   externalAccountID?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     * }|WireTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<WireTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|WireTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WireTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'wire_transfers',
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
            convert: WireTransfer::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Approve a Wire Transfer
     *
     * @param string $wireTransferID the identifier of the Wire Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['wire_transfers/%1$s/approve', $wireTransferID],
            options: $requestOptions,
            convert: WireTransfer::class,
        );
    }

    /**
     * @api
     *
     * Cancel a pending Wire Transfer
     *
     * @param string $wireTransferID the identifier of the pending Wire Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['wire_transfers/%1$s/cancel', $wireTransferID],
            options: $requestOptions,
            convert: WireTransfer::class,
        );
    }
}

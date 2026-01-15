<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundWireTransfers\InboundWireTransfer;
use Increase\InboundWireTransfers\InboundWireTransferListParams;
use Increase\InboundWireTransfers\InboundWireTransferListParams\CreatedAt;
use Increase\InboundWireTransfers\InboundWireTransferListParams\Status;
use Increase\InboundWireTransfers\InboundWireTransferReverseParams;
use Increase\InboundWireTransfers\InboundWireTransferReverseParams\Reason;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundWireTransfersRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundWireTransfers\InboundWireTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\InboundWireTransfers\InboundWireTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundWireTransfersRawService implements InboundWireTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an Inbound Wire Transfer
     *
     * @param string $inboundWireTransferID the identifier of the Inbound Wire Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundWireTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundWireTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['inbound_wire_transfers/%1$s', $inboundWireTransferID],
            options: $requestOptions,
            convert: InboundWireTransfer::class,
        );
    }

    /**
     * @api
     *
     * List Inbound Wire Transfers
     *
     * @param array{
     *   accountID?: string,
     *   accountNumberID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     *   wireDrawdownRequestID?: string,
     * }|InboundWireTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundWireTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundWireTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundWireTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'inbound_wire_transfers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'accountNumberID' => 'account_number_id',
                    'createdAt' => 'created_at',
                    'wireDrawdownRequestID' => 'wire_drawdown_request_id',
                ],
            ),
            options: $options,
            convert: InboundWireTransfer::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Reverse an Inbound Wire Transfer
     *
     * @param string $inboundWireTransferID the identifier of the Inbound Wire Transfer to reverse
     * @param array{
     *   reason: Reason|value-of<Reason>
     * }|InboundWireTransferReverseParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundWireTransfer>
     *
     * @throws APIException
     */
    public function reverse(
        string $inboundWireTransferID,
        array|InboundWireTransferReverseParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundWireTransferReverseParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['inbound_wire_transfers/%1$s/reverse', $inboundWireTransferID],
            body: (object) $parsed,
            options: $options,
            convert: InboundWireTransfer::class,
        );
    }
}

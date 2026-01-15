<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundFednowTransfers\InboundFednowTransfer;
use Increase\InboundFednowTransfers\InboundFednowTransferListParams;
use Increase\InboundFednowTransfers\InboundFednowTransferListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundFednowTransfersRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundFednowTransfers\InboundFednowTransferListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundFednowTransfersRawService implements InboundFednowTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an Inbound FedNow Transfer
     *
     * @param string $inboundFednowTransferID the identifier of the Inbound FedNow Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundFednowTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundFednowTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['inbound_fednow_transfers/%1$s', $inboundFednowTransferID],
            options: $requestOptions,
            convert: InboundFednowTransfer::class,
        );
    }

    /**
     * @api
     *
     * List Inbound FedNow Transfers
     *
     * @param array{
     *   accountID?: string,
     *   accountNumberID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     * }|InboundFednowTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundFednowTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundFednowTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundFednowTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'inbound_fednow_transfers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'accountNumberID' => 'account_number_id',
                    'createdAt' => 'created_at',
                ],
            ),
            options: $options,
            convert: InboundFednowTransfer::class,
            page: Page::class,
        );
    }
}

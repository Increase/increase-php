<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransferListParams;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransferListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundRealTimePaymentsTransfersRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransferListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundRealTimePaymentsTransfersRawService implements InboundRealTimePaymentsTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an Inbound Real-Time Payments Transfer
     *
     * @param string $inboundRealTimePaymentsTransferID the identifier of the Inbound Real-Time Payments Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundRealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundRealTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'inbound_real_time_payments_transfers/%1$s',
                $inboundRealTimePaymentsTransferID,
            ],
            options: $requestOptions,
            convert: InboundRealTimePaymentsTransfer::class,
        );
    }

    /**
     * @api
     *
     * List Inbound Real-Time Payments Transfers
     *
     * @param array{
     *   accountID?: string,
     *   accountNumberID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     * }|InboundRealTimePaymentsTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundRealTimePaymentsTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundRealTimePaymentsTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundRealTimePaymentsTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'inbound_real_time_payments_transfers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'accountNumberID' => 'account_number_id',
                    'createdAt' => 'created_at',
                ],
            ),
            options: $options,
            convert: InboundRealTimePaymentsTransfer::class,
            page: Page::class,
        );
    }
}

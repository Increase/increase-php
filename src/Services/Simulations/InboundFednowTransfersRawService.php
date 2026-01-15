<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundFednowTransfers\InboundFednowTransfer;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundFednowTransfersRawContract;
use Increase\Simulations\InboundFednowTransfers\InboundFednowTransferCreateParams;

/**
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
     * Simulates an [Inbound FedNow Transfer](#inbound-fednow-transfers) to your account.
     *
     * @param array{
     *   accountNumberID: string,
     *   amount: int,
     *   debtorAccountNumber?: string,
     *   debtorName?: string,
     *   debtorRoutingNumber?: string,
     *   unstructuredRemittanceInformation?: string,
     * }|InboundFednowTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundFednowTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|InboundFednowTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundFednowTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/inbound_fednow_transfers',
            body: (object) $parsed,
            options: $options,
            convert: InboundFednowTransfer::class,
        );
    }
}

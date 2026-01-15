<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundWireTransfers\InboundWireTransfer;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundWireTransfersRawContract;
use Increase\Simulations\InboundWireTransfers\InboundWireTransferCreateParams;

/**
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
     * Simulates an [Inbound Wire Transfer](#inbound-wire-transfers) to your account.
     *
     * @param array{
     *   accountNumberID: string,
     *   amount: int,
     *   creditorAddressLine1?: string,
     *   creditorAddressLine2?: string,
     *   creditorAddressLine3?: string,
     *   creditorName?: string,
     *   debtorAddressLine1?: string,
     *   debtorAddressLine2?: string,
     *   debtorAddressLine3?: string,
     *   debtorName?: string,
     *   endToEndIdentification?: string,
     *   instructingAgentRoutingNumber?: string,
     *   instructionIdentification?: string,
     *   uniqueEndToEndTransactionReference?: string,
     *   unstructuredRemittanceInformation?: string,
     *   wireDrawdownRequestID?: string,
     * }|InboundWireTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundWireTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|InboundWireTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundWireTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/inbound_wire_transfers',
            body: (object) $parsed,
            options: $options,
            convert: InboundWireTransfer::class,
        );
    }
}

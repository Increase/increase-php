<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequest;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundWireDrawdownRequestsRawContract;
use Increase\Simulations\InboundWireDrawdownRequests\InboundWireDrawdownRequestCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundWireDrawdownRequestsRawService implements InboundWireDrawdownRequestsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates receiving an [Inbound Wire Drawdown Request](#inbound-wire-drawdown-requests).
     *
     * @param array{
     *   amount: int,
     *   creditorAccountNumber: string,
     *   creditorRoutingNumber: string,
     *   currency: string,
     *   recipientAccountNumberID: string,
     *   creditorAddressLine1?: string,
     *   creditorAddressLine2?: string,
     *   creditorAddressLine3?: string,
     *   creditorName?: string,
     *   debtorAccountNumber?: string,
     *   debtorAddressLine1?: string,
     *   debtorAddressLine2?: string,
     *   debtorAddressLine3?: string,
     *   debtorName?: string,
     *   debtorRoutingNumber?: string,
     *   endToEndIdentification?: string,
     *   instructionIdentification?: string,
     *   uniqueEndToEndTransactionReference?: string,
     *   unstructuredRemittanceInformation?: string,
     * }|InboundWireDrawdownRequestCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundWireDrawdownRequest>
     *
     * @throws APIException
     */
    public function create(
        array|InboundWireDrawdownRequestCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundWireDrawdownRequestCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/inbound_wire_drawdown_requests',
            body: (object) $parsed,
            options: $options,
            convert: InboundWireDrawdownRequest::class,
        );
    }
}

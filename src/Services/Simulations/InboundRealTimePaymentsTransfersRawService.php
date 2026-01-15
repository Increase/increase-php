<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundRealTimePaymentsTransfersRawContract;
use Increase\Simulations\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransferCreateParams;

/**
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
     * Simulates an [Inbound Real-Time Payments Transfer](#inbound-real-time-payments-transfers) to your account. Real-Time Payments are a beta feature.
     *
     * @param array{
     *   accountNumberID: string,
     *   amount: int,
     *   debtorAccountNumber?: string,
     *   debtorName?: string,
     *   debtorRoutingNumber?: string,
     *   remittanceInformation?: string,
     *   requestForPaymentID?: string,
     * }|InboundRealTimePaymentsTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundRealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|InboundRealTimePaymentsTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundRealTimePaymentsTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/inbound_real_time_payments_transfers',
            body: (object) $parsed,
            options: $options,
            convert: InboundRealTimePaymentsTransfer::class,
        );
    }
}

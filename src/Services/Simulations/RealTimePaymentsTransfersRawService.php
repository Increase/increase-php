<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\RealTimePaymentsTransfersRawContract;
use Increase\Simulations\RealTimePaymentsTransfers\RealTimePaymentsTransferCompleteParams;
use Increase\Simulations\RealTimePaymentsTransfers\RealTimePaymentsTransferCompleteParams\Rejection;

/**
 * @phpstan-import-type RejectionShape from \Increase\Simulations\RealTimePaymentsTransfers\RealTimePaymentsTransferCompleteParams\Rejection
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class RealTimePaymentsTransfersRawService implements RealTimePaymentsTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates submission of a [Real-Time Payments Transfer](#real-time-payments-transfers) and handling the response from the destination financial institution. This transfer must first have a `status` of `pending_submission`.
     *
     * @param string $realTimePaymentsTransferID the identifier of the Real-Time Payments Transfer you wish to complete
     * @param array{
     *   rejection?: Rejection|RejectionShape
     * }|RealTimePaymentsTransferCompleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function complete(
        string $realTimePaymentsTransferID,
        array|RealTimePaymentsTransferCompleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RealTimePaymentsTransferCompleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'simulations/real_time_payments_transfers/%1$s/complete',
                $realTimePaymentsTransferID,
            ],
            body: (object) $parsed,
            options: $options,
            convert: RealTimePaymentsTransfer::class,
        );
    }
}

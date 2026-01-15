<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\RealTimePaymentsTransfersContract;
use Increase\Simulations\RealTimePaymentsTransfers\RealTimePaymentsTransferCompleteParams\Rejection;

/**
 * @phpstan-import-type RejectionShape from \Increase\Simulations\RealTimePaymentsTransfers\RealTimePaymentsTransferCompleteParams\Rejection
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class RealTimePaymentsTransfersService implements RealTimePaymentsTransfersContract
{
    /**
     * @api
     */
    public RealTimePaymentsTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RealTimePaymentsTransfersRawService($client);
    }

    /**
     * @api
     *
     * Simulates submission of a [Real-Time Payments Transfer](#real-time-payments-transfers) and handling the response from the destination financial institution. This transfer must first have a `status` of `pending_submission`.
     *
     * @param string $realTimePaymentsTransferID the identifier of the Real-Time Payments Transfer you wish to complete
     * @param Rejection|RejectionShape $rejection if set, the simulation will reject the transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function complete(
        string $realTimePaymentsTransferID,
        Rejection|array|null $rejection = null,
        RequestOptions|array|null $requestOptions = null,
    ): RealTimePaymentsTransfer {
        $params = Util::removeNulls(['rejection' => $rejection]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->complete($realTimePaymentsTransferID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

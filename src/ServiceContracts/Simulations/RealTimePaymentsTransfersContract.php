<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;
use Increase\RequestOptions;
use Increase\Simulations\RealTimePaymentsTransfers\RealTimePaymentsTransferCompleteParams\Rejection;

/**
 * @phpstan-import-type RejectionShape from \Increase\Simulations\RealTimePaymentsTransfers\RealTimePaymentsTransferCompleteParams\Rejection
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface RealTimePaymentsTransfersContract
{
    /**
     * @api
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
    ): RealTimePaymentsTransfer;
}

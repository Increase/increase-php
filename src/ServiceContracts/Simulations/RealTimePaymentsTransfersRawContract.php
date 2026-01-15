<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;
use Increase\RequestOptions;
use Increase\Simulations\RealTimePaymentsTransfers\RealTimePaymentsTransferCompleteParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface RealTimePaymentsTransfersRawContract
{
    /**
     * @api
     *
     * @param string $realTimePaymentsTransferID the identifier of the Real-Time Payments Transfer you wish to complete
     * @param array<string,mixed>|RealTimePaymentsTransferCompleteParams $params
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
    ): BaseResponse;
}

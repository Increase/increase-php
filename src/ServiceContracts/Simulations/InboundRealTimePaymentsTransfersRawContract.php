<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer;
use Increase\RequestOptions;
use Increase\Simulations\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransferCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundRealTimePaymentsTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InboundRealTimePaymentsTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundRealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|InboundRealTimePaymentsTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundWireTransfers\InboundWireTransfer;
use Increase\RequestOptions;
use Increase\Simulations\InboundWireTransfers\InboundWireTransferCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundWireTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InboundWireTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundWireTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|InboundWireTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundFednowTransfers\InboundFednowTransfer;
use Increase\RequestOptions;
use Increase\Simulations\InboundFednowTransfers\InboundFednowTransferCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundFednowTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InboundFednowTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundFednowTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|InboundFednowTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

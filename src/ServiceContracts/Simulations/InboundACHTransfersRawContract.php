<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundACHTransfers\InboundACHTransfer;
use Increase\RequestOptions;
use Increase\Simulations\InboundACHTransfers\InboundACHTransferCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundACHTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InboundACHTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundACHTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|InboundACHTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

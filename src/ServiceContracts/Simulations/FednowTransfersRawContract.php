<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\FednowTransfers\FednowTransfer;
use Increase\RequestOptions;
use Increase\Simulations\FednowTransfers\FednowTransferCompleteParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface FednowTransfersRawContract
{
    /**
     * @api
     *
     * @param string $fednowTransferID the identifier of the FedNow Transfer you wish to complete
     * @param array<string,mixed>|FednowTransferCompleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FednowTransfer>
     *
     * @throws APIException
     */
    public function complete(
        string $fednowTransferID,
        array|FednowTransferCompleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

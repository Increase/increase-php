<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\FednowTransfers\FednowTransfer;
use Increase\RequestOptions;
use Increase\Simulations\FednowTransfers\FednowTransferCompleteParams\Rejection;

/**
 * @phpstan-import-type RejectionShape from \Increase\Simulations\FednowTransfers\FednowTransferCompleteParams\Rejection
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface FednowTransfersContract
{
    /**
     * @api
     *
     * @param string $fednowTransferID the identifier of the FedNow Transfer you wish to complete
     * @param Rejection|RejectionShape $rejection if set, the simulation will reject the transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function complete(
        string $fednowTransferID,
        Rejection|array|null $rejection = null,
        RequestOptions|array|null $requestOptions = null,
    ): FednowTransfer;
}

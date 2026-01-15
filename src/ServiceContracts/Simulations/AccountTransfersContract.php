<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\AccountTransfers\AccountTransfer;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountTransfersContract
{
    /**
     * @api
     *
     * @param string $accountTransferID the identifier of the Account Transfer you wish to complete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function complete(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): AccountTransfer;
}

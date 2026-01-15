<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\AccountTransfers\AccountTransfer;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountTransfersRawContract
{
    /**
     * @api
     *
     * @param string $accountTransferID the identifier of the Account Transfer you wish to complete
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountTransfer>
     *
     * @throws APIException
     */
    public function complete(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

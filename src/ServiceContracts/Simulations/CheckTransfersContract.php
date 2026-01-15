<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CheckTransfers\CheckTransfer;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckTransfersContract
{
    /**
     * @api
     *
     * @param string $checkTransferID the identifier of the Check Transfer you wish to mail
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function mail(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): CheckTransfer;
}

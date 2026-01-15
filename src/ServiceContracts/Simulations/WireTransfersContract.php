<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\WireTransfers\WireTransfer;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface WireTransfersContract
{
    /**
     * @api
     *
     * @param string $wireTransferID the identifier of the Wire Transfer you wish to reverse
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function reverse(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): WireTransfer;

    /**
     * @api
     *
     * @param string $wireTransferID the identifier of the Wire Transfer you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): WireTransfer;
}

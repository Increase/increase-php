<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\WireTransfers\WireTransfer;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface WireTransfersRawContract
{
    /**
     * @api
     *
     * @param string $wireTransferID the identifier of the Wire Transfer you wish to reverse
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function reverse(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $wireTransferID the identifier of the Wire Transfer you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function submit(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

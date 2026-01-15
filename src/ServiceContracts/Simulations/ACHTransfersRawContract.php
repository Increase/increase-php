<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\ACHTransfers\ACHTransfer;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\ACHTransfers\ACHTransferCreateNotificationOfChangeParams;
use Increase\Simulations\ACHTransfers\ACHTransferReturnParams;
use Increase\Simulations\ACHTransfers\ACHTransferSettleParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ACHTransfersRawContract
{
    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to become acknowledged
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function acknowledge(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to create a notification of change for
     * @param array<string,mixed>|ACHTransferCreateNotificationOfChangeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function createNotificationOfChange(
        string $achTransferID,
        array|ACHTransferCreateNotificationOfChangeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to return
     * @param array<string,mixed>|ACHTransferReturnParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function return(
        string $achTransferID,
        array|ACHTransferReturnParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to become settled
     * @param array<string,mixed>|ACHTransferSettleParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function settle(
        string $achTransferID,
        array|ACHTransferSettleParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function submit(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

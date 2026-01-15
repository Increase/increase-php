<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\ACHTransfers\ACHTransfer;
use Increase\ACHTransfers\ACHTransferCreateParams;
use Increase\ACHTransfers\ACHTransferListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ACHTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ACHTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|ACHTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ACHTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<ACHTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|ACHTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the pending ACH Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

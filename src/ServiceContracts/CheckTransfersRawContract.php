<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CheckTransfers\CheckTransfer;
use Increase\CheckTransfers\CheckTransferCreateParams;
use Increase\CheckTransfers\CheckTransferListParams;
use Increase\CheckTransfers\CheckTransferStopPaymentParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CheckTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|CheckTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $checkTransferID the identifier of the Check Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CheckTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CheckTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|CheckTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $checkTransferID the identifier of the Check Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $checkTransferID the identifier of the pending Check Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $checkTransferID the identifier of the Check Transfer
     * @param array<string,mixed>|CheckTransferStopPaymentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckTransfer>
     *
     * @throws APIException
     */
    public function stopPayment(
        string $checkTransferID,
        array|CheckTransferStopPaymentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

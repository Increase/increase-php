<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferCreateParams;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferListParams;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface RealTimePaymentsTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RealTimePaymentsTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|RealTimePaymentsTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $realTimePaymentsTransferID the identifier of the Real-Time Payments Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $realTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RealTimePaymentsTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<RealTimePaymentsTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|RealTimePaymentsTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $realTimePaymentsTransferID the identifier of the Real-Time Payments Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $realTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $realTimePaymentsTransferID the identifier of the pending Real-Time Payments Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $realTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

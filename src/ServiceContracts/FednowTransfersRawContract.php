<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\FednowTransfers\FednowTransfer;
use Increase\FednowTransfers\FednowTransferCreateParams;
use Increase\FednowTransfers\FednowTransferListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface FednowTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|FednowTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FednowTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|FednowTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $fednowTransferID the identifier of the FedNow Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FednowTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $fednowTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|FednowTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<FednowTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|FednowTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $fednowTransferID the identifier of the FedNow Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FednowTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $fednowTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $fednowTransferID the identifier of the pending FedNow Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FednowTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $fednowTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

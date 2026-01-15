<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;
use Increase\WireTransfers\WireTransfer;
use Increase\WireTransfers\WireTransferCreateParams;
use Increase\WireTransfers\WireTransferListParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface WireTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WireTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|WireTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $wireTransferID the identifier of the Wire Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WireTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<WireTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|WireTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $wireTransferID the identifier of the Wire Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $wireTransferID the identifier of the pending Wire Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

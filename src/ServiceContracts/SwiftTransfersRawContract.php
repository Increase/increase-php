<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;
use Increase\SwiftTransfers\SwiftTransfer;
use Increase\SwiftTransfers\SwiftTransferCreateParams;
use Increase\SwiftTransfers\SwiftTransferListParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface SwiftTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SwiftTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SwiftTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|SwiftTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $swiftTransferID the identifier of the Swift Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SwiftTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SwiftTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<SwiftTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|SwiftTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $swiftTransferID the identifier of the Swift Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SwiftTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $swiftTransferID the identifier of the pending Swift Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SwiftTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

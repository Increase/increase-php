<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundACHTransfers\InboundACHTransfer;
use Increase\InboundACHTransfers\InboundACHTransferCreateNotificationOfChangeParams;
use Increase\InboundACHTransfers\InboundACHTransferDeclineParams;
use Increase\InboundACHTransfers\InboundACHTransferListParams;
use Increase\InboundACHTransfers\InboundACHTransferTransferReturnParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundACHTransfersRawContract
{
    /**
     * @api
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundACHTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundACHTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InboundACHTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundACHTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundACHTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer for which to create a notification of change
     * @param array<string,mixed>|InboundACHTransferCreateNotificationOfChangeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundACHTransfer>
     *
     * @throws APIException
     */
    public function createNotificationOfChange(
        string $inboundACHTransferID,
        array|InboundACHTransferCreateNotificationOfChangeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer to decline
     * @param array<string,mixed>|InboundACHTransferDeclineParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundACHTransfer>
     *
     * @throws APIException
     */
    public function decline(
        string $inboundACHTransferID,
        array|InboundACHTransferDeclineParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer to return to the originating financial institution
     * @param array<string,mixed>|InboundACHTransferTransferReturnParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundACHTransfer>
     *
     * @throws APIException
     */
    public function transferReturn(
        string $inboundACHTransferID,
        array|InboundACHTransferTransferReturnParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundWireTransfers\InboundWireTransfer;
use Increase\InboundWireTransfers\InboundWireTransferListParams;
use Increase\InboundWireTransfers\InboundWireTransferReverseParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundWireTransfersRawContract
{
    /**
     * @api
     *
     * @param string $inboundWireTransferID the identifier of the Inbound Wire Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundWireTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundWireTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InboundWireTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundWireTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundWireTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $inboundWireTransferID the identifier of the Inbound Wire Transfer to reverse
     * @param array<string,mixed>|InboundWireTransferReverseParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundWireTransfer>
     *
     * @throws APIException
     */
    public function reverse(
        string $inboundWireTransferID,
        array|InboundWireTransferReverseParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

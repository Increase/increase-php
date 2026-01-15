<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundFednowTransfers\InboundFednowTransfer;
use Increase\InboundFednowTransfers\InboundFednowTransferListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundFednowTransfersRawContract
{
    /**
     * @api
     *
     * @param string $inboundFednowTransferID the identifier of the Inbound FedNow Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundFednowTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundFednowTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InboundFednowTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundFednowTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundFednowTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

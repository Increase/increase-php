<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransferListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundRealTimePaymentsTransfersRawContract
{
    /**
     * @api
     *
     * @param string $inboundRealTimePaymentsTransferID the identifier of the Inbound Real-Time Payments Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundRealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundRealTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InboundRealTimePaymentsTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundRealTimePaymentsTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundRealTimePaymentsTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

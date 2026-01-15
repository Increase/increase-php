<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequest;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequestListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundWireDrawdownRequestsRawContract
{
    /**
     * @api
     *
     * @param string $inboundWireDrawdownRequestID the identifier of the Inbound Wire Drawdown Request to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundWireDrawdownRequest>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundWireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InboundWireDrawdownRequestListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundWireDrawdownRequest>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundWireDrawdownRequestListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequest;
use Increase\RequestOptions;
use Increase\Simulations\InboundWireDrawdownRequests\InboundWireDrawdownRequestCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundWireDrawdownRequestsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InboundWireDrawdownRequestCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundWireDrawdownRequest>
     *
     * @throws APIException
     */
    public function create(
        array|InboundWireDrawdownRequestCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

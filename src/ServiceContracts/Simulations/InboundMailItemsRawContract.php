<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundMailItems\InboundMailItem;
use Increase\RequestOptions;
use Increase\Simulations\InboundMailItems\InboundMailItemCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundMailItemsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InboundMailItemCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundMailItem>
     *
     * @throws APIException
     */
    public function create(
        array|InboundMailItemCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

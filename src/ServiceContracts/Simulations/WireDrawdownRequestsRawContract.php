<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\WireDrawdownRequests\WireDrawdownRequestRefuseParams;
use Increase\WireDrawdownRequests\WireDrawdownRequest;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface WireDrawdownRequestsRawContract
{
    /**
     * @api
     *
     * @param string $wireDrawdownRequestID the identifier of the Wire Drawdown Request you wish to refuse
     * @param array<string,mixed>|WireDrawdownRequestRefuseParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireDrawdownRequest>
     *
     * @throws APIException
     */
    public function refuse(
        string $wireDrawdownRequestID,
        array|WireDrawdownRequestRefuseParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $wireDrawdownRequestID the identifier of the Wire Drawdown Request you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireDrawdownRequest>
     *
     * @throws APIException
     */
    public function submit(
        string $wireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

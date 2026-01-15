<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;
use Increase\WireDrawdownRequests\WireDrawdownRequest;
use Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams;
use Increase\WireDrawdownRequests\WireDrawdownRequestListParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface WireDrawdownRequestsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WireDrawdownRequestCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireDrawdownRequest>
     *
     * @throws APIException
     */
    public function create(
        array|WireDrawdownRequestCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $wireDrawdownRequestID the identifier of the Wire Drawdown Request to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireDrawdownRequest>
     *
     * @throws APIException
     */
    public function retrieve(
        string $wireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WireDrawdownRequestListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<WireDrawdownRequest>>
     *
     * @throws APIException
     */
    public function list(
        array|WireDrawdownRequestListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

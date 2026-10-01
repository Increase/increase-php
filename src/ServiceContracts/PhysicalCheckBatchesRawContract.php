<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\PhysicalCheckBatches\PhysicalCheckBatch;
use Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface PhysicalCheckBatchesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PhysicalCheckBatchCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCheckBatch>
     *
     * @throws APIException
     */
    public function create(
        array|PhysicalCheckBatchCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $physicalCheckBatchID the identifier of the pending Physical Check Batch to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCheckBatch>
     *
     * @throws APIException
     */
    public function cancel(
        string $physicalCheckBatchID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $physicalCheckBatchID the identifier of the Physical Check Batch to complete
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCheckBatch>
     *
     * @throws APIException
     */
    public function complete(
        string $physicalCheckBatchID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

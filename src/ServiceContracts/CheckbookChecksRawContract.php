<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CheckbookChecks\CheckbookCheck;
use Increase\CheckbookChecks\CheckbookCheckListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckbookChecksRawContract
{
    /**
     * @api
     *
     * @param string $checkbookCheckID the identifier of the Checkbook Check
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckbookCheck>
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkbookCheckID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CheckbookCheckListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CheckbookCheck>>
     *
     * @throws APIException
     */
    public function list(
        array|CheckbookCheckListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $checkbookCheckID the identifier of the Checkbook Check to stop
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckbookCheck>
     *
     * @throws APIException
     */
    public function stop(
        string $checkbookCheckID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

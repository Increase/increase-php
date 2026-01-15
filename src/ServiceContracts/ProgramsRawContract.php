<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\Programs\Program;
use Increase\Programs\ProgramListParams;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ProgramsRawContract
{
    /**
     * @api
     *
     * @param string $programID the identifier of the Program to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Program>
     *
     * @throws APIException
     */
    public function retrieve(
        string $programID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ProgramListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Program>>
     *
     * @throws APIException
     */
    public function list(
        array|ProgramListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

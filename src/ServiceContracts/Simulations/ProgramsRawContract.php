<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Programs\Program;
use Increase\RequestOptions;
use Increase\Simulations\Programs\ProgramCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ProgramsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ProgramCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Program>
     *
     * @throws APIException
     */
    public function create(
        array|ProgramCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

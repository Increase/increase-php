<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Checkbooks\Checkbook;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckbooksRawContract
{
    /**
     * @api
     *
     * @param string $checkbookID the identifier of the Checkbook you wish to mail
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Checkbook>
     *
     * @throws APIException
     */
    public function mail(
        string $checkbookID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

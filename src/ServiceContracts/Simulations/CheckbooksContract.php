<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Checkbooks\Checkbook;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckbooksContract
{
    /**
     * @api
     *
     * @param string $checkbookID the identifier of the Checkbook you wish to mail
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function mail(
        string $checkbookID,
        RequestOptions|array|null $requestOptions = null
    ): Checkbook;
}

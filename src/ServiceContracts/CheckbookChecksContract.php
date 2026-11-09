<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CheckbookChecks\CheckbookCheck;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckbookChecksContract
{
    /**
     * @api
     *
     * @param string $checkbookCheckID the identifier of the Checkbook Check
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkbookCheckID,
        RequestOptions|array|null $requestOptions = null
    ): CheckbookCheck;

    /**
     * @api
     *
     * @param string $accountNumberID filter Checkbook Checks to those drawn on the specified Account Number
     * @param int $checkNumber filter Checkbook Checks to the one with the specified check number
     * @param string $checkbookID filter Checkbook Checks to those belonging to the specified Checkbook
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     *
     * Defaults to `100`.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<CheckbookCheck>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountNumberID = null,
        ?int $checkNumber = null,
        ?string $checkbookID = null,
        ?string $cursor = null,
        int $limit = 100,
        RequestOptions|array|null $requestOptions = null,
    ): Page;

    /**
     * @api
     *
     * @param string $checkbookCheckID the identifier of the Checkbook Check to stop
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function stop(
        string $checkbookCheckID,
        RequestOptions|array|null $requestOptions = null
    ): CheckbookCheck;
}

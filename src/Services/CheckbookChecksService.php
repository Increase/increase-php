<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CheckbookChecks\CheckbookCheck;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CheckbookChecksContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckbookChecksService implements CheckbookChecksContract
{
    /**
     * @api
     */
    public CheckbookChecksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CheckbookChecksRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Checkbook Check
     *
     * @param string $checkbookCheckID the identifier of the Checkbook Check
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkbookCheckID,
        RequestOptions|array|null $requestOptions = null
    ): CheckbookCheck {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($checkbookCheckID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Checkbook Checks
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
    ): Page {
        $params = Util::removeNulls(
            [
                'accountNumberID' => $accountNumberID,
                'checkNumber' => $checkNumber,
                'checkbookID' => $checkbookID,
                'cursor' => $cursor,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Stop a Checkbook Check. A stopped check cannot be deposited.
     *
     * @param string $checkbookCheckID the identifier of the Checkbook Check to stop
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function stop(
        string $checkbookCheckID,
        RequestOptions|array|null $requestOptions = null
    ): CheckbookCheck {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->stop($checkbookCheckID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

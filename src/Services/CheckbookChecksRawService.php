<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CheckbookChecks\CheckbookCheck;
use Increase\CheckbookChecks\CheckbookCheckListParams;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CheckbookChecksRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckbookChecksRawService implements CheckbookChecksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Checkbook Check
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['checkbook_checks/%1$s', $checkbookCheckID],
            options: $requestOptions,
            convert: CheckbookCheck::class,
        );
    }

    /**
     * @api
     *
     * List Checkbook Checks
     *
     * @param array{
     *   accountNumberID?: string,
     *   checkNumber?: int,
     *   checkbookID?: string,
     *   cursor?: string,
     *   limit?: int,
     * }|CheckbookCheckListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CheckbookCheck>>
     *
     * @throws APIException
     */
    public function list(
        array|CheckbookCheckListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckbookCheckListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'checkbook_checks',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountNumberID' => 'account_number_id',
                    'checkNumber' => 'check_number',
                    'checkbookID' => 'checkbook_id',
                ],
            ),
            options: $options,
            convert: CheckbookCheck::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Stop a Checkbook Check. A stopped check cannot be deposited.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['checkbook_checks/%1$s/stop', $checkbookCheckID],
            options: $requestOptions,
            convert: CheckbookCheck::class,
        );
    }
}

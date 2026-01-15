<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\Programs\Program;
use Increase\Programs\ProgramListParams;
use Increase\RequestOptions;
use Increase\ServiceContracts\ProgramsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class ProgramsRawService implements ProgramsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Program
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['programs/%1$s', $programID],
            options: $requestOptions,
            convert: Program::class,
        );
    }

    /**
     * @api
     *
     * List Programs
     *
     * @param array{cursor?: string, limit?: int}|ProgramListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Program>>
     *
     * @throws APIException
     */
    public function list(
        array|ProgramListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProgramListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'programs',
            query: $parsed,
            options: $options,
            convert: Program::class,
            page: Page::class,
        );
    }
}

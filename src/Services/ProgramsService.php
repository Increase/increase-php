<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\Programs\Program;
use Increase\RequestOptions;
use Increase\ServiceContracts\ProgramsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class ProgramsService implements ProgramsContract
{
    /**
     * @api
     */
    public ProgramsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProgramsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Program
     *
     * @param string $programID the identifier of the Program to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $programID,
        RequestOptions|array|null $requestOptions = null
    ): Program {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($programID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Programs
     *
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<Program>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

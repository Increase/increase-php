<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Groups\Group;
use Increase\RequestOptions;
use Increase\ServiceContracts\GroupsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class GroupsService implements GroupsContract
{
    /**
     * @api
     */
    public GroupsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new GroupsRawService($client);
    }

    /**
     * @api
     *
     * Returns details for the currently authenticated Group.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): Group {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(requestOptions: $requestOptions);

        return $response->parse();
    }
}

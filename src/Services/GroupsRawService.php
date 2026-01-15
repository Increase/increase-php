<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Groups\Group;
use Increase\RequestOptions;
use Increase\ServiceContracts\GroupsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class GroupsRawService implements GroupsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns details for the currently authenticated Group.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Group>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'groups/current',
            options: $requestOptions,
            convert: Group::class,
        );
    }
}

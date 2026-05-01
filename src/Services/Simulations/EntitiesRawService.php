<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Entities\Entity;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\EntitiesRawContract;
use Increase\Simulations\Entities\EntityValidationParams;
use Increase\Simulations\Entities\EntityValidationParams\Issue;
use Increase\Simulations\Entities\EntityValidationParams\Status;

/**
 * @phpstan-import-type IssueShape from \Increase\Simulations\Entities\EntityValidationParams\Issue
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class EntitiesRawService implements EntitiesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates setting an [Entity](#entities)'s validation under the managed compliance regime. Any existing managed compliance validation on the Entity will be marked as no longer current.
     *
     * @param string $entityID the identifier of the Entity to set the validation on
     * @param array{
     *   issues: list<Issue|IssueShape>, status: Status|value-of<Status>
     * }|EntityValidationParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function validation(
        string $entityID,
        array|EntityValidationParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EntityValidationParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/entities/%1$s/validation', $entityID],
            body: (object) $parsed,
            options: $options,
            convert: Entity::class,
        );
    }
}

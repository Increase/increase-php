<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Entities\Entity;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\EntitiesRawContract;
use Increase\Simulations\Entities\EntityUpdateValidationParams;
use Increase\Simulations\Entities\EntityUpdateValidationParams\Issue;

/**
 * @phpstan-import-type IssueShape from \Increase\Simulations\Entities\EntityUpdateValidationParams\Issue
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
     * Simulate updates to an [Entity's validation](/documentation/api/entities#entity-object.validation). In production, Know Your Customer validations [run automatically](/documentation/entity-validation#entity-validation) for eligible programs. While developing, use this API to simulate issues with information submissions.
     *
     * @param string $entityID the identifier of the Entity whose validation status to update
     * @param array{
     *   issues: list<Issue|IssueShape>
     * }|EntityUpdateValidationParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function updateValidation(
        string $entityID,
        array|EntityUpdateValidationParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EntityUpdateValidationParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/entities/%1$s/update_validation', $entityID],
            body: (object) $parsed,
            options: $options,
            convert: Entity::class,
        );
    }
}

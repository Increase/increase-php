<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Entities\Entity;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\EntitiesContract;
use Increase\Simulations\Entities\EntityUpdateValidationParams\Issue;

/**
 * @phpstan-import-type IssueShape from \Increase\Simulations\Entities\EntityUpdateValidationParams\Issue
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class EntitiesService implements EntitiesContract
{
    /**
     * @api
     */
    public EntitiesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EntitiesRawService($client);
    }

    /**
     * @api
     *
     * Simulate updates to an [Entity's validation](/documentation/api/entities#entity-object.validation). In production, Know Your Customer validations [run automatically](/documentation/entity-validation#entity-validation) for eligible programs. While developing, use this API to simulate issues with information submissions.
     *
     * @param string $entityID the identifier of the Entity whose validation status to update
     * @param list<Issue|IssueShape> $issues The validation issues to attach. If no issues are provided, the validation status will be set to `valid`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateValidation(
        string $entityID,
        array $issues,
        RequestOptions|array|null $requestOptions = null,
    ): Entity {
        $params = Util::removeNulls(['issues' => $issues]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateValidation($entityID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Entities\Entity;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\EntitiesContract;
use Increase\Simulations\Entities\EntityValidationParams\Issue;
use Increase\Simulations\Entities\EntityValidationParams\Status;

/**
 * @phpstan-import-type IssueShape from \Increase\Simulations\Entities\EntityValidationParams\Issue
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
     * Set the status for an [Entity's validation](/documentation/api/entities#entity-object.validation). In production, Know Your Customer validations [run automatically](/documentation/entity-validation#entity-validation). While developing, it can be helpful to override the behavior in Sandbox.
     *
     * @param string $entityID the identifier of the Entity to set the validation on
     * @param list<Issue|IssueShape> $issues the issues to attach to the new managed compliance validation
     * @param Status|value-of<Status> $status the status to set on the new managed compliance validation
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function validation(
        string $entityID,
        array $issues,
        Status|string $status,
        RequestOptions|array|null $requestOptions = null,
    ): Entity {
        $params = Util::removeNulls(['issues' => $issues, 'status' => $status]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->validation($entityID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

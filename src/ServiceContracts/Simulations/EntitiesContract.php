<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\Entities\Entity;
use Increase\RequestOptions;
use Increase\Simulations\Entities\EntityValidationParams\Issue;
use Increase\Simulations\Entities\EntityValidationParams\Status;

/**
 * @phpstan-import-type IssueShape from \Increase\Simulations\Entities\EntityValidationParams\Issue
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface EntitiesContract
{
    /**
     * @api
     *
     * @param string $entityID the identifier of the Entity whose validation status to update
     * @param list<Issue|IssueShape> $issues The validation issues to attach. Only allowed when `status` is `invalid`.
     * @param Status|value-of<Status> $status the validation status to set on the Entity
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function validation(
        string $entityID,
        array $issues,
        Status|string $status,
        RequestOptions|array|null $requestOptions = null,
    ): Entity;
}

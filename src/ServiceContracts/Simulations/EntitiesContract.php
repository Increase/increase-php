<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\Entities\Entity;
use Increase\RequestOptions;
use Increase\Simulations\Entities\EntityUpdateValidationParams\Issue;

/**
 * @phpstan-import-type IssueShape from \Increase\Simulations\Entities\EntityUpdateValidationParams\Issue
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface EntitiesContract
{
    /**
     * @api
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
    ): Entity;
}

<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Entities\Entity;
use Increase\RequestOptions;
use Increase\Simulations\Entities\EntityUpdateValidationParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface EntitiesRawContract
{
    /**
     * @api
     *
     * @param string $entityID the identifier of the Entity whose validation status to update
     * @param array<string,mixed>|EntityUpdateValidationParams $params
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
    ): BaseResponse;
}

<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\BeneficialOwners\BeneficialOwnerListParams;
use Increase\BeneficialOwners\EntityBeneficialOwner;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface BeneficialOwnersRawContract
{
    /**
     * @api
     *
     * @param string $entityBeneficialOwnerID the identifier of the Beneficial Owner to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntityBeneficialOwner>
     *
     * @throws APIException
     */
    public function retrieve(
        string $entityBeneficialOwnerID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BeneficialOwnerListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<EntityBeneficialOwner>>
     *
     * @throws APIException
     */
    public function list(
        array|BeneficialOwnerListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

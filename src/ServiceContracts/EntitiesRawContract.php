<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Entities\Entity;
use Increase\Entities\EntityArchiveBeneficialOwnerParams;
use Increase\Entities\EntityConfirmParams;
use Increase\Entities\EntityCreateBeneficialOwnerParams;
use Increase\Entities\EntityCreateParams;
use Increase\Entities\EntityListParams;
use Increase\Entities\EntityUpdateAddressParams;
use Increase\Entities\EntityUpdateBeneficialOwnerAddressParams;
use Increase\Entities\EntityUpdateIndustryCodeParams;
use Increase\Entities\EntityUpdateParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface EntitiesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|EntityCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function create(
        array|EntityCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entityID the identifier of the Entity to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function retrieve(
        string $entityID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entityID the entity identifier
     * @param array<string,mixed>|EntityUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function update(
        string $entityID,
        array|EntityUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|EntityListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Entity>>
     *
     * @throws APIException
     */
    public function list(
        array|EntityListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entityID The identifier of the Entity to archive. Any accounts associated with an entity must be closed before the entity can be archived.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function archive(
        string $entityID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entityID the identifier of the Entity associated with the Beneficial Owner that is being archived
     * @param array<string,mixed>|EntityArchiveBeneficialOwnerParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function archiveBeneficialOwner(
        string $entityID,
        array|EntityArchiveBeneficialOwnerParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entityID the identifier of the Entity to confirm the details of
     * @param array<string,mixed>|EntityConfirmParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function confirm(
        string $entityID,
        array|EntityConfirmParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entityID the identifier of the Entity to associate with the new Beneficial Owner
     * @param array<string,mixed>|EntityCreateBeneficialOwnerParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function createBeneficialOwner(
        string $entityID,
        array|EntityCreateBeneficialOwnerParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entityID the identifier of the Entity whose address is being updated
     * @param array<string,mixed>|EntityUpdateAddressParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function updateAddress(
        string $entityID,
        array|EntityUpdateAddressParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entityID the identifier of the Entity associated with the Beneficial Owner whose address is being updated
     * @param array<string,mixed>|EntityUpdateBeneficialOwnerAddressParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function updateBeneficialOwnerAddress(
        string $entityID,
        array|EntityUpdateBeneficialOwnerAddressParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $entityID The identifier of the Entity to update. This endpoint only accepts `corporation` entities.
     * @param array<string,mixed>|EntityUpdateIndustryCodeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function updateIndustryCode(
        string $entityID,
        array|EntityUpdateIndustryCodeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

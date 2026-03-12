<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Entities\Entity;
use Increase\Entities\EntityCreateParams;
use Increase\Entities\EntityListParams;
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
}

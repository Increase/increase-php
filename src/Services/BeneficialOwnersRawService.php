<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\BeneficialOwners\BeneficialOwnerListParams;
use Increase\BeneficialOwners\BeneficialOwnerUpdateParams;
use Increase\BeneficialOwners\BeneficialOwnerUpdateParams\Address;
use Increase\BeneficialOwners\BeneficialOwnerUpdateParams\Identification;
use Increase\BeneficialOwners\EntityBeneficialOwner;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\BeneficialOwnersRawContract;

/**
 * @phpstan-import-type AddressShape from \Increase\BeneficialOwners\BeneficialOwnerUpdateParams\Address
 * @phpstan-import-type IdentificationShape from \Increase\BeneficialOwners\BeneficialOwnerUpdateParams\Identification
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class BeneficialOwnersRawService implements BeneficialOwnersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Beneficial Owner
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['entity_beneficial_owners/%1$s', $entityBeneficialOwnerID],
            options: $requestOptions,
            convert: EntityBeneficialOwner::class,
        );
    }

    /**
     * @api
     *
     * Update a Beneficial Owner
     *
     * @param string $entityBeneficialOwnerID the identifier of the Beneficial Owner to update
     * @param array{
     *   address?: Address|AddressShape,
     *   confirmedNoUsTaxID?: bool,
     *   identification?: Identification|IdentificationShape,
     *   name?: string,
     * }|BeneficialOwnerUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntityBeneficialOwner>
     *
     * @throws APIException
     */
    public function update(
        string $entityBeneficialOwnerID,
        array|BeneficialOwnerUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BeneficialOwnerUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['entity_beneficial_owners/%1$s', $entityBeneficialOwnerID],
            body: (object) $parsed,
            options: $options,
            convert: EntityBeneficialOwner::class,
        );
    }

    /**
     * @api
     *
     * List Beneficial Owners
     *
     * @param array{
     *   entityID: string, cursor?: string, idempotencyKey?: string, limit?: int
     * }|BeneficialOwnerListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<EntityBeneficialOwner>>
     *
     * @throws APIException
     */
    public function list(
        array|BeneficialOwnerListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BeneficialOwnerListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'entity_beneficial_owners',
            query: Util::array_transform_keys(
                $parsed,
                ['entityID' => 'entity_id', 'idempotencyKey' => 'idempotency_key'],
            ),
            options: $options,
            convert: EntityBeneficialOwner::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Archive a Beneficial Owner
     *
     * @param string $entityBeneficialOwnerID the identifier of the Beneficial Owner to archive
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntityBeneficialOwner>
     *
     * @throws APIException
     */
    public function archive(
        string $entityBeneficialOwnerID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['entity_beneficial_owners/%1$s/archive', $entityBeneficialOwnerID],
            options: $requestOptions,
            convert: EntityBeneficialOwner::class,
        );
    }
}

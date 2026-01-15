<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Entities\Entity;
use Increase\Entities\EntityArchiveBeneficialOwnerParams;
use Increase\Entities\EntityConfirmParams;
use Increase\Entities\EntityCreateBeneficialOwnerParams;
use Increase\Entities\EntityCreateBeneficialOwnerParams\BeneficialOwner;
use Increase\Entities\EntityCreateParams;
use Increase\Entities\EntityCreateParams\Corporation;
use Increase\Entities\EntityCreateParams\GovernmentAuthority;
use Increase\Entities\EntityCreateParams\Joint;
use Increase\Entities\EntityCreateParams\NaturalPerson;
use Increase\Entities\EntityCreateParams\RiskRating;
use Increase\Entities\EntityCreateParams\Structure;
use Increase\Entities\EntityCreateParams\SupplementalDocument;
use Increase\Entities\EntityCreateParams\TermsAgreement;
use Increase\Entities\EntityCreateParams\ThirdPartyVerification;
use Increase\Entities\EntityCreateParams\Trust;
use Increase\Entities\EntityListParams;
use Increase\Entities\EntityListParams\CreatedAt;
use Increase\Entities\EntityListParams\Status;
use Increase\Entities\EntityUpdateAddressParams;
use Increase\Entities\EntityUpdateAddressParams\Address;
use Increase\Entities\EntityUpdateBeneficialOwnerAddressParams;
use Increase\Entities\EntityUpdateIndustryCodeParams;
use Increase\Entities\EntityUpdateParams;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\EntitiesRawContract;

/**
 * @phpstan-import-type CorporationShape from \Increase\Entities\EntityCreateParams\Corporation
 * @phpstan-import-type GovernmentAuthorityShape from \Increase\Entities\EntityCreateParams\GovernmentAuthority
 * @phpstan-import-type JointShape from \Increase\Entities\EntityCreateParams\Joint
 * @phpstan-import-type NaturalPersonShape from \Increase\Entities\EntityCreateParams\NaturalPerson
 * @phpstan-import-type RiskRatingShape from \Increase\Entities\EntityCreateParams\RiskRating
 * @phpstan-import-type SupplementalDocumentShape from \Increase\Entities\EntityCreateParams\SupplementalDocument
 * @phpstan-import-type TermsAgreementShape from \Increase\Entities\EntityCreateParams\TermsAgreement
 * @phpstan-import-type ThirdPartyVerificationShape from \Increase\Entities\EntityCreateParams\ThirdPartyVerification
 * @phpstan-import-type TrustShape from \Increase\Entities\EntityCreateParams\Trust
 * @phpstan-import-type CorporationShape from \Increase\Entities\EntityUpdateParams\Corporation as CorporationShape1
 * @phpstan-import-type GovernmentAuthorityShape from \Increase\Entities\EntityUpdateParams\GovernmentAuthority as GovernmentAuthorityShape1
 * @phpstan-import-type NaturalPersonShape from \Increase\Entities\EntityUpdateParams\NaturalPerson as NaturalPersonShape1
 * @phpstan-import-type RiskRatingShape from \Increase\Entities\EntityUpdateParams\RiskRating as RiskRatingShape1
 * @phpstan-import-type ThirdPartyVerificationShape from \Increase\Entities\EntityUpdateParams\ThirdPartyVerification as ThirdPartyVerificationShape1
 * @phpstan-import-type TrustShape from \Increase\Entities\EntityUpdateParams\Trust as TrustShape1
 * @phpstan-import-type CreatedAtShape from \Increase\Entities\EntityListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\Entities\EntityListParams\Status
 * @phpstan-import-type BeneficialOwnerShape from \Increase\Entities\EntityCreateBeneficialOwnerParams\BeneficialOwner
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityUpdateAddressParams\Address
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityUpdateBeneficialOwnerAddressParams\Address as AddressShape1
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
     * Create an Entity
     *
     * @param array{
     *   structure: Structure|value-of<Structure>,
     *   corporation?: Corporation|CorporationShape,
     *   description?: string,
     *   governmentAuthority?: GovernmentAuthority|GovernmentAuthorityShape,
     *   joint?: Joint|JointShape,
     *   naturalPerson?: NaturalPerson|NaturalPersonShape,
     *   riskRating?: RiskRating|RiskRatingShape,
     *   supplementalDocuments?: list<SupplementalDocument|SupplementalDocumentShape>,
     *   termsAgreements?: list<TermsAgreement|TermsAgreementShape>,
     *   thirdPartyVerification?: ThirdPartyVerification|ThirdPartyVerificationShape,
     *   trust?: Trust|TrustShape,
     * }|EntityCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Entity>
     *
     * @throws APIException
     */
    public function create(
        array|EntityCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EntityCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'entities',
            body: (object) $parsed,
            options: $options,
            convert: Entity::class,
        );
    }

    /**
     * @api
     *
     * Retrieve an Entity
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['entities/%1$s', $entityID],
            options: $requestOptions,
            convert: Entity::class,
        );
    }

    /**
     * @api
     *
     * Update an Entity
     *
     * @param string $entityID the entity identifier
     * @param array{
     *   corporation?: EntityUpdateParams\Corporation|CorporationShape1,
     *   detailsConfirmedAt?: \DateTimeInterface,
     *   governmentAuthority?: EntityUpdateParams\GovernmentAuthority|GovernmentAuthorityShape1,
     *   naturalPerson?: EntityUpdateParams\NaturalPerson|NaturalPersonShape1,
     *   riskRating?: EntityUpdateParams\RiskRating|RiskRatingShape1,
     *   thirdPartyVerification?: EntityUpdateParams\ThirdPartyVerification|ThirdPartyVerificationShape1,
     *   trust?: EntityUpdateParams\Trust|TrustShape1,
     * }|EntityUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = EntityUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['entities/%1$s', $entityID],
            body: (object) $parsed,
            options: $options,
            convert: Entity::class,
        );
    }

    /**
     * @api
     *
     * List Entities
     *
     * @param array{
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|EntityListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Entity>>
     *
     * @throws APIException
     */
    public function list(
        array|EntityListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EntityListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'entities',
            query: Util::array_transform_keys(
                $parsed,
                ['createdAt' => 'created_at', 'idempotencyKey' => 'idempotency_key'],
            ),
            options: $options,
            convert: Entity::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Archive an Entity
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['entities/%1$s/archive', $entityID],
            options: $requestOptions,
            convert: Entity::class,
        );
    }

    /**
     * @api
     *
     * Archive a beneficial owner for a corporate Entity
     *
     * @param string $entityID the identifier of the Entity associated with the Beneficial Owner that is being archived
     * @param array{
     *   beneficialOwnerID: string
     * }|EntityArchiveBeneficialOwnerParams $params
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
    ): BaseResponse {
        [$parsed, $options] = EntityArchiveBeneficialOwnerParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['entities/%1$s/archive_beneficial_owner', $entityID],
            body: (object) $parsed,
            options: $options,
            convert: Entity::class,
        );
    }

    /**
     * @api
     *
     * Depending on your program, you may be required to re-confirm an Entity's details on a recurring basis. After making any required updates, call this endpoint to record that your user confirmed their details.
     *
     * @param string $entityID the identifier of the Entity to confirm the details of
     * @param array{confirmedAt?: \DateTimeInterface}|EntityConfirmParams $params
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
    ): BaseResponse {
        [$parsed, $options] = EntityConfirmParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['entities/%1$s/confirm', $entityID],
            body: (object) $parsed,
            options: $options,
            convert: Entity::class,
        );
    }

    /**
     * @api
     *
     * Create a beneficial owner for a corporate Entity
     *
     * @param string $entityID the identifier of the Entity to associate with the new Beneficial Owner
     * @param array{
     *   beneficialOwner: BeneficialOwner|BeneficialOwnerShape
     * }|EntityCreateBeneficialOwnerParams $params
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
    ): BaseResponse {
        [$parsed, $options] = EntityCreateBeneficialOwnerParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['entities/%1$s/create_beneficial_owner', $entityID],
            body: (object) $parsed,
            options: $options,
            convert: Entity::class,
        );
    }

    /**
     * @api
     *
     * Update a Natural Person or Corporation's address
     *
     * @param string $entityID the identifier of the Entity whose address is being updated
     * @param array{address: Address|AddressShape}|EntityUpdateAddressParams $params
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
    ): BaseResponse {
        [$parsed, $options] = EntityUpdateAddressParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['entities/%1$s/update_address', $entityID],
            body: (object) $parsed,
            options: $options,
            convert: Entity::class,
        );
    }

    /**
     * @api
     *
     * Update the address for a beneficial owner belonging to a corporate Entity
     *
     * @param string $entityID the identifier of the Entity associated with the Beneficial Owner whose address is being updated
     * @param array{
     *   address: EntityUpdateBeneficialOwnerAddressParams\Address|AddressShape1,
     *   beneficialOwnerID: string,
     * }|EntityUpdateBeneficialOwnerAddressParams $params
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
    ): BaseResponse {
        [$parsed, $options] = EntityUpdateBeneficialOwnerAddressParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['entities/%1$s/update_beneficial_owner_address', $entityID],
            body: (object) $parsed,
            options: $options,
            convert: Entity::class,
        );
    }

    /**
     * @api
     *
     * Update the industry code for a corporate Entity
     *
     * @param string $entityID The identifier of the Entity to update. This endpoint only accepts `corporation` entities.
     * @param array{industryCode: string}|EntityUpdateIndustryCodeParams $params
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
    ): BaseResponse {
        [$parsed, $options] = EntityUpdateIndustryCodeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['entities/%1$s/update_industry_code', $entityID],
            body: (object) $parsed,
            options: $options,
            convert: Entity::class,
        );
    }
}

<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Entities\Entity;
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
}

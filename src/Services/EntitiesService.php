<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Entities\Entity;
use Increase\Entities\EntityCreateBeneficialOwnerParams\BeneficialOwner;
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
use Increase\Entities\EntityListParams\CreatedAt;
use Increase\Entities\EntityListParams\Status;
use Increase\Entities\EntityUpdateAddressParams\Address;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\EntitiesContract;

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
     * Create an Entity
     *
     * @param Structure|value-of<Structure> $structure the type of Entity to create
     * @param Corporation|CorporationShape $corporation Details of the corporation entity to create. Required if `structure` is equal to `corporation`.
     * @param string $description the description you choose to give the entity
     * @param GovernmentAuthority|GovernmentAuthorityShape $governmentAuthority Details of the Government Authority entity to create. Required if `structure` is equal to `government_authority`.
     * @param Joint|JointShape $joint Details of the joint entity to create. Required if `structure` is equal to `joint`.
     * @param NaturalPerson|NaturalPersonShape $naturalPerson Details of the natural person entity to create. Required if `structure` is equal to `natural_person`. Natural people entities should be submitted with `social_security_number` or `individual_taxpayer_identification_number` identification methods.
     * @param RiskRating|RiskRatingShape $riskRating an assessment of the entity’s potential risk of involvement in financial crimes, such as money laundering
     * @param list<SupplementalDocument|SupplementalDocumentShape> $supplementalDocuments additional documentation associated with the entity
     * @param list<TermsAgreement|TermsAgreementShape> $termsAgreements The terms that the Entity agreed to. Not all programs are required to submit this data.
     * @param ThirdPartyVerification|ThirdPartyVerificationShape $thirdPartyVerification if you are using a third-party service for identity verification, you can use this field to associate this Entity with the identifier that represents them in that service
     * @param Trust|TrustShape $trust Details of the trust entity to create. Required if `structure` is equal to `trust`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Structure|string $structure,
        Corporation|array|null $corporation = null,
        ?string $description = null,
        GovernmentAuthority|array|null $governmentAuthority = null,
        Joint|array|null $joint = null,
        NaturalPerson|array|null $naturalPerson = null,
        RiskRating|array|null $riskRating = null,
        ?array $supplementalDocuments = null,
        ?array $termsAgreements = null,
        ThirdPartyVerification|array|null $thirdPartyVerification = null,
        Trust|array|null $trust = null,
        RequestOptions|array|null $requestOptions = null,
    ): Entity {
        $params = Util::removeNulls(
            [
                'structure' => $structure,
                'corporation' => $corporation,
                'description' => $description,
                'governmentAuthority' => $governmentAuthority,
                'joint' => $joint,
                'naturalPerson' => $naturalPerson,
                'riskRating' => $riskRating,
                'supplementalDocuments' => $supplementalDocuments,
                'termsAgreements' => $termsAgreements,
                'thirdPartyVerification' => $thirdPartyVerification,
                'trust' => $trust,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve an Entity
     *
     * @param string $entityID the identifier of the Entity to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $entityID,
        RequestOptions|array|null $requestOptions = null
    ): Entity {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($entityID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update an Entity
     *
     * @param string $entityID the entity identifier
     * @param \Increase\Entities\EntityUpdateParams\Corporation|CorporationShape1 $corporation Details of the corporation entity to update. If you specify this parameter and the entity is not a corporation, the request will fail.
     * @param \DateTimeInterface $detailsConfirmedAt When your user last confirmed the Entity's details. Depending on your program, you may be required to affirmatively confirm details with your users on an annual basis.
     * @param \Increase\Entities\EntityUpdateParams\GovernmentAuthority|GovernmentAuthorityShape1 $governmentAuthority Details of the government authority entity to update. If you specify this parameter and the entity is not a government authority, the request will fail.
     * @param \Increase\Entities\EntityUpdateParams\NaturalPerson|NaturalPersonShape1 $naturalPerson Details of the natural person entity to update. If you specify this parameter and the entity is not a natural person, the request will fail.
     * @param \Increase\Entities\EntityUpdateParams\RiskRating|RiskRatingShape1 $riskRating an assessment of the entity’s potential risk of involvement in financial crimes, such as money laundering
     * @param \Increase\Entities\EntityUpdateParams\ThirdPartyVerification|ThirdPartyVerificationShape1 $thirdPartyVerification if you are using a third-party service for identity verification, you can use this field to associate this Entity with the identifier that represents them in that service
     * @param \Increase\Entities\EntityUpdateParams\Trust|TrustShape1 $trust Details of the trust entity to update. If you specify this parameter and the entity is not a trust, the request will fail.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $entityID,
        \Increase\Entities\EntityUpdateParams\Corporation|array|null $corporation = null,
        ?\DateTimeInterface $detailsConfirmedAt = null,
        \Increase\Entities\EntityUpdateParams\GovernmentAuthority|array|null $governmentAuthority = null,
        \Increase\Entities\EntityUpdateParams\NaturalPerson|array|null $naturalPerson = null,
        \Increase\Entities\EntityUpdateParams\RiskRating|array|null $riskRating = null,
        \Increase\Entities\EntityUpdateParams\ThirdPartyVerification|array|null $thirdPartyVerification = null,
        \Increase\Entities\EntityUpdateParams\Trust|array|null $trust = null,
        RequestOptions|array|null $requestOptions = null,
    ): Entity {
        $params = Util::removeNulls(
            [
                'corporation' => $corporation,
                'detailsConfirmedAt' => $detailsConfirmedAt,
                'governmentAuthority' => $governmentAuthority,
                'naturalPerson' => $naturalPerson,
                'riskRating' => $riskRating,
                'thirdPartyVerification' => $thirdPartyVerification,
                'trust' => $trust,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($entityID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Entities
     *
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<Entity>
     *
     * @throws APIException
     */
    public function list(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive an Entity
     *
     * @param string $entityID The identifier of the Entity to archive. Any accounts associated with an entity must be closed before the entity can be archived.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $entityID,
        RequestOptions|array|null $requestOptions = null
    ): Entity {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($entityID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive a beneficial owner for a corporate Entity
     *
     * @param string $entityID the identifier of the Entity associated with the Beneficial Owner that is being archived
     * @param string $beneficialOwnerID the identifying details of anyone controlling or owning 25% or more of the corporation
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archiveBeneficialOwner(
        string $entityID,
        string $beneficialOwnerID,
        RequestOptions|array|null $requestOptions = null,
    ): Entity {
        $params = Util::removeNulls(['beneficialOwnerID' => $beneficialOwnerID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archiveBeneficialOwner($entityID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Depending on your program, you may be required to re-confirm an Entity's details on a recurring basis. After making any required updates, call this endpoint to record that your user confirmed their details.
     *
     * @param string $entityID the identifier of the Entity to confirm the details of
     * @param \DateTimeInterface $confirmedAt When your user confirmed the Entity's details. If not provided, the current time will be used.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function confirm(
        string $entityID,
        ?\DateTimeInterface $confirmedAt = null,
        RequestOptions|array|null $requestOptions = null,
    ): Entity {
        $params = Util::removeNulls(['confirmedAt' => $confirmedAt]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->confirm($entityID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a beneficial owner for a corporate Entity
     *
     * @param string $entityID the identifier of the Entity to associate with the new Beneficial Owner
     * @param BeneficialOwner|BeneficialOwnerShape $beneficialOwner the identifying details of anyone controlling or owning 25% or more of the corporation
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createBeneficialOwner(
        string $entityID,
        BeneficialOwner|array $beneficialOwner,
        RequestOptions|array|null $requestOptions = null,
    ): Entity {
        $params = Util::removeNulls(['beneficialOwner' => $beneficialOwner]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createBeneficialOwner($entityID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a Natural Person or Corporation's address
     *
     * @param string $entityID the identifier of the Entity whose address is being updated
     * @param Address|AddressShape $address The entity's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateAddress(
        string $entityID,
        Address|array $address,
        RequestOptions|array|null $requestOptions = null,
    ): Entity {
        $params = Util::removeNulls(['address' => $address]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateAddress($entityID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update the address for a beneficial owner belonging to a corporate Entity
     *
     * @param string $entityID the identifier of the Entity associated with the Beneficial Owner whose address is being updated
     * @param \Increase\Entities\EntityUpdateBeneficialOwnerAddressParams\Address|AddressShape1 $address The individual's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     * @param string $beneficialOwnerID the identifying details of anyone controlling or owning 25% or more of the corporation
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateBeneficialOwnerAddress(
        string $entityID,
        \Increase\Entities\EntityUpdateBeneficialOwnerAddressParams\Address|array $address,
        string $beneficialOwnerID,
        RequestOptions|array|null $requestOptions = null,
    ): Entity {
        $params = Util::removeNulls(
            ['address' => $address, 'beneficialOwnerID' => $beneficialOwnerID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateBeneficialOwnerAddress($entityID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update the industry code for a corporate Entity
     *
     * @param string $entityID The identifier of the Entity to update. This endpoint only accepts `corporation` entities.
     * @param string $industryCode The North American Industry Classification System (NAICS) code for the corporation's primary line of business. This is a number, like `5132` for `Software Publishers`. A full list of classification codes is available [here](https://increase.com/documentation/data-dictionary#north-american-industry-classification-system-codes).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateIndustryCode(
        string $entityID,
        string $industryCode,
        RequestOptions|array|null $requestOptions = null,
    ): Entity {
        $params = Util::removeNulls(['industryCode' => $industryCode]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateIndustryCode($entityID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

<?php

declare(strict_types=1);

namespace Increase\Entities;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Corporation;
use Increase\Entities\Entity\GovernmentAuthority;
use Increase\Entities\Entity\Joint;
use Increase\Entities\Entity\NaturalPerson;
use Increase\Entities\Entity\RiskRating;
use Increase\Entities\Entity\Status;
use Increase\Entities\Entity\Structure;
use Increase\Entities\Entity\TermsAgreement;
use Increase\Entities\Entity\ThirdPartyVerification;
use Increase\Entities\Entity\Trust;
use Increase\Entities\Entity\Type;
use Increase\Entities\Entity\Validation;
use Increase\SupplementalDocuments\EntitySupplementalDocument;

/**
 * Entities are the legal entities that own accounts. They can be people, corporations, partnerships, government authorities, or trusts. To learn more, see [Entities](/documentation/entities).
 *
 * @phpstan-import-type CorporationShape from \Increase\Entities\Entity\Corporation
 * @phpstan-import-type GovernmentAuthorityShape from \Increase\Entities\Entity\GovernmentAuthority
 * @phpstan-import-type JointShape from \Increase\Entities\Entity\Joint
 * @phpstan-import-type NaturalPersonShape from \Increase\Entities\Entity\NaturalPerson
 * @phpstan-import-type RiskRatingShape from \Increase\Entities\Entity\RiskRating
 * @phpstan-import-type EntitySupplementalDocumentShape from \Increase\SupplementalDocuments\EntitySupplementalDocument
 * @phpstan-import-type TermsAgreementShape from \Increase\Entities\Entity\TermsAgreement
 * @phpstan-import-type ThirdPartyVerificationShape from \Increase\Entities\Entity\ThirdPartyVerification
 * @phpstan-import-type TrustShape from \Increase\Entities\Entity\Trust
 * @phpstan-import-type ValidationShape from \Increase\Entities\Entity\Validation
 *
 * @phpstan-type EntityShape = array{
 *   id: string,
 *   corporation: null|Corporation|CorporationShape,
 *   createdAt: \DateTimeInterface,
 *   creatingEntityOnboardingSessionID: string|null,
 *   description: string|null,
 *   detailsConfirmedAt: \DateTimeInterface|null,
 *   governmentAuthority: null|GovernmentAuthority|GovernmentAuthorityShape,
 *   idempotencyKey: string|null,
 *   joint: null|Joint|JointShape,
 *   naturalPerson: null|NaturalPerson|NaturalPersonShape,
 *   riskRating: null|RiskRating|RiskRatingShape,
 *   status: Status|value-of<Status>,
 *   structure: Structure|value-of<Structure>,
 *   supplementalDocuments: list<EntitySupplementalDocument|EntitySupplementalDocumentShape>,
 *   termsAgreements: list<TermsAgreement|TermsAgreementShape>,
 *   thirdPartyVerification: null|ThirdPartyVerification|ThirdPartyVerificationShape,
 *   trust: null|Trust|TrustShape,
 *   type: Type|value-of<Type>,
 *   validation: null|Validation|ValidationShape,
 * }
 */
final class Entity implements BaseModel
{
    /** @use SdkModel<EntityShape> */
    use SdkModel;

    /**
     * The entity's identifier.
     */
    #[Required]
    public string $id;

    /**
     * Details of the corporation entity. Will be present if `structure` is equal to `corporation`.
     */
    #[Required]
    public ?Corporation $corporation;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Entity was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The identifier of the Entity Onboarding Session that was used to create this Entity, if any.
     */
    #[Required('creating_entity_onboarding_session_id')]
    public ?string $creatingEntityOnboardingSessionID;

    /**
     * The entity's description for display purposes.
     */
    #[Required]
    public ?string $description;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Entity's details were most recently confirmed.
     */
    #[Required('details_confirmed_at')]
    public ?\DateTimeInterface $detailsConfirmedAt;

    /**
     * Details of the government authority entity. Will be present if `structure` is equal to `government_authority`.
     */
    #[Required('government_authority')]
    public ?GovernmentAuthority $governmentAuthority;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * Details of the joint entity. Will be present if `structure` is equal to `joint`.
     */
    #[Required]
    public ?Joint $joint;

    /**
     * Details of the natural person entity. Will be present if `structure` is equal to `natural_person`.
     */
    #[Required('natural_person')]
    public ?NaturalPerson $naturalPerson;

    /**
     * An assessment of the entity’s potential risk of involvement in financial crimes, such as money laundering.
     */
    #[Required('risk_rating')]
    public ?RiskRating $riskRating;

    /**
     * The status of the entity.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The entity's legal structure.
     *
     * @var value-of<Structure> $structure
     */
    #[Required(enum: Structure::class)]
    public string $structure;

    /**
     * Additional documentation associated with the entity. This is limited to the first 10 documents for an entity. If an entity has more than 10 documents, use the GET /entity_supplemental_documents list endpoint to retrieve them.
     *
     * @var list<EntitySupplementalDocument> $supplementalDocuments
     */
    #[Required('supplemental_documents', list: EntitySupplementalDocument::class)]
    public array $supplementalDocuments;

    /**
     * The terms that the Entity agreed to. Not all programs are required to submit this data.
     *
     * @var list<TermsAgreement> $termsAgreements
     */
    #[Required('terms_agreements', list: TermsAgreement::class)]
    public array $termsAgreements;

    /**
     * If you are using a third-party service for identity verification, you can use this field to associate this Entity with the identifier that represents them in that service.
     */
    #[Required('third_party_verification')]
    public ?ThirdPartyVerification $thirdPartyVerification;

    /**
     * Details of the trust entity. Will be present if `structure` is equal to `trust`.
     */
    #[Required]
    public ?Trust $trust;

    /**
     * A constant representing the object's type. For this resource it will always be `entity`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The validation results for the entity. Learn more about [validations](/documentation/entity-validation).
     */
    #[Required]
    public ?Validation $validation;

    /**
     * `new Entity()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Entity::with(
     *   id: ...,
     *   corporation: ...,
     *   createdAt: ...,
     *   creatingEntityOnboardingSessionID: ...,
     *   description: ...,
     *   detailsConfirmedAt: ...,
     *   governmentAuthority: ...,
     *   idempotencyKey: ...,
     *   joint: ...,
     *   naturalPerson: ...,
     *   riskRating: ...,
     *   status: ...,
     *   structure: ...,
     *   supplementalDocuments: ...,
     *   termsAgreements: ...,
     *   thirdPartyVerification: ...,
     *   trust: ...,
     *   type: ...,
     *   validation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Entity)
     *   ->withID(...)
     *   ->withCorporation(...)
     *   ->withCreatedAt(...)
     *   ->withCreatingEntityOnboardingSessionID(...)
     *   ->withDescription(...)
     *   ->withDetailsConfirmedAt(...)
     *   ->withGovernmentAuthority(...)
     *   ->withIdempotencyKey(...)
     *   ->withJoint(...)
     *   ->withNaturalPerson(...)
     *   ->withRiskRating(...)
     *   ->withStatus(...)
     *   ->withStructure(...)
     *   ->withSupplementalDocuments(...)
     *   ->withTermsAgreements(...)
     *   ->withThirdPartyVerification(...)
     *   ->withTrust(...)
     *   ->withType(...)
     *   ->withValidation(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Corporation|CorporationShape|null $corporation
     * @param GovernmentAuthority|GovernmentAuthorityShape|null $governmentAuthority
     * @param Joint|JointShape|null $joint
     * @param NaturalPerson|NaturalPersonShape|null $naturalPerson
     * @param RiskRating|RiskRatingShape|null $riskRating
     * @param Status|value-of<Status> $status
     * @param Structure|value-of<Structure> $structure
     * @param list<EntitySupplementalDocument|EntitySupplementalDocumentShape> $supplementalDocuments
     * @param list<TermsAgreement|TermsAgreementShape> $termsAgreements
     * @param ThirdPartyVerification|ThirdPartyVerificationShape|null $thirdPartyVerification
     * @param Trust|TrustShape|null $trust
     * @param Type|value-of<Type> $type
     * @param Validation|ValidationShape|null $validation
     */
    public static function with(
        string $id,
        Corporation|array|null $corporation,
        \DateTimeInterface $createdAt,
        ?string $creatingEntityOnboardingSessionID,
        ?string $description,
        ?\DateTimeInterface $detailsConfirmedAt,
        GovernmentAuthority|array|null $governmentAuthority,
        ?string $idempotencyKey,
        Joint|array|null $joint,
        NaturalPerson|array|null $naturalPerson,
        RiskRating|array|null $riskRating,
        Status|string $status,
        Structure|string $structure,
        array $supplementalDocuments,
        array $termsAgreements,
        ThirdPartyVerification|array|null $thirdPartyVerification,
        Trust|array|null $trust,
        Type|string $type,
        Validation|array|null $validation,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['corporation'] = $corporation;
        $self['createdAt'] = $createdAt;
        $self['creatingEntityOnboardingSessionID'] = $creatingEntityOnboardingSessionID;
        $self['description'] = $description;
        $self['detailsConfirmedAt'] = $detailsConfirmedAt;
        $self['governmentAuthority'] = $governmentAuthority;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['joint'] = $joint;
        $self['naturalPerson'] = $naturalPerson;
        $self['riskRating'] = $riskRating;
        $self['status'] = $status;
        $self['structure'] = $structure;
        $self['supplementalDocuments'] = $supplementalDocuments;
        $self['termsAgreements'] = $termsAgreements;
        $self['thirdPartyVerification'] = $thirdPartyVerification;
        $self['trust'] = $trust;
        $self['type'] = $type;
        $self['validation'] = $validation;

        return $self;
    }

    /**
     * The entity's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Details of the corporation entity. Will be present if `structure` is equal to `corporation`.
     *
     * @param Corporation|CorporationShape|null $corporation
     */
    public function withCorporation(Corporation|array|null $corporation): self
    {
        $self = clone $this;
        $self['corporation'] = $corporation;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Entity was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The identifier of the Entity Onboarding Session that was used to create this Entity, if any.
     */
    public function withCreatingEntityOnboardingSessionID(
        ?string $creatingEntityOnboardingSessionID
    ): self {
        $self = clone $this;
        $self['creatingEntityOnboardingSessionID'] = $creatingEntityOnboardingSessionID;

        return $self;
    }

    /**
     * The entity's description for display purposes.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Entity's details were most recently confirmed.
     */
    public function withDetailsConfirmedAt(
        ?\DateTimeInterface $detailsConfirmedAt
    ): self {
        $self = clone $this;
        $self['detailsConfirmedAt'] = $detailsConfirmedAt;

        return $self;
    }

    /**
     * Details of the government authority entity. Will be present if `structure` is equal to `government_authority`.
     *
     * @param GovernmentAuthority|GovernmentAuthorityShape|null $governmentAuthority
     */
    public function withGovernmentAuthority(
        GovernmentAuthority|array|null $governmentAuthority
    ): self {
        $self = clone $this;
        $self['governmentAuthority'] = $governmentAuthority;

        return $self;
    }

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * Details of the joint entity. Will be present if `structure` is equal to `joint`.
     *
     * @param Joint|JointShape|null $joint
     */
    public function withJoint(Joint|array|null $joint): self
    {
        $self = clone $this;
        $self['joint'] = $joint;

        return $self;
    }

    /**
     * Details of the natural person entity. Will be present if `structure` is equal to `natural_person`.
     *
     * @param NaturalPerson|NaturalPersonShape|null $naturalPerson
     */
    public function withNaturalPerson(
        NaturalPerson|array|null $naturalPerson
    ): self {
        $self = clone $this;
        $self['naturalPerson'] = $naturalPerson;

        return $self;
    }

    /**
     * An assessment of the entity’s potential risk of involvement in financial crimes, such as money laundering.
     *
     * @param RiskRating|RiskRatingShape|null $riskRating
     */
    public function withRiskRating(RiskRating|array|null $riskRating): self
    {
        $self = clone $this;
        $self['riskRating'] = $riskRating;

        return $self;
    }

    /**
     * The status of the entity.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The entity's legal structure.
     *
     * @param Structure|value-of<Structure> $structure
     */
    public function withStructure(Structure|string $structure): self
    {
        $self = clone $this;
        $self['structure'] = $structure;

        return $self;
    }

    /**
     * Additional documentation associated with the entity. This is limited to the first 10 documents for an entity. If an entity has more than 10 documents, use the GET /entity_supplemental_documents list endpoint to retrieve them.
     *
     * @param list<EntitySupplementalDocument|EntitySupplementalDocumentShape> $supplementalDocuments
     */
    public function withSupplementalDocuments(
        array $supplementalDocuments
    ): self {
        $self = clone $this;
        $self['supplementalDocuments'] = $supplementalDocuments;

        return $self;
    }

    /**
     * The terms that the Entity agreed to. Not all programs are required to submit this data.
     *
     * @param list<TermsAgreement|TermsAgreementShape> $termsAgreements
     */
    public function withTermsAgreements(array $termsAgreements): self
    {
        $self = clone $this;
        $self['termsAgreements'] = $termsAgreements;

        return $self;
    }

    /**
     * If you are using a third-party service for identity verification, you can use this field to associate this Entity with the identifier that represents them in that service.
     *
     * @param ThirdPartyVerification|ThirdPartyVerificationShape|null $thirdPartyVerification
     */
    public function withThirdPartyVerification(
        ThirdPartyVerification|array|null $thirdPartyVerification
    ): self {
        $self = clone $this;
        $self['thirdPartyVerification'] = $thirdPartyVerification;

        return $self;
    }

    /**
     * Details of the trust entity. Will be present if `structure` is equal to `trust`.
     *
     * @param Trust|TrustShape|null $trust
     */
    public function withTrust(Trust|array|null $trust): self
    {
        $self = clone $this;
        $self['trust'] = $trust;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `entity`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The validation results for the entity. Learn more about [validations](/documentation/entity-validation).
     *
     * @param Validation|ValidationShape|null $validation
     */
    public function withValidation(Validation|array|null $validation): self
    {
        $self = clone $this;
        $self['validation'] = $validation;

        return $self;
    }
}

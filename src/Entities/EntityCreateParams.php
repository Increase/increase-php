<?php

declare(strict_types=1);

namespace Increase\Entities;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
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

/**
 * Create an Entity.
 *
 * @see Increase\Services\EntitiesService::create()
 *
 * @phpstan-import-type CorporationShape from \Increase\Entities\EntityCreateParams\Corporation
 * @phpstan-import-type GovernmentAuthorityShape from \Increase\Entities\EntityCreateParams\GovernmentAuthority
 * @phpstan-import-type JointShape from \Increase\Entities\EntityCreateParams\Joint
 * @phpstan-import-type NaturalPersonShape from \Increase\Entities\EntityCreateParams\NaturalPerson
 * @phpstan-import-type RiskRatingShape from \Increase\Entities\EntityCreateParams\RiskRating
 * @phpstan-import-type SupplementalDocumentShape from \Increase\Entities\EntityCreateParams\SupplementalDocument
 * @phpstan-import-type TermsAgreementShape from \Increase\Entities\EntityCreateParams\TermsAgreement
 * @phpstan-import-type ThirdPartyVerificationShape from \Increase\Entities\EntityCreateParams\ThirdPartyVerification
 * @phpstan-import-type TrustShape from \Increase\Entities\EntityCreateParams\Trust
 *
 * @phpstan-type EntityCreateParamsShape = array{
 *   structure: Structure|value-of<Structure>,
 *   corporation?: null|Corporation|CorporationShape,
 *   description?: string|null,
 *   governmentAuthority?: null|GovernmentAuthority|GovernmentAuthorityShape,
 *   joint?: null|Joint|JointShape,
 *   naturalPerson?: null|NaturalPerson|NaturalPersonShape,
 *   riskRating?: null|RiskRating|RiskRatingShape,
 *   supplementalDocuments?: list<SupplementalDocument|SupplementalDocumentShape>|null,
 *   termsAgreements?: list<TermsAgreement|TermsAgreementShape>|null,
 *   thirdPartyVerification?: null|ThirdPartyVerification|ThirdPartyVerificationShape,
 *   trust?: null|Trust|TrustShape,
 * }
 */
final class EntityCreateParams implements BaseModel
{
    /** @use SdkModel<EntityCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The type of Entity to create.
     *
     * @var value-of<Structure> $structure
     */
    #[Required(enum: Structure::class)]
    public string $structure;

    /**
     * Details of the corporation entity to create. Required if `structure` is equal to `corporation`.
     */
    #[Optional]
    public ?Corporation $corporation;

    /**
     * The description you choose to give the entity.
     */
    #[Optional]
    public ?string $description;

    /**
     * Details of the Government Authority entity to create. Required if `structure` is equal to `government_authority`.
     */
    #[Optional('government_authority')]
    public ?GovernmentAuthority $governmentAuthority;

    /**
     * Details of the joint entity to create. Required if `structure` is equal to `joint`.
     */
    #[Optional]
    public ?Joint $joint;

    /**
     * Details of the natural person entity to create. Required if `structure` is equal to `natural_person`. Natural people entities should be submitted with `social_security_number` or `individual_taxpayer_identification_number` identification methods.
     */
    #[Optional('natural_person')]
    public ?NaturalPerson $naturalPerson;

    /**
     * An assessment of the entity's potential risk of involvement in financial crimes, such as money laundering.
     */
    #[Optional('risk_rating')]
    public ?RiskRating $riskRating;

    /**
     * Additional documentation associated with the entity.
     *
     * @var list<SupplementalDocument>|null $supplementalDocuments
     */
    #[Optional('supplemental_documents', list: SupplementalDocument::class)]
    public ?array $supplementalDocuments;

    /**
     * The terms that the Entity agreed to. Not all programs are required to submit this data.
     *
     * @var list<TermsAgreement>|null $termsAgreements
     */
    #[Optional('terms_agreements', list: TermsAgreement::class)]
    public ?array $termsAgreements;

    /**
     * If you are using a third-party service for identity verification, you can use this field to associate this Entity with the identifier that represents them in that service.
     */
    #[Optional('third_party_verification')]
    public ?ThirdPartyVerification $thirdPartyVerification;

    /**
     * Details of the trust entity to create. Required if `structure` is equal to `trust`.
     */
    #[Optional]
    public ?Trust $trust;

    /**
     * `new EntityCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityCreateParams::with(structure: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityCreateParams)->withStructure(...)
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
     * @param Structure|value-of<Structure> $structure
     * @param Corporation|CorporationShape|null $corporation
     * @param GovernmentAuthority|GovernmentAuthorityShape|null $governmentAuthority
     * @param Joint|JointShape|null $joint
     * @param NaturalPerson|NaturalPersonShape|null $naturalPerson
     * @param RiskRating|RiskRatingShape|null $riskRating
     * @param list<SupplementalDocument|SupplementalDocumentShape>|null $supplementalDocuments
     * @param list<TermsAgreement|TermsAgreementShape>|null $termsAgreements
     * @param ThirdPartyVerification|ThirdPartyVerificationShape|null $thirdPartyVerification
     * @param Trust|TrustShape|null $trust
     */
    public static function with(
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
    ): self {
        $self = new self;

        $self['structure'] = $structure;

        null !== $corporation && $self['corporation'] = $corporation;
        null !== $description && $self['description'] = $description;
        null !== $governmentAuthority && $self['governmentAuthority'] = $governmentAuthority;
        null !== $joint && $self['joint'] = $joint;
        null !== $naturalPerson && $self['naturalPerson'] = $naturalPerson;
        null !== $riskRating && $self['riskRating'] = $riskRating;
        null !== $supplementalDocuments && $self['supplementalDocuments'] = $supplementalDocuments;
        null !== $termsAgreements && $self['termsAgreements'] = $termsAgreements;
        null !== $thirdPartyVerification && $self['thirdPartyVerification'] = $thirdPartyVerification;
        null !== $trust && $self['trust'] = $trust;

        return $self;
    }

    /**
     * The type of Entity to create.
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
     * Details of the corporation entity to create. Required if `structure` is equal to `corporation`.
     *
     * @param Corporation|CorporationShape $corporation
     */
    public function withCorporation(Corporation|array $corporation): self
    {
        $self = clone $this;
        $self['corporation'] = $corporation;

        return $self;
    }

    /**
     * The description you choose to give the entity.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Details of the Government Authority entity to create. Required if `structure` is equal to `government_authority`.
     *
     * @param GovernmentAuthority|GovernmentAuthorityShape $governmentAuthority
     */
    public function withGovernmentAuthority(
        GovernmentAuthority|array $governmentAuthority
    ): self {
        $self = clone $this;
        $self['governmentAuthority'] = $governmentAuthority;

        return $self;
    }

    /**
     * Details of the joint entity to create. Required if `structure` is equal to `joint`.
     *
     * @param Joint|JointShape $joint
     */
    public function withJoint(Joint|array $joint): self
    {
        $self = clone $this;
        $self['joint'] = $joint;

        return $self;
    }

    /**
     * Details of the natural person entity to create. Required if `structure` is equal to `natural_person`. Natural people entities should be submitted with `social_security_number` or `individual_taxpayer_identification_number` identification methods.
     *
     * @param NaturalPerson|NaturalPersonShape $naturalPerson
     */
    public function withNaturalPerson(NaturalPerson|array $naturalPerson): self
    {
        $self = clone $this;
        $self['naturalPerson'] = $naturalPerson;

        return $self;
    }

    /**
     * An assessment of the entity's potential risk of involvement in financial crimes, such as money laundering.
     *
     * @param RiskRating|RiskRatingShape $riskRating
     */
    public function withRiskRating(RiskRating|array $riskRating): self
    {
        $self = clone $this;
        $self['riskRating'] = $riskRating;

        return $self;
    }

    /**
     * Additional documentation associated with the entity.
     *
     * @param list<SupplementalDocument|SupplementalDocumentShape> $supplementalDocuments
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
     * @param ThirdPartyVerification|ThirdPartyVerificationShape $thirdPartyVerification
     */
    public function withThirdPartyVerification(
        ThirdPartyVerification|array $thirdPartyVerification
    ): self {
        $self = clone $this;
        $self['thirdPartyVerification'] = $thirdPartyVerification;

        return $self;
    }

    /**
     * Details of the trust entity to create. Required if `structure` is equal to `trust`.
     *
     * @param Trust|TrustShape $trust
     */
    public function withTrust(Trust|array $trust): self
    {
        $self = clone $this;
        $self['trust'] = $trust;

        return $self;
    }
}

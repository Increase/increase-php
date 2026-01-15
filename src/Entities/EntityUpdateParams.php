<?php

declare(strict_types=1);

namespace Increase\Entities;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityUpdateParams\Corporation;
use Increase\Entities\EntityUpdateParams\GovernmentAuthority;
use Increase\Entities\EntityUpdateParams\NaturalPerson;
use Increase\Entities\EntityUpdateParams\RiskRating;
use Increase\Entities\EntityUpdateParams\ThirdPartyVerification;
use Increase\Entities\EntityUpdateParams\Trust;

/**
 * Update an Entity.
 *
 * @see Increase\Services\EntitiesService::update()
 *
 * @phpstan-import-type CorporationShape from \Increase\Entities\EntityUpdateParams\Corporation
 * @phpstan-import-type GovernmentAuthorityShape from \Increase\Entities\EntityUpdateParams\GovernmentAuthority
 * @phpstan-import-type NaturalPersonShape from \Increase\Entities\EntityUpdateParams\NaturalPerson
 * @phpstan-import-type RiskRatingShape from \Increase\Entities\EntityUpdateParams\RiskRating
 * @phpstan-import-type ThirdPartyVerificationShape from \Increase\Entities\EntityUpdateParams\ThirdPartyVerification
 * @phpstan-import-type TrustShape from \Increase\Entities\EntityUpdateParams\Trust
 *
 * @phpstan-type EntityUpdateParamsShape = array{
 *   corporation?: null|Corporation|CorporationShape,
 *   detailsConfirmedAt?: \DateTimeInterface|null,
 *   governmentAuthority?: null|GovernmentAuthority|GovernmentAuthorityShape,
 *   naturalPerson?: null|NaturalPerson|NaturalPersonShape,
 *   riskRating?: null|RiskRating|RiskRatingShape,
 *   thirdPartyVerification?: null|ThirdPartyVerification|ThirdPartyVerificationShape,
 *   trust?: null|Trust|TrustShape,
 * }
 */
final class EntityUpdateParams implements BaseModel
{
    /** @use SdkModel<EntityUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Details of the corporation entity to update. If you specify this parameter and the entity is not a corporation, the request will fail.
     */
    #[Optional]
    public ?Corporation $corporation;

    /**
     * When your user last confirmed the Entity's details. Depending on your program, you may be required to affirmatively confirm details with your users on an annual basis.
     */
    #[Optional('details_confirmed_at')]
    public ?\DateTimeInterface $detailsConfirmedAt;

    /**
     * Details of the government authority entity to update. If you specify this parameter and the entity is not a government authority, the request will fail.
     */
    #[Optional('government_authority')]
    public ?GovernmentAuthority $governmentAuthority;

    /**
     * Details of the natural person entity to update. If you specify this parameter and the entity is not a natural person, the request will fail.
     */
    #[Optional('natural_person')]
    public ?NaturalPerson $naturalPerson;

    /**
     * An assessment of the entity’s potential risk of involvement in financial crimes, such as money laundering.
     */
    #[Optional('risk_rating')]
    public ?RiskRating $riskRating;

    /**
     * If you are using a third-party service for identity verification, you can use this field to associate this Entity with the identifier that represents them in that service.
     */
    #[Optional('third_party_verification')]
    public ?ThirdPartyVerification $thirdPartyVerification;

    /**
     * Details of the trust entity to update. If you specify this parameter and the entity is not a trust, the request will fail.
     */
    #[Optional]
    public ?Trust $trust;

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
     * @param NaturalPerson|NaturalPersonShape|null $naturalPerson
     * @param RiskRating|RiskRatingShape|null $riskRating
     * @param ThirdPartyVerification|ThirdPartyVerificationShape|null $thirdPartyVerification
     * @param Trust|TrustShape|null $trust
     */
    public static function with(
        Corporation|array|null $corporation = null,
        ?\DateTimeInterface $detailsConfirmedAt = null,
        GovernmentAuthority|array|null $governmentAuthority = null,
        NaturalPerson|array|null $naturalPerson = null,
        RiskRating|array|null $riskRating = null,
        ThirdPartyVerification|array|null $thirdPartyVerification = null,
        Trust|array|null $trust = null,
    ): self {
        $self = new self;

        null !== $corporation && $self['corporation'] = $corporation;
        null !== $detailsConfirmedAt && $self['detailsConfirmedAt'] = $detailsConfirmedAt;
        null !== $governmentAuthority && $self['governmentAuthority'] = $governmentAuthority;
        null !== $naturalPerson && $self['naturalPerson'] = $naturalPerson;
        null !== $riskRating && $self['riskRating'] = $riskRating;
        null !== $thirdPartyVerification && $self['thirdPartyVerification'] = $thirdPartyVerification;
        null !== $trust && $self['trust'] = $trust;

        return $self;
    }

    /**
     * Details of the corporation entity to update. If you specify this parameter and the entity is not a corporation, the request will fail.
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
     * When your user last confirmed the Entity's details. Depending on your program, you may be required to affirmatively confirm details with your users on an annual basis.
     */
    public function withDetailsConfirmedAt(
        \DateTimeInterface $detailsConfirmedAt
    ): self {
        $self = clone $this;
        $self['detailsConfirmedAt'] = $detailsConfirmedAt;

        return $self;
    }

    /**
     * Details of the government authority entity to update. If you specify this parameter and the entity is not a government authority, the request will fail.
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
     * Details of the natural person entity to update. If you specify this parameter and the entity is not a natural person, the request will fail.
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
     * An assessment of the entity’s potential risk of involvement in financial crimes, such as money laundering.
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
     * Details of the trust entity to update. If you specify this parameter and the entity is not a trust, the request will fail.
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

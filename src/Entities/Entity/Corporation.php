<?php

declare(strict_types=1);

namespace Increase\Entities\Entity;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Corporation\Address;
use Increase\Entities\Entity\Corporation\BeneficialOwner;
use Increase\Entities\Entity\Corporation\LegalIdentifier;

/**
 * Details of the corporation entity. Will be present if `structure` is equal to `corporation`.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\Entity\Corporation\Address
 * @phpstan-import-type BeneficialOwnerShape from \Increase\Entities\Entity\Corporation\BeneficialOwner
 * @phpstan-import-type LegalIdentifierShape from \Increase\Entities\Entity\Corporation\LegalIdentifier
 *
 * @phpstan-type CorporationShape = array{
 *   address: Address|AddressShape,
 *   beneficialOwners: list<BeneficialOwner|BeneficialOwnerShape>,
 *   email: string|null,
 *   incorporationState: string|null,
 *   industryCode: string|null,
 *   legalIdentifier: null|LegalIdentifier|LegalIdentifierShape,
 *   name: string,
 *   website: string|null,
 * }
 */
final class Corporation implements BaseModel
{
    /** @use SdkModel<CorporationShape> */
    use SdkModel;

    /**
     * The corporation's address.
     */
    #[Required]
    public Address $address;

    /**
     * The identifying details of anyone controlling or owning 25% or more of the corporation.
     *
     * @var list<BeneficialOwner> $beneficialOwners
     */
    #[Required('beneficial_owners', list: BeneficialOwner::class)]
    public array $beneficialOwners;

    /**
     * An email address for the business.
     */
    #[Required]
    public ?string $email;

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the corporation's state of incorporation.
     */
    #[Required('incorporation_state')]
    public ?string $incorporationState;

    /**
     * The numeric North American Industry Classification System (NAICS) code submitted for the corporation.
     */
    #[Required('industry_code')]
    public ?string $industryCode;

    /**
     * The legal identifier of the corporation.
     */
    #[Required('legal_identifier')]
    public ?LegalIdentifier $legalIdentifier;

    /**
     * The legal name of the corporation.
     */
    #[Required]
    public string $name;

    /**
     * The website of the corporation.
     */
    #[Required]
    public ?string $website;

    /**
     * `new Corporation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Corporation::with(
     *   address: ...,
     *   beneficialOwners: ...,
     *   email: ...,
     *   incorporationState: ...,
     *   industryCode: ...,
     *   legalIdentifier: ...,
     *   name: ...,
     *   website: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Corporation)
     *   ->withAddress(...)
     *   ->withBeneficialOwners(...)
     *   ->withEmail(...)
     *   ->withIncorporationState(...)
     *   ->withIndustryCode(...)
     *   ->withLegalIdentifier(...)
     *   ->withName(...)
     *   ->withWebsite(...)
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
     * @param Address|AddressShape $address
     * @param list<BeneficialOwner|BeneficialOwnerShape> $beneficialOwners
     * @param LegalIdentifier|LegalIdentifierShape|null $legalIdentifier
     */
    public static function with(
        Address|array $address,
        array $beneficialOwners,
        ?string $email,
        ?string $incorporationState,
        ?string $industryCode,
        LegalIdentifier|array|null $legalIdentifier,
        string $name,
        ?string $website,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['beneficialOwners'] = $beneficialOwners;
        $self['email'] = $email;
        $self['incorporationState'] = $incorporationState;
        $self['industryCode'] = $industryCode;
        $self['legalIdentifier'] = $legalIdentifier;
        $self['name'] = $name;
        $self['website'] = $website;

        return $self;
    }

    /**
     * The corporation's address.
     *
     * @param Address|AddressShape $address
     */
    public function withAddress(Address|array $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * The identifying details of anyone controlling or owning 25% or more of the corporation.
     *
     * @param list<BeneficialOwner|BeneficialOwnerShape> $beneficialOwners
     */
    public function withBeneficialOwners(array $beneficialOwners): self
    {
        $self = clone $this;
        $self['beneficialOwners'] = $beneficialOwners;

        return $self;
    }

    /**
     * An email address for the business.
     */
    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the corporation's state of incorporation.
     */
    public function withIncorporationState(?string $incorporationState): self
    {
        $self = clone $this;
        $self['incorporationState'] = $incorporationState;

        return $self;
    }

    /**
     * The numeric North American Industry Classification System (NAICS) code submitted for the corporation.
     */
    public function withIndustryCode(?string $industryCode): self
    {
        $self = clone $this;
        $self['industryCode'] = $industryCode;

        return $self;
    }

    /**
     * The legal identifier of the corporation.
     *
     * @param LegalIdentifier|LegalIdentifierShape|null $legalIdentifier
     */
    public function withLegalIdentifier(
        LegalIdentifier|array|null $legalIdentifier
    ): self {
        $self = clone $this;
        $self['legalIdentifier'] = $legalIdentifier;

        return $self;
    }

    /**
     * The legal name of the corporation.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The website of the corporation.
     */
    public function withWebsite(?string $website): self
    {
        $self = clone $this;
        $self['website'] = $website;

        return $self;
    }
}

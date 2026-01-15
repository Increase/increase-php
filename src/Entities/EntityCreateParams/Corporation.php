<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateParams\Corporation\Address;
use Increase\Entities\EntityCreateParams\Corporation\BeneficialOwner;
use Increase\Entities\EntityCreateParams\Corporation\BeneficialOwnershipExemptionReason;

/**
 * Details of the corporation entity to create. Required if `structure` is equal to `corporation`.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityCreateParams\Corporation\Address
 * @phpstan-import-type BeneficialOwnerShape from \Increase\Entities\EntityCreateParams\Corporation\BeneficialOwner
 *
 * @phpstan-type CorporationShape = array{
 *   address: Address|AddressShape,
 *   beneficialOwners: list<BeneficialOwner|BeneficialOwnerShape>,
 *   name: string,
 *   taxIdentifier: string,
 *   beneficialOwnershipExemptionReason?: null|BeneficialOwnershipExemptionReason|value-of<BeneficialOwnershipExemptionReason>,
 *   email?: string|null,
 *   incorporationState?: string|null,
 *   industryCode?: string|null,
 *   website?: string|null,
 * }
 */
final class Corporation implements BaseModel
{
    /** @use SdkModel<CorporationShape> */
    use SdkModel;

    /**
     * The entity's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Required]
    public Address $address;

    /**
     * The identifying details of each person who owns 25% or more of the business and one control person, like the CEO, CFO, or other executive. You can submit between 1 and 5 people to this list.
     *
     * @var list<BeneficialOwner> $beneficialOwners
     */
    #[Required('beneficial_owners', list: BeneficialOwner::class)]
    public array $beneficialOwners;

    /**
     * The legal name of the corporation.
     */
    #[Required]
    public string $name;

    /**
     * The Employer Identification Number (EIN) for the corporation.
     */
    #[Required('tax_identifier')]
    public string $taxIdentifier;

    /**
     * If the entity is exempt from the requirement to submit beneficial owners, provide the justification. If a reason is provided, you do not need to submit a list of beneficial owners.
     *
     * @var value-of<BeneficialOwnershipExemptionReason>|null $beneficialOwnershipExemptionReason
     */
    #[Optional(
        'beneficial_ownership_exemption_reason',
        enum: BeneficialOwnershipExemptionReason::class,
    )]
    public ?string $beneficialOwnershipExemptionReason;

    /**
     * An email address for the business. Not every program requires an email for submitted Entities.
     */
    #[Optional]
    public ?string $email;

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the corporation's state of incorporation.
     */
    #[Optional('incorporation_state')]
    public ?string $incorporationState;

    /**
     * The North American Industry Classification System (NAICS) code for the corporation's primary line of business. This is a number, like `5132` for `Software Publishers`. A full list of classification codes is available [here](https://increase.com/documentation/data-dictionary#north-american-industry-classification-system-codes).
     */
    #[Optional('industry_code')]
    public ?string $industryCode;

    /**
     * The website of the corporation.
     */
    #[Optional]
    public ?string $website;

    /**
     * `new Corporation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Corporation::with(
     *   address: ..., beneficialOwners: ..., name: ..., taxIdentifier: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Corporation)
     *   ->withAddress(...)
     *   ->withBeneficialOwners(...)
     *   ->withName(...)
     *   ->withTaxIdentifier(...)
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
     * @param BeneficialOwnershipExemptionReason|value-of<BeneficialOwnershipExemptionReason>|null $beneficialOwnershipExemptionReason
     */
    public static function with(
        Address|array $address,
        array $beneficialOwners,
        string $name,
        string $taxIdentifier,
        BeneficialOwnershipExemptionReason|string|null $beneficialOwnershipExemptionReason = null,
        ?string $email = null,
        ?string $incorporationState = null,
        ?string $industryCode = null,
        ?string $website = null,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['beneficialOwners'] = $beneficialOwners;
        $self['name'] = $name;
        $self['taxIdentifier'] = $taxIdentifier;

        null !== $beneficialOwnershipExemptionReason && $self['beneficialOwnershipExemptionReason'] = $beneficialOwnershipExemptionReason;
        null !== $email && $self['email'] = $email;
        null !== $incorporationState && $self['incorporationState'] = $incorporationState;
        null !== $industryCode && $self['industryCode'] = $industryCode;
        null !== $website && $self['website'] = $website;

        return $self;
    }

    /**
     * The entity's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
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
     * The identifying details of each person who owns 25% or more of the business and one control person, like the CEO, CFO, or other executive. You can submit between 1 and 5 people to this list.
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
     * The legal name of the corporation.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The Employer Identification Number (EIN) for the corporation.
     */
    public function withTaxIdentifier(string $taxIdentifier): self
    {
        $self = clone $this;
        $self['taxIdentifier'] = $taxIdentifier;

        return $self;
    }

    /**
     * If the entity is exempt from the requirement to submit beneficial owners, provide the justification. If a reason is provided, you do not need to submit a list of beneficial owners.
     *
     * @param BeneficialOwnershipExemptionReason|value-of<BeneficialOwnershipExemptionReason> $beneficialOwnershipExemptionReason
     */
    public function withBeneficialOwnershipExemptionReason(
        BeneficialOwnershipExemptionReason|string $beneficialOwnershipExemptionReason,
    ): self {
        $self = clone $this;
        $self['beneficialOwnershipExemptionReason'] = $beneficialOwnershipExemptionReason;

        return $self;
    }

    /**
     * An email address for the business. Not every program requires an email for submitted Entities.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the corporation's state of incorporation.
     */
    public function withIncorporationState(string $incorporationState): self
    {
        $self = clone $this;
        $self['incorporationState'] = $incorporationState;

        return $self;
    }

    /**
     * The North American Industry Classification System (NAICS) code for the corporation's primary line of business. This is a number, like `5132` for `Software Publishers`. A full list of classification codes is available [here](https://increase.com/documentation/data-dictionary#north-american-industry-classification-system-codes).
     */
    public function withIndustryCode(string $industryCode): self
    {
        $self = clone $this;
        $self['industryCode'] = $industryCode;

        return $self;
    }

    /**
     * The website of the corporation.
     */
    public function withWebsite(string $website): self
    {
        $self = clone $this;
        $self['website'] = $website;

        return $self;
    }
}

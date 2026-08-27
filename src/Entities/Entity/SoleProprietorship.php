<?php

declare(strict_types=1);

namespace Increase\Entities\Entity;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\SoleProprietorship\Address;
use Increase\Entities\Entity\SoleProprietorship\SoleProprietor;

/**
 * Details of the sole proprietorship entity. Will be present if `structure` is equal to `sole_proprietorship`.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\Entity\SoleProprietorship\Address
 * @phpstan-import-type SoleProprietorShape from \Increase\Entities\Entity\SoleProprietorship\SoleProprietor
 *
 * @phpstan-type SoleProprietorshipShape = array{
 *   address: Address|AddressShape,
 *   doingBusinessAsName: string|null,
 *   email: string|null,
 *   industryCode: string|null,
 *   soleProprietor: SoleProprietor|SoleProprietorShape,
 *   taxIdentifier: string|null,
 *   website: string|null,
 * }
 */
final class SoleProprietorship implements BaseModel
{
    /** @use SdkModel<SoleProprietorshipShape> */
    use SdkModel;

    /**
     * The sole proprietorship's address.
     */
    #[Required]
    public Address $address;

    /**
     * The name under which the sole proprietorship does business.
     */
    #[Required('doing_business_as_name')]
    public ?string $doingBusinessAsName;

    /**
     * An email address for the sole proprietorship.
     */
    #[Required]
    public ?string $email;

    /**
     * The numeric North American Industry Classification System (NAICS) code submitted for the sole proprietorship.
     */
    #[Required('industry_code')]
    public ?string $industryCode;

    /**
     * The individual who operates the sole proprietorship.
     */
    #[Required('sole_proprietor')]
    public SoleProprietor $soleProprietor;

    /**
     * The Employer Identification Number (EIN) for the sole proprietorship.
     */
    #[Required('tax_identifier')]
    public ?string $taxIdentifier;

    /**
     * The sole proprietorship's website.
     */
    #[Required]
    public ?string $website;

    /**
     * `new SoleProprietorship()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SoleProprietorship::with(
     *   address: ...,
     *   doingBusinessAsName: ...,
     *   email: ...,
     *   industryCode: ...,
     *   soleProprietor: ...,
     *   taxIdentifier: ...,
     *   website: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SoleProprietorship)
     *   ->withAddress(...)
     *   ->withDoingBusinessAsName(...)
     *   ->withEmail(...)
     *   ->withIndustryCode(...)
     *   ->withSoleProprietor(...)
     *   ->withTaxIdentifier(...)
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
     * @param SoleProprietor|SoleProprietorShape $soleProprietor
     */
    public static function with(
        Address|array $address,
        ?string $doingBusinessAsName,
        ?string $email,
        ?string $industryCode,
        SoleProprietor|array $soleProprietor,
        ?string $taxIdentifier,
        ?string $website,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['doingBusinessAsName'] = $doingBusinessAsName;
        $self['email'] = $email;
        $self['industryCode'] = $industryCode;
        $self['soleProprietor'] = $soleProprietor;
        $self['taxIdentifier'] = $taxIdentifier;
        $self['website'] = $website;

        return $self;
    }

    /**
     * The sole proprietorship's address.
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
     * The name under which the sole proprietorship does business.
     */
    public function withDoingBusinessAsName(?string $doingBusinessAsName): self
    {
        $self = clone $this;
        $self['doingBusinessAsName'] = $doingBusinessAsName;

        return $self;
    }

    /**
     * An email address for the sole proprietorship.
     */
    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * The numeric North American Industry Classification System (NAICS) code submitted for the sole proprietorship.
     */
    public function withIndustryCode(?string $industryCode): self
    {
        $self = clone $this;
        $self['industryCode'] = $industryCode;

        return $self;
    }

    /**
     * The individual who operates the sole proprietorship.
     *
     * @param SoleProprietor|SoleProprietorShape $soleProprietor
     */
    public function withSoleProprietor(
        SoleProprietor|array $soleProprietor
    ): self {
        $self = clone $this;
        $self['soleProprietor'] = $soleProprietor;

        return $self;
    }

    /**
     * The Employer Identification Number (EIN) for the sole proprietorship.
     */
    public function withTaxIdentifier(?string $taxIdentifier): self
    {
        $self = clone $this;
        $self['taxIdentifier'] = $taxIdentifier;

        return $self;
    }

    /**
     * The sole proprietorship's website.
     */
    public function withWebsite(?string $website): self
    {
        $self = clone $this;
        $self['website'] = $website;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateParams\SoleProprietorship\Address;
use Increase\Entities\EntityCreateParams\SoleProprietorship\SoleProprietor;

/**
 * Details of the sole proprietorship entity to create. Required if `structure` is equal to `sole_proprietorship`.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityCreateParams\SoleProprietorship\Address
 * @phpstan-import-type SoleProprietorShape from \Increase\Entities\EntityCreateParams\SoleProprietorship\SoleProprietor
 *
 * @phpstan-type SoleProprietorshipShape = array{
 *   address: Address|AddressShape,
 *   soleProprietor: SoleProprietor|SoleProprietorShape,
 *   doingBusinessAsName?: string|null,
 *   email?: string|null,
 *   industryCode?: string|null,
 *   taxIdentifier?: string|null,
 *   website?: string|null,
 * }
 */
final class SoleProprietorship implements BaseModel
{
    /** @use SdkModel<SoleProprietorshipShape> */
    use SdkModel;

    /**
     * The sole proprietorship's business address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Required]
    public Address $address;

    /**
     * The individual who operates the sole proprietorship.
     */
    #[Required('sole_proprietor')]
    public SoleProprietor $soleProprietor;

    /**
     * The name under which the sole proprietorship does business, if it is different from the name of the sole proprietor.
     */
    #[Optional('doing_business_as_name')]
    public ?string $doingBusinessAsName;

    /**
     * An email address for the sole proprietorship. Not every program requires an email for submitted Entities.
     */
    #[Optional]
    public ?string $email;

    /**
     * The North American Industry Classification System (NAICS) code for the sole proprietorship's primary line of business. This is a number, like `5132` for `Software Publishers`. A full list of classification codes is available [here](https://increase.com/documentation/data-dictionary#north-american-industry-classification-system-codes).
     */
    #[Optional('industry_code')]
    public ?string $industryCode;

    /**
     * The United States Employer Identification Number (EIN) for the sole proprietorship, if the sole proprietor has one. Submit nine digits with no dashes or other separators.
     */
    #[Optional('tax_identifier')]
    public ?string $taxIdentifier;

    /**
     * A website for the sole proprietorship. Not every program requires a website for submitted Entities.
     */
    #[Optional]
    public ?string $website;

    /**
     * `new SoleProprietorship()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SoleProprietorship::with(address: ..., soleProprietor: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SoleProprietorship)->withAddress(...)->withSoleProprietor(...)
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
        SoleProprietor|array $soleProprietor,
        ?string $doingBusinessAsName = null,
        ?string $email = null,
        ?string $industryCode = null,
        ?string $taxIdentifier = null,
        ?string $website = null,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['soleProprietor'] = $soleProprietor;

        null !== $doingBusinessAsName && $self['doingBusinessAsName'] = $doingBusinessAsName;
        null !== $email && $self['email'] = $email;
        null !== $industryCode && $self['industryCode'] = $industryCode;
        null !== $taxIdentifier && $self['taxIdentifier'] = $taxIdentifier;
        null !== $website && $self['website'] = $website;

        return $self;
    }

    /**
     * The sole proprietorship's business address. Mail receiving locations like PO Boxes and PMB's are disallowed.
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
     * The name under which the sole proprietorship does business, if it is different from the name of the sole proprietor.
     */
    public function withDoingBusinessAsName(string $doingBusinessAsName): self
    {
        $self = clone $this;
        $self['doingBusinessAsName'] = $doingBusinessAsName;

        return $self;
    }

    /**
     * An email address for the sole proprietorship. Not every program requires an email for submitted Entities.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * The North American Industry Classification System (NAICS) code for the sole proprietorship's primary line of business. This is a number, like `5132` for `Software Publishers`. A full list of classification codes is available [here](https://increase.com/documentation/data-dictionary#north-american-industry-classification-system-codes).
     */
    public function withIndustryCode(string $industryCode): self
    {
        $self = clone $this;
        $self['industryCode'] = $industryCode;

        return $self;
    }

    /**
     * The United States Employer Identification Number (EIN) for the sole proprietorship, if the sole proprietor has one. Submit nine digits with no dashes or other separators.
     */
    public function withTaxIdentifier(string $taxIdentifier): self
    {
        $self = clone $this;
        $self['taxIdentifier'] = $taxIdentifier;

        return $self;
    }

    /**
     * A website for the sole proprietorship. Not every program requires a website for submitted Entities.
     */
    public function withWebsite(string $website): self
    {
        $self = clone $this;
        $self['website'] = $website;

        return $self;
    }
}

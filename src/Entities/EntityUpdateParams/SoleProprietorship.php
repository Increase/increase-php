<?php

declare(strict_types=1);

namespace Increase\Entities\EntityUpdateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityUpdateParams\SoleProprietorship\Address;
use Increase\Entities\EntityUpdateParams\SoleProprietorship\SoleProprietor;

/**
 * Details of the sole proprietorship entity to update. If you specify this parameter and the entity is not a sole proprietorship, the request will fail.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityUpdateParams\SoleProprietorship\Address
 * @phpstan-import-type SoleProprietorShape from \Increase\Entities\EntityUpdateParams\SoleProprietorship\SoleProprietor
 *
 * @phpstan-type SoleProprietorshipShape = array{
 *   address?: null|Address|AddressShape,
 *   email?: string|null,
 *   soleProprietor?: null|SoleProprietor|SoleProprietorShape,
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
    #[Optional]
    public ?Address $address;

    /**
     * An email address for the sole proprietorship. Not every program requires an email for submitted Entities.
     */
    #[Optional]
    public ?string $email;

    /**
     * Details of the individual who operates the sole proprietorship.
     */
    #[Optional('sole_proprietor')]
    public ?SoleProprietor $soleProprietor;

    /**
     * The United States Employer Identification Number (EIN) for the sole proprietorship. Submit nine digits with no dashes or other separators.
     */
    #[Optional('tax_identifier')]
    public ?string $taxIdentifier;

    /**
     * A website for the sole proprietorship. Not every program requires a website for submitted Entities.
     */
    #[Optional]
    public ?string $website;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Address|AddressShape|null $address
     * @param SoleProprietor|SoleProprietorShape|null $soleProprietor
     */
    public static function with(
        Address|array|null $address = null,
        ?string $email = null,
        SoleProprietor|array|null $soleProprietor = null,
        ?string $taxIdentifier = null,
        ?string $website = null,
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $email && $self['email'] = $email;
        null !== $soleProprietor && $self['soleProprietor'] = $soleProprietor;
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
     * An email address for the sole proprietorship. Not every program requires an email for submitted Entities.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Details of the individual who operates the sole proprietorship.
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
     * The United States Employer Identification Number (EIN) for the sole proprietorship. Submit nine digits with no dashes or other separators.
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

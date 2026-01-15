<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\Corporation\BeneficialOwner\Individual;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The individual's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
 *
 * @phpstan-type AddressShape = array{
 *   city: string,
 *   country: string,
 *   line1: string,
 *   line2?: string|null,
 *   state?: string|null,
 *   zip?: string|null,
 * }
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
    use SdkModel;

    /**
     * The city, district, town, or village of the address.
     */
    #[Required]
    public string $city;

    /**
     * The two-letter ISO 3166-1 alpha-2 code for the country of the address.
     */
    #[Required]
    public string $country;

    /**
     * The first line of the address. This is usually the street number and street.
     */
    #[Required]
    public string $line1;

    /**
     * The second line of the address. This might be the floor or room number.
     */
    #[Optional]
    public ?string $line2;

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the US state, province, or region of the address. Required in certain countries.
     */
    #[Optional]
    public ?string $state;

    /**
     * The ZIP or postal code of the address. Required in certain countries.
     */
    #[Optional]
    public ?string $zip;

    /**
     * `new Address()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Address::with(city: ..., country: ..., line1: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Address)->withCity(...)->withCountry(...)->withLine1(...)
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
     */
    public static function with(
        string $city,
        string $country,
        string $line1,
        ?string $line2 = null,
        ?string $state = null,
        ?string $zip = null,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['country'] = $country;
        $self['line1'] = $line1;

        null !== $line2 && $self['line2'] = $line2;
        null !== $state && $self['state'] = $state;
        null !== $zip && $self['zip'] = $zip;

        return $self;
    }

    /**
     * The city, district, town, or village of the address.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The two-letter ISO 3166-1 alpha-2 code for the country of the address.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * The first line of the address. This is usually the street number and street.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The second line of the address. This might be the floor or room number.
     */
    public function withLine2(string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the US state, province, or region of the address. Required in certain countries.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The ZIP or postal code of the address. Required in certain countries.
     */
    public function withZip(string $zip): self
    {
        $self = clone $this;
        $self['zip'] = $zip;

        return $self;
    }
}

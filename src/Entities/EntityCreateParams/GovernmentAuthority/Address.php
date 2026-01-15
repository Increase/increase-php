<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\GovernmentAuthority;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The entity's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
 *
 * @phpstan-type AddressShape = array{
 *   city: string, line1: string, state: string, zip: string, line2?: string|null
 * }
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
    use SdkModel;

    /**
     * The city of the address.
     */
    #[Required]
    public string $city;

    /**
     * The first line of the address. This is usually the street number and street.
     */
    #[Required]
    public string $line1;

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the state of the address.
     */
    #[Required]
    public string $state;

    /**
     * The ZIP code of the address.
     */
    #[Required]
    public string $zip;

    /**
     * The second line of the address. This might be the floor or room number.
     */
    #[Optional]
    public ?string $line2;

    /**
     * `new Address()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Address::with(city: ..., line1: ..., state: ..., zip: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Address)->withCity(...)->withLine1(...)->withState(...)->withZip(...)
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
        string $line1,
        string $state,
        string $zip,
        ?string $line2 = null,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['line1'] = $line1;
        $self['state'] = $state;
        $self['zip'] = $zip;

        null !== $line2 && $self['line2'] = $line2;

        return $self;
    }

    /**
     * The city of the address.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

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
     * The two-letter United States Postal Service (USPS) abbreviation for the state of the address.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The ZIP code of the address.
     */
    public function withZip(string $zip): self
    {
        $self = clone $this;
        $self['zip'] = $zip;

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
}

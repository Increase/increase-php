<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCard\Shipment;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The location to where the card's packing label is addressed.
 *
 * @phpstan-type AddressShape = array{
 *   city: string,
 *   country: string,
 *   line1: string,
 *   line2: string|null,
 *   line3: string|null,
 *   name: string,
 *   postalCode: string,
 *   state: string,
 * }
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
    use SdkModel;

    /**
     * The city of the shipping address.
     */
    #[Required]
    public string $city;

    /**
     * The country of the shipping address.
     */
    #[Required]
    public string $country;

    /**
     * The first line of the shipping address.
     */
    #[Required]
    public string $line1;

    /**
     * The second line of the shipping address.
     */
    #[Required]
    public ?string $line2;

    /**
     * The third line of the shipping address.
     */
    #[Required]
    public ?string $line3;

    /**
     * The name of the recipient.
     */
    #[Required]
    public string $name;

    /**
     * The postal code of the shipping address.
     */
    #[Required('postal_code')]
    public string $postalCode;

    /**
     * The state of the shipping address.
     */
    #[Required]
    public string $state;

    /**
     * `new Address()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Address::with(
     *   city: ...,
     *   country: ...,
     *   line1: ...,
     *   line2: ...,
     *   line3: ...,
     *   name: ...,
     *   postalCode: ...,
     *   state: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Address)
     *   ->withCity(...)
     *   ->withCountry(...)
     *   ->withLine1(...)
     *   ->withLine2(...)
     *   ->withLine3(...)
     *   ->withName(...)
     *   ->withPostalCode(...)
     *   ->withState(...)
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
        ?string $line2,
        ?string $line3,
        string $name,
        string $postalCode,
        string $state,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['country'] = $country;
        $self['line1'] = $line1;
        $self['line2'] = $line2;
        $self['line3'] = $line3;
        $self['name'] = $name;
        $self['postalCode'] = $postalCode;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The city of the shipping address.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The country of the shipping address.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * The first line of the shipping address.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The second line of the shipping address.
     */
    public function withLine2(?string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }

    /**
     * The third line of the shipping address.
     */
    public function withLine3(?string $line3): self
    {
        $self = clone $this;
        $self['line3'] = $line3;

        return $self;
    }

    /**
     * The name of the recipient.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The postal code of the shipping address.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The state of the shipping address.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}

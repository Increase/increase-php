<?php

declare(strict_types=1);

namespace Increase\PhysicalCards\PhysicalCardCreateParams\Shipment;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The address to where the card should be shipped.
 *
 * @phpstan-type AddressShape = array{
 *   city: string,
 *   line1: string,
 *   name: string,
 *   postalCode: string,
 *   state: string,
 *   country?: string|null,
 *   line2?: string|null,
 *   line3?: string|null,
 *   phoneNumber?: string|null,
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
     * The first line of the shipping address.
     */
    #[Required]
    public string $line1;

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
     * The two-character ISO 3166-1 code of the country where the card should be shipped (e.g., `US`). Please reach out to [support@increase.com](mailto:support@increase.com) to ship cards internationally.
     */
    #[Optional]
    public ?string $country;

    /**
     * The second line of the shipping address.
     */
    #[Optional]
    public ?string $line2;

    /**
     * The third line of the shipping address.
     */
    #[Optional]
    public ?string $line3;

    /**
     * The phone number of the recipient.
     */
    #[Optional('phone_number')]
    public ?string $phoneNumber;

    /**
     * `new Address()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Address::with(city: ..., line1: ..., name: ..., postalCode: ..., state: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Address)
     *   ->withCity(...)
     *   ->withLine1(...)
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
        string $line1,
        string $name,
        string $postalCode,
        string $state,
        ?string $country = null,
        ?string $line2 = null,
        ?string $line3 = null,
        ?string $phoneNumber = null,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['line1'] = $line1;
        $self['name'] = $name;
        $self['postalCode'] = $postalCode;
        $self['state'] = $state;

        null !== $country && $self['country'] = $country;
        null !== $line2 && $self['line2'] = $line2;
        null !== $line3 && $self['line3'] = $line3;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;

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
     * The first line of the shipping address.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

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

    /**
     * The two-character ISO 3166-1 code of the country where the card should be shipped (e.g., `US`). Please reach out to [support@increase.com](mailto:support@increase.com) to ship cards internationally.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * The second line of the shipping address.
     */
    public function withLine2(string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }

    /**
     * The third line of the shipping address.
     */
    public function withLine3(string $line3): self
    {
        $self = clone $this;
        $self['line3'] = $line3;

        return $self;
    }

    /**
     * The phone number of the recipient.
     */
    public function withPhoneNumber(string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }
}

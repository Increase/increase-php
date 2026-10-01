<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestsForPaymentCreateParams\Debtor;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Address of the debtor.
 *
 * @phpstan-type AddressShape = array{
 *   country: string,
 *   addressLine2?: string|null,
 *   buildingNumber?: string|null,
 *   city?: string|null,
 *   postalCode?: string|null,
 *   state?: string|null,
 *   streetName?: string|null,
 * }
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
    use SdkModel;

    /**
     * The ISO 3166, Alpha-2 country code.
     *
     * Defaults to `US`.
     */
    #[Required]
    public string $country;

    /**
     * A second address line, such as an apartment or suite number. The first address line is separated into `building_number` and `street_name`.
     */
    #[Optional('address_line2')]
    public ?string $addressLine2;

    /**
     * The number identifying the position of the building on the street.
     */
    #[Optional('building_number')]
    public ?string $buildingNumber;

    /**
     * The town or city.
     */
    #[Optional]
    public ?string $city;

    /**
     * The postal code or zip.
     */
    #[Optional('postal_code')]
    public ?string $postalCode;

    /**
     * The US state component of the address.
     */
    #[Optional]
    public ?string $state;

    /**
     * The street name without the street number.
     */
    #[Optional('street_name')]
    public ?string $streetName;

    /**
     * `new Address()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Address::with(country: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Address)->withCountry(...)
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
        string $country = 'US',
        ?string $addressLine2 = null,
        ?string $buildingNumber = null,
        ?string $city = null,
        ?string $postalCode = null,
        ?string $state = null,
        ?string $streetName = null,
    ): self {
        $self = new self;

        $self['country'] = $country;

        null !== $addressLine2 && $self['addressLine2'] = $addressLine2;
        null !== $buildingNumber && $self['buildingNumber'] = $buildingNumber;
        null !== $city && $self['city'] = $city;
        null !== $postalCode && $self['postalCode'] = $postalCode;
        null !== $state && $self['state'] = $state;
        null !== $streetName && $self['streetName'] = $streetName;

        return $self;
    }

    /**
     * The ISO 3166, Alpha-2 country code.
     *
     * Defaults to `US`.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * A second address line, such as an apartment or suite number. The first address line is separated into `building_number` and `street_name`.
     */
    public function withAddressLine2(string $addressLine2): self
    {
        $self = clone $this;
        $self['addressLine2'] = $addressLine2;

        return $self;
    }

    /**
     * The number identifying the position of the building on the street.
     */
    public function withBuildingNumber(string $buildingNumber): self
    {
        $self = clone $this;
        $self['buildingNumber'] = $buildingNumber;

        return $self;
    }

    /**
     * The town or city.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The postal code or zip.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The US state component of the address.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The street name without the street number.
     */
    public function withStreetName(string $streetName): self
    {
        $self = clone $this;
        $self['streetName'] = $streetName;

        return $self;
    }
}

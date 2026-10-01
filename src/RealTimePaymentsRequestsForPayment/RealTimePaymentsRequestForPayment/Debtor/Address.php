<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment\Debtor;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Address of the debtor.
 *
 * @phpstan-type AddressShape = array{
 *   addressLine2: string|null,
 *   buildingNumber: string|null,
 *   city: string|null,
 *   country: string|null,
 *   postalCode: string|null,
 *   state: string|null,
 *   streetName: string|null,
 * }
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
    use SdkModel;

    /**
     * A second address line, such as an apartment or suite number. The first address line is separated into `building_number` and `street_name`.
     */
    #[Required('address_line2')]
    public ?string $addressLine2;

    /**
     * The number identifying the position of the building on the street.
     */
    #[Required('building_number')]
    public ?string $buildingNumber;

    /**
     * The town or city.
     */
    #[Required]
    public ?string $city;

    /**
     * The ISO 3166, Alpha-2 country code.
     */
    #[Required]
    public ?string $country;

    /**
     * The postal code or zip.
     */
    #[Required('postal_code')]
    public ?string $postalCode;

    /**
     * The US state component of the address.
     */
    #[Required]
    public ?string $state;

    /**
     * The street name without the street number.
     */
    #[Required('street_name')]
    public ?string $streetName;

    /**
     * `new Address()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Address::with(
     *   addressLine2: ...,
     *   buildingNumber: ...,
     *   city: ...,
     *   country: ...,
     *   postalCode: ...,
     *   state: ...,
     *   streetName: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Address)
     *   ->withAddressLine2(...)
     *   ->withBuildingNumber(...)
     *   ->withCity(...)
     *   ->withCountry(...)
     *   ->withPostalCode(...)
     *   ->withState(...)
     *   ->withStreetName(...)
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
        ?string $addressLine2,
        ?string $buildingNumber,
        ?string $city,
        ?string $country,
        ?string $postalCode,
        ?string $state,
        ?string $streetName,
    ): self {
        $self = new self;

        $self['addressLine2'] = $addressLine2;
        $self['buildingNumber'] = $buildingNumber;
        $self['city'] = $city;
        $self['country'] = $country;
        $self['postalCode'] = $postalCode;
        $self['state'] = $state;
        $self['streetName'] = $streetName;

        return $self;
    }

    /**
     * A second address line, such as an apartment or suite number. The first address line is separated into `building_number` and `street_name`.
     */
    public function withAddressLine2(?string $addressLine2): self
    {
        $self = clone $this;
        $self['addressLine2'] = $addressLine2;

        return $self;
    }

    /**
     * The number identifying the position of the building on the street.
     */
    public function withBuildingNumber(?string $buildingNumber): self
    {
        $self = clone $this;
        $self['buildingNumber'] = $buildingNumber;

        return $self;
    }

    /**
     * The town or city.
     */
    public function withCity(?string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The ISO 3166, Alpha-2 country code.
     */
    public function withCountry(?string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * The postal code or zip.
     */
    public function withPostalCode(?string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The US state component of the address.
     */
    public function withState(?string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The street name without the street number.
     */
    public function withStreetName(?string $streetName): self
    {
        $self = clone $this;
        $self['streetName'] = $streetName;

        return $self;
    }
}

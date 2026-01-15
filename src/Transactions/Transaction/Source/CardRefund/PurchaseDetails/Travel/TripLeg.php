<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardRefund\PurchaseDetails\Travel;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardRefund\PurchaseDetails\Travel\TripLeg\StopOverCode;

/**
 * @phpstan-type TripLegShape = array{
 *   carrierCode: string|null,
 *   destinationCityAirportCode: string|null,
 *   fareBasisCode: string|null,
 *   flightNumber: string|null,
 *   serviceClass: string|null,
 *   stopOverCode: null|StopOverCode|value-of<StopOverCode>,
 * }
 */
final class TripLeg implements BaseModel
{
    /** @use SdkModel<TripLegShape> */
    use SdkModel;

    /**
     * Carrier code (e.g., United Airlines, Jet Blue, etc.).
     */
    #[Required('carrier_code')]
    public ?string $carrierCode;

    /**
     * Code for the destination city or airport.
     */
    #[Required('destination_city_airport_code')]
    public ?string $destinationCityAirportCode;

    /**
     * Fare basis code.
     */
    #[Required('fare_basis_code')]
    public ?string $fareBasisCode;

    /**
     * Flight number.
     */
    #[Required('flight_number')]
    public ?string $flightNumber;

    /**
     * Service class (e.g., first class, business class, etc.).
     */
    #[Required('service_class')]
    public ?string $serviceClass;

    /**
     * Indicates whether a stopover is allowed on this ticket.
     *
     * @var value-of<StopOverCode>|null $stopOverCode
     */
    #[Required('stop_over_code', enum: StopOverCode::class)]
    public ?string $stopOverCode;

    /**
     * `new TripLeg()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TripLeg::with(
     *   carrierCode: ...,
     *   destinationCityAirportCode: ...,
     *   fareBasisCode: ...,
     *   flightNumber: ...,
     *   serviceClass: ...,
     *   stopOverCode: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TripLeg)
     *   ->withCarrierCode(...)
     *   ->withDestinationCityAirportCode(...)
     *   ->withFareBasisCode(...)
     *   ->withFlightNumber(...)
     *   ->withServiceClass(...)
     *   ->withStopOverCode(...)
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
     * @param StopOverCode|value-of<StopOverCode>|null $stopOverCode
     */
    public static function with(
        ?string $carrierCode,
        ?string $destinationCityAirportCode,
        ?string $fareBasisCode,
        ?string $flightNumber,
        ?string $serviceClass,
        StopOverCode|string|null $stopOverCode,
    ): self {
        $self = new self;

        $self['carrierCode'] = $carrierCode;
        $self['destinationCityAirportCode'] = $destinationCityAirportCode;
        $self['fareBasisCode'] = $fareBasisCode;
        $self['flightNumber'] = $flightNumber;
        $self['serviceClass'] = $serviceClass;
        $self['stopOverCode'] = $stopOverCode;

        return $self;
    }

    /**
     * Carrier code (e.g., United Airlines, Jet Blue, etc.).
     */
    public function withCarrierCode(?string $carrierCode): self
    {
        $self = clone $this;
        $self['carrierCode'] = $carrierCode;

        return $self;
    }

    /**
     * Code for the destination city or airport.
     */
    public function withDestinationCityAirportCode(
        ?string $destinationCityAirportCode
    ): self {
        $self = clone $this;
        $self['destinationCityAirportCode'] = $destinationCityAirportCode;

        return $self;
    }

    /**
     * Fare basis code.
     */
    public function withFareBasisCode(?string $fareBasisCode): self
    {
        $self = clone $this;
        $self['fareBasisCode'] = $fareBasisCode;

        return $self;
    }

    /**
     * Flight number.
     */
    public function withFlightNumber(?string $flightNumber): self
    {
        $self = clone $this;
        $self['flightNumber'] = $flightNumber;

        return $self;
    }

    /**
     * Service class (e.g., first class, business class, etc.).
     */
    public function withServiceClass(?string $serviceClass): self
    {
        $self = clone $this;
        $self['serviceClass'] = $serviceClass;

        return $self;
    }

    /**
     * Indicates whether a stopover is allowed on this ticket.
     *
     * @param StopOverCode|value-of<StopOverCode>|null $stopOverCode
     */
    public function withStopOverCode(
        StopOverCode|string|null $stopOverCode
    ): self {
        $self = clone $this;
        $self['stopOverCode'] = $stopOverCode;

        return $self;
    }
}

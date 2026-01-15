<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails\Travel\Ancillary;
use Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails\Travel\CreditReasonIndicator;
use Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails\Travel\RestrictedTicketIndicator;
use Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails\Travel\TicketChangeIndicator;
use Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails\Travel\TripLeg;

/**
 * Fields specific to travel.
 *
 * @phpstan-import-type AncillaryShape from \Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails\Travel\Ancillary
 * @phpstan-import-type TripLegShape from \Increase\Transactions\Transaction\Source\CardSettlement\PurchaseDetails\Travel\TripLeg
 *
 * @phpstan-type TravelShape = array{
 *   ancillary: null|Ancillary|AncillaryShape,
 *   computerizedReservationSystem: string|null,
 *   creditReasonIndicator: null|CreditReasonIndicator|value-of<CreditReasonIndicator>,
 *   departureDate: string|null,
 *   originationCityAirportCode: string|null,
 *   passengerName: string|null,
 *   restrictedTicketIndicator: null|RestrictedTicketIndicator|value-of<RestrictedTicketIndicator>,
 *   ticketChangeIndicator: null|TicketChangeIndicator|value-of<TicketChangeIndicator>,
 *   ticketNumber: string|null,
 *   travelAgencyCode: string|null,
 *   travelAgencyName: string|null,
 *   tripLegs: list<TripLeg|TripLegShape>|null,
 * }
 */
final class Travel implements BaseModel
{
    /** @use SdkModel<TravelShape> */
    use SdkModel;

    /**
     * Ancillary purchases in addition to the airfare.
     */
    #[Required]
    public ?Ancillary $ancillary;

    /**
     * Indicates the computerized reservation system used to book the ticket.
     */
    #[Required('computerized_reservation_system')]
    public ?string $computerizedReservationSystem;

    /**
     * Indicates the reason for a credit to the cardholder.
     *
     * @var value-of<CreditReasonIndicator>|null $creditReasonIndicator
     */
    #[Required('credit_reason_indicator', enum: CreditReasonIndicator::class)]
    public ?string $creditReasonIndicator;

    /**
     * Date of departure.
     */
    #[Required('departure_date')]
    public ?string $departureDate;

    /**
     * Code for the originating city or airport.
     */
    #[Required('origination_city_airport_code')]
    public ?string $originationCityAirportCode;

    /**
     * Name of the passenger.
     */
    #[Required('passenger_name')]
    public ?string $passengerName;

    /**
     * Indicates whether this ticket is non-refundable.
     *
     * @var value-of<RestrictedTicketIndicator>|null $restrictedTicketIndicator
     */
    #[Required(
        'restricted_ticket_indicator',
        enum: RestrictedTicketIndicator::class
    )]
    public ?string $restrictedTicketIndicator;

    /**
     * Indicates why a ticket was changed.
     *
     * @var value-of<TicketChangeIndicator>|null $ticketChangeIndicator
     */
    #[Required('ticket_change_indicator', enum: TicketChangeIndicator::class)]
    public ?string $ticketChangeIndicator;

    /**
     * Ticket number.
     */
    #[Required('ticket_number')]
    public ?string $ticketNumber;

    /**
     * Code for the travel agency if the ticket was issued by a travel agency.
     */
    #[Required('travel_agency_code')]
    public ?string $travelAgencyCode;

    /**
     * Name of the travel agency if the ticket was issued by a travel agency.
     */
    #[Required('travel_agency_name')]
    public ?string $travelAgencyName;

    /**
     * Fields specific to each leg of the journey.
     *
     * @var list<TripLeg>|null $tripLegs
     */
    #[Required('trip_legs', list: TripLeg::class)]
    public ?array $tripLegs;

    /**
     * `new Travel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Travel::with(
     *   ancillary: ...,
     *   computerizedReservationSystem: ...,
     *   creditReasonIndicator: ...,
     *   departureDate: ...,
     *   originationCityAirportCode: ...,
     *   passengerName: ...,
     *   restrictedTicketIndicator: ...,
     *   ticketChangeIndicator: ...,
     *   ticketNumber: ...,
     *   travelAgencyCode: ...,
     *   travelAgencyName: ...,
     *   tripLegs: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Travel)
     *   ->withAncillary(...)
     *   ->withComputerizedReservationSystem(...)
     *   ->withCreditReasonIndicator(...)
     *   ->withDepartureDate(...)
     *   ->withOriginationCityAirportCode(...)
     *   ->withPassengerName(...)
     *   ->withRestrictedTicketIndicator(...)
     *   ->withTicketChangeIndicator(...)
     *   ->withTicketNumber(...)
     *   ->withTravelAgencyCode(...)
     *   ->withTravelAgencyName(...)
     *   ->withTripLegs(...)
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
     * @param Ancillary|AncillaryShape|null $ancillary
     * @param CreditReasonIndicator|value-of<CreditReasonIndicator>|null $creditReasonIndicator
     * @param RestrictedTicketIndicator|value-of<RestrictedTicketIndicator>|null $restrictedTicketIndicator
     * @param TicketChangeIndicator|value-of<TicketChangeIndicator>|null $ticketChangeIndicator
     * @param list<TripLeg|TripLegShape>|null $tripLegs
     */
    public static function with(
        Ancillary|array|null $ancillary,
        ?string $computerizedReservationSystem,
        CreditReasonIndicator|string|null $creditReasonIndicator,
        ?string $departureDate,
        ?string $originationCityAirportCode,
        ?string $passengerName,
        RestrictedTicketIndicator|string|null $restrictedTicketIndicator,
        TicketChangeIndicator|string|null $ticketChangeIndicator,
        ?string $ticketNumber,
        ?string $travelAgencyCode,
        ?string $travelAgencyName,
        ?array $tripLegs,
    ): self {
        $self = new self;

        $self['ancillary'] = $ancillary;
        $self['computerizedReservationSystem'] = $computerizedReservationSystem;
        $self['creditReasonIndicator'] = $creditReasonIndicator;
        $self['departureDate'] = $departureDate;
        $self['originationCityAirportCode'] = $originationCityAirportCode;
        $self['passengerName'] = $passengerName;
        $self['restrictedTicketIndicator'] = $restrictedTicketIndicator;
        $self['ticketChangeIndicator'] = $ticketChangeIndicator;
        $self['ticketNumber'] = $ticketNumber;
        $self['travelAgencyCode'] = $travelAgencyCode;
        $self['travelAgencyName'] = $travelAgencyName;
        $self['tripLegs'] = $tripLegs;

        return $self;
    }

    /**
     * Ancillary purchases in addition to the airfare.
     *
     * @param Ancillary|AncillaryShape|null $ancillary
     */
    public function withAncillary(Ancillary|array|null $ancillary): self
    {
        $self = clone $this;
        $self['ancillary'] = $ancillary;

        return $self;
    }

    /**
     * Indicates the computerized reservation system used to book the ticket.
     */
    public function withComputerizedReservationSystem(
        ?string $computerizedReservationSystem
    ): self {
        $self = clone $this;
        $self['computerizedReservationSystem'] = $computerizedReservationSystem;

        return $self;
    }

    /**
     * Indicates the reason for a credit to the cardholder.
     *
     * @param CreditReasonIndicator|value-of<CreditReasonIndicator>|null $creditReasonIndicator
     */
    public function withCreditReasonIndicator(
        CreditReasonIndicator|string|null $creditReasonIndicator
    ): self {
        $self = clone $this;
        $self['creditReasonIndicator'] = $creditReasonIndicator;

        return $self;
    }

    /**
     * Date of departure.
     */
    public function withDepartureDate(?string $departureDate): self
    {
        $self = clone $this;
        $self['departureDate'] = $departureDate;

        return $self;
    }

    /**
     * Code for the originating city or airport.
     */
    public function withOriginationCityAirportCode(
        ?string $originationCityAirportCode
    ): self {
        $self = clone $this;
        $self['originationCityAirportCode'] = $originationCityAirportCode;

        return $self;
    }

    /**
     * Name of the passenger.
     */
    public function withPassengerName(?string $passengerName): self
    {
        $self = clone $this;
        $self['passengerName'] = $passengerName;

        return $self;
    }

    /**
     * Indicates whether this ticket is non-refundable.
     *
     * @param RestrictedTicketIndicator|value-of<RestrictedTicketIndicator>|null $restrictedTicketIndicator
     */
    public function withRestrictedTicketIndicator(
        RestrictedTicketIndicator|string|null $restrictedTicketIndicator
    ): self {
        $self = clone $this;
        $self['restrictedTicketIndicator'] = $restrictedTicketIndicator;

        return $self;
    }

    /**
     * Indicates why a ticket was changed.
     *
     * @param TicketChangeIndicator|value-of<TicketChangeIndicator>|null $ticketChangeIndicator
     */
    public function withTicketChangeIndicator(
        TicketChangeIndicator|string|null $ticketChangeIndicator
    ): self {
        $self = clone $this;
        $self['ticketChangeIndicator'] = $ticketChangeIndicator;

        return $self;
    }

    /**
     * Ticket number.
     */
    public function withTicketNumber(?string $ticketNumber): self
    {
        $self = clone $this;
        $self['ticketNumber'] = $ticketNumber;

        return $self;
    }

    /**
     * Code for the travel agency if the ticket was issued by a travel agency.
     */
    public function withTravelAgencyCode(?string $travelAgencyCode): self
    {
        $self = clone $this;
        $self['travelAgencyCode'] = $travelAgencyCode;

        return $self;
    }

    /**
     * Name of the travel agency if the ticket was issued by a travel agency.
     */
    public function withTravelAgencyName(?string $travelAgencyName): self
    {
        $self = clone $this;
        $self['travelAgencyName'] = $travelAgencyName;

        return $self;
    }

    /**
     * Fields specific to each leg of the journey.
     *
     * @param list<TripLeg|TripLegShape>|null $tripLegs
     */
    public function withTripLegs(?array $tripLegs): self
    {
        $self = clone $this;
        $self['tripLegs'] = $tripLegs;

        return $self;
    }
}

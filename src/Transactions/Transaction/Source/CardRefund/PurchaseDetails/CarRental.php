<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardRefund\PurchaseDetails;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardRefund\PurchaseDetails\CarRental\ExtraCharges;
use Increase\Transactions\Transaction\Source\CardRefund\PurchaseDetails\CarRental\NoShowIndicator;

/**
 * Fields specific to car rentals.
 *
 * @phpstan-type CarRentalShape = array{
 *   carClassCode: string|null,
 *   checkoutDate: string|null,
 *   dailyRentalRateAmount: int|null,
 *   dailyRentalRateCurrency: string|null,
 *   daysRented: int|null,
 *   extraCharges: null|ExtraCharges|value-of<ExtraCharges>,
 *   fuelChargesAmount: int|null,
 *   fuelChargesCurrency: string|null,
 *   insuranceChargesAmount: int|null,
 *   insuranceChargesCurrency: string|null,
 *   noShowIndicator: null|NoShowIndicator|value-of<NoShowIndicator>,
 *   oneWayDropOffChargesAmount: int|null,
 *   oneWayDropOffChargesCurrency: string|null,
 *   renterName: string|null,
 *   weeklyRentalRateAmount: int|null,
 *   weeklyRentalRateCurrency: string|null,
 * }
 */
final class CarRental implements BaseModel
{
    /** @use SdkModel<CarRentalShape> */
    use SdkModel;

    /**
     * Code indicating the vehicle's class.
     */
    #[Required('car_class_code')]
    public ?string $carClassCode;

    /**
     * Date the customer picked up the car or, in the case of a no-show or pre-pay transaction, the scheduled pick up date.
     */
    #[Required('checkout_date')]
    public ?string $checkoutDate;

    /**
     * Daily rate being charged for the vehicle.
     */
    #[Required('daily_rental_rate_amount')]
    public ?int $dailyRentalRateAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the daily rental rate.
     */
    #[Required('daily_rental_rate_currency')]
    public ?string $dailyRentalRateCurrency;

    /**
     * Number of days the vehicle was rented.
     */
    #[Required('days_rented')]
    public ?int $daysRented;

    /**
     * Additional charges (gas, late fee, etc.) being billed.
     *
     * @var value-of<ExtraCharges>|null $extraCharges
     */
    #[Required('extra_charges', enum: ExtraCharges::class)]
    public ?string $extraCharges;

    /**
     * Fuel charges for the vehicle.
     */
    #[Required('fuel_charges_amount')]
    public ?int $fuelChargesAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the fuel charges assessed.
     */
    #[Required('fuel_charges_currency')]
    public ?string $fuelChargesCurrency;

    /**
     * Any insurance being charged for the vehicle.
     */
    #[Required('insurance_charges_amount')]
    public ?int $insuranceChargesAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the insurance charges assessed.
     */
    #[Required('insurance_charges_currency')]
    public ?string $insuranceChargesCurrency;

    /**
     * An indicator that the cardholder is being billed for a reserved vehicle that was not actually rented (that is, a "no-show" charge).
     *
     * @var value-of<NoShowIndicator>|null $noShowIndicator
     */
    #[Required('no_show_indicator', enum: NoShowIndicator::class)]
    public ?string $noShowIndicator;

    /**
     * Charges for returning the vehicle at a different location than where it was picked up.
     */
    #[Required('one_way_drop_off_charges_amount')]
    public ?int $oneWayDropOffChargesAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the one-way drop-off charges assessed.
     */
    #[Required('one_way_drop_off_charges_currency')]
    public ?string $oneWayDropOffChargesCurrency;

    /**
     * Name of the person renting the vehicle.
     */
    #[Required('renter_name')]
    public ?string $renterName;

    /**
     * Weekly rate being charged for the vehicle.
     */
    #[Required('weekly_rental_rate_amount')]
    public ?int $weeklyRentalRateAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the weekly rental rate.
     */
    #[Required('weekly_rental_rate_currency')]
    public ?string $weeklyRentalRateCurrency;

    /**
     * `new CarRental()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CarRental::with(
     *   carClassCode: ...,
     *   checkoutDate: ...,
     *   dailyRentalRateAmount: ...,
     *   dailyRentalRateCurrency: ...,
     *   daysRented: ...,
     *   extraCharges: ...,
     *   fuelChargesAmount: ...,
     *   fuelChargesCurrency: ...,
     *   insuranceChargesAmount: ...,
     *   insuranceChargesCurrency: ...,
     *   noShowIndicator: ...,
     *   oneWayDropOffChargesAmount: ...,
     *   oneWayDropOffChargesCurrency: ...,
     *   renterName: ...,
     *   weeklyRentalRateAmount: ...,
     *   weeklyRentalRateCurrency: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CarRental)
     *   ->withCarClassCode(...)
     *   ->withCheckoutDate(...)
     *   ->withDailyRentalRateAmount(...)
     *   ->withDailyRentalRateCurrency(...)
     *   ->withDaysRented(...)
     *   ->withExtraCharges(...)
     *   ->withFuelChargesAmount(...)
     *   ->withFuelChargesCurrency(...)
     *   ->withInsuranceChargesAmount(...)
     *   ->withInsuranceChargesCurrency(...)
     *   ->withNoShowIndicator(...)
     *   ->withOneWayDropOffChargesAmount(...)
     *   ->withOneWayDropOffChargesCurrency(...)
     *   ->withRenterName(...)
     *   ->withWeeklyRentalRateAmount(...)
     *   ->withWeeklyRentalRateCurrency(...)
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
     * @param ExtraCharges|value-of<ExtraCharges>|null $extraCharges
     * @param NoShowIndicator|value-of<NoShowIndicator>|null $noShowIndicator
     */
    public static function with(
        ?string $carClassCode,
        ?string $checkoutDate,
        ?int $dailyRentalRateAmount,
        ?string $dailyRentalRateCurrency,
        ?int $daysRented,
        ExtraCharges|string|null $extraCharges,
        ?int $fuelChargesAmount,
        ?string $fuelChargesCurrency,
        ?int $insuranceChargesAmount,
        ?string $insuranceChargesCurrency,
        NoShowIndicator|string|null $noShowIndicator,
        ?int $oneWayDropOffChargesAmount,
        ?string $oneWayDropOffChargesCurrency,
        ?string $renterName,
        ?int $weeklyRentalRateAmount,
        ?string $weeklyRentalRateCurrency,
    ): self {
        $self = new self;

        $self['carClassCode'] = $carClassCode;
        $self['checkoutDate'] = $checkoutDate;
        $self['dailyRentalRateAmount'] = $dailyRentalRateAmount;
        $self['dailyRentalRateCurrency'] = $dailyRentalRateCurrency;
        $self['daysRented'] = $daysRented;
        $self['extraCharges'] = $extraCharges;
        $self['fuelChargesAmount'] = $fuelChargesAmount;
        $self['fuelChargesCurrency'] = $fuelChargesCurrency;
        $self['insuranceChargesAmount'] = $insuranceChargesAmount;
        $self['insuranceChargesCurrency'] = $insuranceChargesCurrency;
        $self['noShowIndicator'] = $noShowIndicator;
        $self['oneWayDropOffChargesAmount'] = $oneWayDropOffChargesAmount;
        $self['oneWayDropOffChargesCurrency'] = $oneWayDropOffChargesCurrency;
        $self['renterName'] = $renterName;
        $self['weeklyRentalRateAmount'] = $weeklyRentalRateAmount;
        $self['weeklyRentalRateCurrency'] = $weeklyRentalRateCurrency;

        return $self;
    }

    /**
     * Code indicating the vehicle's class.
     */
    public function withCarClassCode(?string $carClassCode): self
    {
        $self = clone $this;
        $self['carClassCode'] = $carClassCode;

        return $self;
    }

    /**
     * Date the customer picked up the car or, in the case of a no-show or pre-pay transaction, the scheduled pick up date.
     */
    public function withCheckoutDate(?string $checkoutDate): self
    {
        $self = clone $this;
        $self['checkoutDate'] = $checkoutDate;

        return $self;
    }

    /**
     * Daily rate being charged for the vehicle.
     */
    public function withDailyRentalRateAmount(?int $dailyRentalRateAmount): self
    {
        $self = clone $this;
        $self['dailyRentalRateAmount'] = $dailyRentalRateAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the daily rental rate.
     */
    public function withDailyRentalRateCurrency(
        ?string $dailyRentalRateCurrency
    ): self {
        $self = clone $this;
        $self['dailyRentalRateCurrency'] = $dailyRentalRateCurrency;

        return $self;
    }

    /**
     * Number of days the vehicle was rented.
     */
    public function withDaysRented(?int $daysRented): self
    {
        $self = clone $this;
        $self['daysRented'] = $daysRented;

        return $self;
    }

    /**
     * Additional charges (gas, late fee, etc.) being billed.
     *
     * @param ExtraCharges|value-of<ExtraCharges>|null $extraCharges
     */
    public function withExtraCharges(
        ExtraCharges|string|null $extraCharges
    ): self {
        $self = clone $this;
        $self['extraCharges'] = $extraCharges;

        return $self;
    }

    /**
     * Fuel charges for the vehicle.
     */
    public function withFuelChargesAmount(?int $fuelChargesAmount): self
    {
        $self = clone $this;
        $self['fuelChargesAmount'] = $fuelChargesAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the fuel charges assessed.
     */
    public function withFuelChargesCurrency(?string $fuelChargesCurrency): self
    {
        $self = clone $this;
        $self['fuelChargesCurrency'] = $fuelChargesCurrency;

        return $self;
    }

    /**
     * Any insurance being charged for the vehicle.
     */
    public function withInsuranceChargesAmount(
        ?int $insuranceChargesAmount
    ): self {
        $self = clone $this;
        $self['insuranceChargesAmount'] = $insuranceChargesAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the insurance charges assessed.
     */
    public function withInsuranceChargesCurrency(
        ?string $insuranceChargesCurrency
    ): self {
        $self = clone $this;
        $self['insuranceChargesCurrency'] = $insuranceChargesCurrency;

        return $self;
    }

    /**
     * An indicator that the cardholder is being billed for a reserved vehicle that was not actually rented (that is, a "no-show" charge).
     *
     * @param NoShowIndicator|value-of<NoShowIndicator>|null $noShowIndicator
     */
    public function withNoShowIndicator(
        NoShowIndicator|string|null $noShowIndicator
    ): self {
        $self = clone $this;
        $self['noShowIndicator'] = $noShowIndicator;

        return $self;
    }

    /**
     * Charges for returning the vehicle at a different location than where it was picked up.
     */
    public function withOneWayDropOffChargesAmount(
        ?int $oneWayDropOffChargesAmount
    ): self {
        $self = clone $this;
        $self['oneWayDropOffChargesAmount'] = $oneWayDropOffChargesAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the one-way drop-off charges assessed.
     */
    public function withOneWayDropOffChargesCurrency(
        ?string $oneWayDropOffChargesCurrency
    ): self {
        $self = clone $this;
        $self['oneWayDropOffChargesCurrency'] = $oneWayDropOffChargesCurrency;

        return $self;
    }

    /**
     * Name of the person renting the vehicle.
     */
    public function withRenterName(?string $renterName): self
    {
        $self = clone $this;
        $self['renterName'] = $renterName;

        return $self;
    }

    /**
     * Weekly rate being charged for the vehicle.
     */
    public function withWeeklyRentalRateAmount(
        ?int $weeklyRentalRateAmount
    ): self {
        $self = clone $this;
        $self['weeklyRentalRateAmount'] = $weeklyRentalRateAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the weekly rental rate.
     */
    public function withWeeklyRentalRateCurrency(
        ?string $weeklyRentalRateCurrency
    ): self {
        $self = clone $this;
        $self['weeklyRentalRateCurrency'] = $weeklyRentalRateCurrency;

        return $self;
    }
}

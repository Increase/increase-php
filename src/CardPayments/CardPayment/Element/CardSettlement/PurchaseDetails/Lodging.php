<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails;

use Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Lodging\ExtraCharges;
use Increase\CardPayments\CardPayment\Element\CardSettlement\PurchaseDetails\Lodging\NoShowIndicator;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Fields specific to lodging.
 *
 * @phpstan-type LodgingShape = array{
 *   checkInDate: string|null,
 *   dailyRoomRateAmount: int|null,
 *   dailyRoomRateCurrency: string|null,
 *   extraCharges: null|ExtraCharges|value-of<ExtraCharges>,
 *   folioCashAdvancesAmount: int|null,
 *   folioCashAdvancesCurrency: string|null,
 *   foodBeverageChargesAmount: int|null,
 *   foodBeverageChargesCurrency: string|null,
 *   noShowIndicator: null|NoShowIndicator|value-of<NoShowIndicator>,
 *   prepaidExpensesAmount: int|null,
 *   prepaidExpensesCurrency: string|null,
 *   roomNights: int|null,
 *   totalRoomTaxAmount: int|null,
 *   totalRoomTaxCurrency: string|null,
 *   totalTaxAmount: int|null,
 *   totalTaxCurrency: string|null,
 * }
 */
final class Lodging implements BaseModel
{
    /** @use SdkModel<LodgingShape> */
    use SdkModel;

    /**
     * Date the customer checked in.
     */
    #[Required('check_in_date')]
    public ?string $checkInDate;

    /**
     * Daily rate being charged for the room.
     */
    #[Required('daily_room_rate_amount')]
    public ?int $dailyRoomRateAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the daily room rate.
     */
    #[Required('daily_room_rate_currency')]
    public ?string $dailyRoomRateCurrency;

    /**
     * Additional charges (phone, late check-out, etc.) being billed.
     *
     * @var value-of<ExtraCharges>|null $extraCharges
     */
    #[Required('extra_charges', enum: ExtraCharges::class)]
    public ?string $extraCharges;

    /**
     * Folio cash advances for the room.
     */
    #[Required('folio_cash_advances_amount')]
    public ?int $folioCashAdvancesAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the folio cash advances.
     */
    #[Required('folio_cash_advances_currency')]
    public ?string $folioCashAdvancesCurrency;

    /**
     * Food and beverage charges for the room.
     */
    #[Required('food_beverage_charges_amount')]
    public ?int $foodBeverageChargesAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the food and beverage charges.
     */
    #[Required('food_beverage_charges_currency')]
    public ?string $foodBeverageChargesCurrency;

    /**
     * Indicator that the cardholder is being billed for a reserved room that was not actually used.
     *
     * @var value-of<NoShowIndicator>|null $noShowIndicator
     */
    #[Required('no_show_indicator', enum: NoShowIndicator::class)]
    public ?string $noShowIndicator;

    /**
     * Prepaid expenses being charged for the room.
     */
    #[Required('prepaid_expenses_amount')]
    public ?int $prepaidExpensesAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the prepaid expenses.
     */
    #[Required('prepaid_expenses_currency')]
    public ?string $prepaidExpensesCurrency;

    /**
     * Number of nights the room was rented.
     */
    #[Required('room_nights')]
    public ?int $roomNights;

    /**
     * Total room tax being charged.
     */
    #[Required('total_room_tax_amount')]
    public ?int $totalRoomTaxAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the total room tax.
     */
    #[Required('total_room_tax_currency')]
    public ?string $totalRoomTaxCurrency;

    /**
     * Total tax being charged for the room.
     */
    #[Required('total_tax_amount')]
    public ?int $totalTaxAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the total tax assessed.
     */
    #[Required('total_tax_currency')]
    public ?string $totalTaxCurrency;

    /**
     * `new Lodging()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Lodging::with(
     *   checkInDate: ...,
     *   dailyRoomRateAmount: ...,
     *   dailyRoomRateCurrency: ...,
     *   extraCharges: ...,
     *   folioCashAdvancesAmount: ...,
     *   folioCashAdvancesCurrency: ...,
     *   foodBeverageChargesAmount: ...,
     *   foodBeverageChargesCurrency: ...,
     *   noShowIndicator: ...,
     *   prepaidExpensesAmount: ...,
     *   prepaidExpensesCurrency: ...,
     *   roomNights: ...,
     *   totalRoomTaxAmount: ...,
     *   totalRoomTaxCurrency: ...,
     *   totalTaxAmount: ...,
     *   totalTaxCurrency: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Lodging)
     *   ->withCheckInDate(...)
     *   ->withDailyRoomRateAmount(...)
     *   ->withDailyRoomRateCurrency(...)
     *   ->withExtraCharges(...)
     *   ->withFolioCashAdvancesAmount(...)
     *   ->withFolioCashAdvancesCurrency(...)
     *   ->withFoodBeverageChargesAmount(...)
     *   ->withFoodBeverageChargesCurrency(...)
     *   ->withNoShowIndicator(...)
     *   ->withPrepaidExpensesAmount(...)
     *   ->withPrepaidExpensesCurrency(...)
     *   ->withRoomNights(...)
     *   ->withTotalRoomTaxAmount(...)
     *   ->withTotalRoomTaxCurrency(...)
     *   ->withTotalTaxAmount(...)
     *   ->withTotalTaxCurrency(...)
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
        ?string $checkInDate,
        ?int $dailyRoomRateAmount,
        ?string $dailyRoomRateCurrency,
        ExtraCharges|string|null $extraCharges,
        ?int $folioCashAdvancesAmount,
        ?string $folioCashAdvancesCurrency,
        ?int $foodBeverageChargesAmount,
        ?string $foodBeverageChargesCurrency,
        NoShowIndicator|string|null $noShowIndicator,
        ?int $prepaidExpensesAmount,
        ?string $prepaidExpensesCurrency,
        ?int $roomNights,
        ?int $totalRoomTaxAmount,
        ?string $totalRoomTaxCurrency,
        ?int $totalTaxAmount,
        ?string $totalTaxCurrency,
    ): self {
        $self = new self;

        $self['checkInDate'] = $checkInDate;
        $self['dailyRoomRateAmount'] = $dailyRoomRateAmount;
        $self['dailyRoomRateCurrency'] = $dailyRoomRateCurrency;
        $self['extraCharges'] = $extraCharges;
        $self['folioCashAdvancesAmount'] = $folioCashAdvancesAmount;
        $self['folioCashAdvancesCurrency'] = $folioCashAdvancesCurrency;
        $self['foodBeverageChargesAmount'] = $foodBeverageChargesAmount;
        $self['foodBeverageChargesCurrency'] = $foodBeverageChargesCurrency;
        $self['noShowIndicator'] = $noShowIndicator;
        $self['prepaidExpensesAmount'] = $prepaidExpensesAmount;
        $self['prepaidExpensesCurrency'] = $prepaidExpensesCurrency;
        $self['roomNights'] = $roomNights;
        $self['totalRoomTaxAmount'] = $totalRoomTaxAmount;
        $self['totalRoomTaxCurrency'] = $totalRoomTaxCurrency;
        $self['totalTaxAmount'] = $totalTaxAmount;
        $self['totalTaxCurrency'] = $totalTaxCurrency;

        return $self;
    }

    /**
     * Date the customer checked in.
     */
    public function withCheckInDate(?string $checkInDate): self
    {
        $self = clone $this;
        $self['checkInDate'] = $checkInDate;

        return $self;
    }

    /**
     * Daily rate being charged for the room.
     */
    public function withDailyRoomRateAmount(?int $dailyRoomRateAmount): self
    {
        $self = clone $this;
        $self['dailyRoomRateAmount'] = $dailyRoomRateAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the daily room rate.
     */
    public function withDailyRoomRateCurrency(
        ?string $dailyRoomRateCurrency
    ): self {
        $self = clone $this;
        $self['dailyRoomRateCurrency'] = $dailyRoomRateCurrency;

        return $self;
    }

    /**
     * Additional charges (phone, late check-out, etc.) being billed.
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
     * Folio cash advances for the room.
     */
    public function withFolioCashAdvancesAmount(
        ?int $folioCashAdvancesAmount
    ): self {
        $self = clone $this;
        $self['folioCashAdvancesAmount'] = $folioCashAdvancesAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the folio cash advances.
     */
    public function withFolioCashAdvancesCurrency(
        ?string $folioCashAdvancesCurrency
    ): self {
        $self = clone $this;
        $self['folioCashAdvancesCurrency'] = $folioCashAdvancesCurrency;

        return $self;
    }

    /**
     * Food and beverage charges for the room.
     */
    public function withFoodBeverageChargesAmount(
        ?int $foodBeverageChargesAmount
    ): self {
        $self = clone $this;
        $self['foodBeverageChargesAmount'] = $foodBeverageChargesAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the food and beverage charges.
     */
    public function withFoodBeverageChargesCurrency(
        ?string $foodBeverageChargesCurrency
    ): self {
        $self = clone $this;
        $self['foodBeverageChargesCurrency'] = $foodBeverageChargesCurrency;

        return $self;
    }

    /**
     * Indicator that the cardholder is being billed for a reserved room that was not actually used.
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
     * Prepaid expenses being charged for the room.
     */
    public function withPrepaidExpensesAmount(?int $prepaidExpensesAmount): self
    {
        $self = clone $this;
        $self['prepaidExpensesAmount'] = $prepaidExpensesAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the prepaid expenses.
     */
    public function withPrepaidExpensesCurrency(
        ?string $prepaidExpensesCurrency
    ): self {
        $self = clone $this;
        $self['prepaidExpensesCurrency'] = $prepaidExpensesCurrency;

        return $self;
    }

    /**
     * Number of nights the room was rented.
     */
    public function withRoomNights(?int $roomNights): self
    {
        $self = clone $this;
        $self['roomNights'] = $roomNights;

        return $self;
    }

    /**
     * Total room tax being charged.
     */
    public function withTotalRoomTaxAmount(?int $totalRoomTaxAmount): self
    {
        $self = clone $this;
        $self['totalRoomTaxAmount'] = $totalRoomTaxAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the total room tax.
     */
    public function withTotalRoomTaxCurrency(
        ?string $totalRoomTaxCurrency
    ): self {
        $self = clone $this;
        $self['totalRoomTaxCurrency'] = $totalRoomTaxCurrency;

        return $self;
    }

    /**
     * Total tax being charged for the room.
     */
    public function withTotalTaxAmount(?int $totalTaxAmount): self
    {
        $self = clone $this;
        $self['totalTaxAmount'] = $totalTaxAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the total tax assessed.
     */
    public function withTotalTaxCurrency(?string $totalTaxCurrency): self
    {
        $self = clone $this;
        $self['totalTaxCurrency'] = $totalTaxCurrency;

        return $self;
    }
}

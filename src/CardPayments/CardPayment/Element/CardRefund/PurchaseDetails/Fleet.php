<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails;

use Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\Fleet\FuelType;
use Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\Fleet\FuelUnitOfMeasure;
use Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\Fleet\PurchaseType;
use Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\Fleet\ServiceType;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Fields specific to fleet purchases.
 *
 * @phpstan-type FleetShape = array{
 *   employeeNumber: string|null,
 *   fuelQuantity: string|null,
 *   fuelType: null|FuelType|value-of<FuelType>,
 *   fuelUnitCostAmount: int|null,
 *   fuelUnitCostCurrency: string|null,
 *   fuelUnitOfMeasure: null|FuelUnitOfMeasure|value-of<FuelUnitOfMeasure>,
 *   grossFuelPriceAmount: int|null,
 *   grossFuelPriceCurrency: string|null,
 *   grossNonFuelPriceAmount: int|null,
 *   grossNonFuelPriceCurrency: string|null,
 *   netFuelPriceAmount: int|null,
 *   netFuelPriceCurrency: string|null,
 *   netNonFuelPriceAmount: int|null,
 *   netNonFuelPriceCurrency: string|null,
 *   odometerReading: int|null,
 *   purchaseType: null|PurchaseType|value-of<PurchaseType>,
 *   serviceType: null|ServiceType|value-of<ServiceType>,
 *   trailerNumber: string|null,
 * }
 */
final class Fleet implements BaseModel
{
    /** @use SdkModel<FleetShape> */
    use SdkModel;

    /**
     * The fleet employee number.
     */
    #[Required('employee_number')]
    public ?string $employeeNumber;

    /**
     * The quantity of fuel purchased, given as a string containing a decimal number in the indicated unit of measure.
     */
    #[Required('fuel_quantity')]
    public ?string $fuelQuantity;

    /**
     * The type of fuel purchased.
     *
     * @var value-of<FuelType>|null $fuelType
     */
    #[Required('fuel_type', enum: FuelType::class)]
    public ?string $fuelType;

    /**
     * The cost per unit of fuel in minor units.
     */
    #[Required('fuel_unit_cost_amount')]
    public ?int $fuelUnitCostAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the fuel unit cost.
     */
    #[Required('fuel_unit_cost_currency')]
    public ?string $fuelUnitCostCurrency;

    /**
     * The unit of measure for the fuel quantity.
     *
     * @var value-of<FuelUnitOfMeasure>|null $fuelUnitOfMeasure
     */
    #[Required('fuel_unit_of_measure', enum: FuelUnitOfMeasure::class)]
    public ?string $fuelUnitOfMeasure;

    /**
     * The gross fuel price in minor units.
     */
    #[Required('gross_fuel_price_amount')]
    public ?int $grossFuelPriceAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the gross fuel price.
     */
    #[Required('gross_fuel_price_currency')]
    public ?string $grossFuelPriceCurrency;

    /**
     * The gross non-fuel price in minor units.
     */
    #[Required('gross_non_fuel_price_amount')]
    public ?int $grossNonFuelPriceAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the gross non-fuel price.
     */
    #[Required('gross_non_fuel_price_currency')]
    public ?string $grossNonFuelPriceCurrency;

    /**
     * The net fuel price in minor units.
     */
    #[Required('net_fuel_price_amount')]
    public ?int $netFuelPriceAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the net fuel price.
     */
    #[Required('net_fuel_price_currency')]
    public ?string $netFuelPriceCurrency;

    /**
     * The net non-fuel price in minor units.
     */
    #[Required('net_non_fuel_price_amount')]
    public ?int $netNonFuelPriceAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the net non-fuel price.
     */
    #[Required('net_non_fuel_price_currency')]
    public ?string $netNonFuelPriceCurrency;

    /**
     * The odometer reading reported by the merchant.
     */
    #[Required('odometer_reading')]
    public ?int $odometerReading;

    /**
     * The type of fleet purchase.
     *
     * @var value-of<PurchaseType>|null $purchaseType
     */
    #[Required('purchase_type', enum: PurchaseType::class)]
    public ?string $purchaseType;

    /**
     * The type of service provided.
     *
     * @var value-of<ServiceType>|null $serviceType
     */
    #[Required('service_type', enum: ServiceType::class)]
    public ?string $serviceType;

    /**
     * The fleet trailer number.
     */
    #[Required('trailer_number')]
    public ?string $trailerNumber;

    /**
     * `new Fleet()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Fleet::with(
     *   employeeNumber: ...,
     *   fuelQuantity: ...,
     *   fuelType: ...,
     *   fuelUnitCostAmount: ...,
     *   fuelUnitCostCurrency: ...,
     *   fuelUnitOfMeasure: ...,
     *   grossFuelPriceAmount: ...,
     *   grossFuelPriceCurrency: ...,
     *   grossNonFuelPriceAmount: ...,
     *   grossNonFuelPriceCurrency: ...,
     *   netFuelPriceAmount: ...,
     *   netFuelPriceCurrency: ...,
     *   netNonFuelPriceAmount: ...,
     *   netNonFuelPriceCurrency: ...,
     *   odometerReading: ...,
     *   purchaseType: ...,
     *   serviceType: ...,
     *   trailerNumber: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Fleet)
     *   ->withEmployeeNumber(...)
     *   ->withFuelQuantity(...)
     *   ->withFuelType(...)
     *   ->withFuelUnitCostAmount(...)
     *   ->withFuelUnitCostCurrency(...)
     *   ->withFuelUnitOfMeasure(...)
     *   ->withGrossFuelPriceAmount(...)
     *   ->withGrossFuelPriceCurrency(...)
     *   ->withGrossNonFuelPriceAmount(...)
     *   ->withGrossNonFuelPriceCurrency(...)
     *   ->withNetFuelPriceAmount(...)
     *   ->withNetFuelPriceCurrency(...)
     *   ->withNetNonFuelPriceAmount(...)
     *   ->withNetNonFuelPriceCurrency(...)
     *   ->withOdometerReading(...)
     *   ->withPurchaseType(...)
     *   ->withServiceType(...)
     *   ->withTrailerNumber(...)
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
     * @param FuelType|value-of<FuelType>|null $fuelType
     * @param FuelUnitOfMeasure|value-of<FuelUnitOfMeasure>|null $fuelUnitOfMeasure
     * @param PurchaseType|value-of<PurchaseType>|null $purchaseType
     * @param ServiceType|value-of<ServiceType>|null $serviceType
     */
    public static function with(
        ?string $employeeNumber,
        ?string $fuelQuantity,
        FuelType|string|null $fuelType,
        ?int $fuelUnitCostAmount,
        ?string $fuelUnitCostCurrency,
        FuelUnitOfMeasure|string|null $fuelUnitOfMeasure,
        ?int $grossFuelPriceAmount,
        ?string $grossFuelPriceCurrency,
        ?int $grossNonFuelPriceAmount,
        ?string $grossNonFuelPriceCurrency,
        ?int $netFuelPriceAmount,
        ?string $netFuelPriceCurrency,
        ?int $netNonFuelPriceAmount,
        ?string $netNonFuelPriceCurrency,
        ?int $odometerReading,
        PurchaseType|string|null $purchaseType,
        ServiceType|string|null $serviceType,
        ?string $trailerNumber,
    ): self {
        $self = new self;

        $self['employeeNumber'] = $employeeNumber;
        $self['fuelQuantity'] = $fuelQuantity;
        $self['fuelType'] = $fuelType;
        $self['fuelUnitCostAmount'] = $fuelUnitCostAmount;
        $self['fuelUnitCostCurrency'] = $fuelUnitCostCurrency;
        $self['fuelUnitOfMeasure'] = $fuelUnitOfMeasure;
        $self['grossFuelPriceAmount'] = $grossFuelPriceAmount;
        $self['grossFuelPriceCurrency'] = $grossFuelPriceCurrency;
        $self['grossNonFuelPriceAmount'] = $grossNonFuelPriceAmount;
        $self['grossNonFuelPriceCurrency'] = $grossNonFuelPriceCurrency;
        $self['netFuelPriceAmount'] = $netFuelPriceAmount;
        $self['netFuelPriceCurrency'] = $netFuelPriceCurrency;
        $self['netNonFuelPriceAmount'] = $netNonFuelPriceAmount;
        $self['netNonFuelPriceCurrency'] = $netNonFuelPriceCurrency;
        $self['odometerReading'] = $odometerReading;
        $self['purchaseType'] = $purchaseType;
        $self['serviceType'] = $serviceType;
        $self['trailerNumber'] = $trailerNumber;

        return $self;
    }

    /**
     * The fleet employee number.
     */
    public function withEmployeeNumber(?string $employeeNumber): self
    {
        $self = clone $this;
        $self['employeeNumber'] = $employeeNumber;

        return $self;
    }

    /**
     * The quantity of fuel purchased, given as a string containing a decimal number in the indicated unit of measure.
     */
    public function withFuelQuantity(?string $fuelQuantity): self
    {
        $self = clone $this;
        $self['fuelQuantity'] = $fuelQuantity;

        return $self;
    }

    /**
     * The type of fuel purchased.
     *
     * @param FuelType|value-of<FuelType>|null $fuelType
     */
    public function withFuelType(FuelType|string|null $fuelType): self
    {
        $self = clone $this;
        $self['fuelType'] = $fuelType;

        return $self;
    }

    /**
     * The cost per unit of fuel in minor units.
     */
    public function withFuelUnitCostAmount(?int $fuelUnitCostAmount): self
    {
        $self = clone $this;
        $self['fuelUnitCostAmount'] = $fuelUnitCostAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the fuel unit cost.
     */
    public function withFuelUnitCostCurrency(
        ?string $fuelUnitCostCurrency
    ): self {
        $self = clone $this;
        $self['fuelUnitCostCurrency'] = $fuelUnitCostCurrency;

        return $self;
    }

    /**
     * The unit of measure for the fuel quantity.
     *
     * @param FuelUnitOfMeasure|value-of<FuelUnitOfMeasure>|null $fuelUnitOfMeasure
     */
    public function withFuelUnitOfMeasure(
        FuelUnitOfMeasure|string|null $fuelUnitOfMeasure
    ): self {
        $self = clone $this;
        $self['fuelUnitOfMeasure'] = $fuelUnitOfMeasure;

        return $self;
    }

    /**
     * The gross fuel price in minor units.
     */
    public function withGrossFuelPriceAmount(?int $grossFuelPriceAmount): self
    {
        $self = clone $this;
        $self['grossFuelPriceAmount'] = $grossFuelPriceAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the gross fuel price.
     */
    public function withGrossFuelPriceCurrency(
        ?string $grossFuelPriceCurrency
    ): self {
        $self = clone $this;
        $self['grossFuelPriceCurrency'] = $grossFuelPriceCurrency;

        return $self;
    }

    /**
     * The gross non-fuel price in minor units.
     */
    public function withGrossNonFuelPriceAmount(
        ?int $grossNonFuelPriceAmount
    ): self {
        $self = clone $this;
        $self['grossNonFuelPriceAmount'] = $grossNonFuelPriceAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the gross non-fuel price.
     */
    public function withGrossNonFuelPriceCurrency(
        ?string $grossNonFuelPriceCurrency
    ): self {
        $self = clone $this;
        $self['grossNonFuelPriceCurrency'] = $grossNonFuelPriceCurrency;

        return $self;
    }

    /**
     * The net fuel price in minor units.
     */
    public function withNetFuelPriceAmount(?int $netFuelPriceAmount): self
    {
        $self = clone $this;
        $self['netFuelPriceAmount'] = $netFuelPriceAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the net fuel price.
     */
    public function withNetFuelPriceCurrency(
        ?string $netFuelPriceCurrency
    ): self {
        $self = clone $this;
        $self['netFuelPriceCurrency'] = $netFuelPriceCurrency;

        return $self;
    }

    /**
     * The net non-fuel price in minor units.
     */
    public function withNetNonFuelPriceAmount(?int $netNonFuelPriceAmount): self
    {
        $self = clone $this;
        $self['netNonFuelPriceAmount'] = $netNonFuelPriceAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the net non-fuel price.
     */
    public function withNetNonFuelPriceCurrency(
        ?string $netNonFuelPriceCurrency
    ): self {
        $self = clone $this;
        $self['netNonFuelPriceCurrency'] = $netNonFuelPriceCurrency;

        return $self;
    }

    /**
     * The odometer reading reported by the merchant.
     */
    public function withOdometerReading(?int $odometerReading): self
    {
        $self = clone $this;
        $self['odometerReading'] = $odometerReading;

        return $self;
    }

    /**
     * The type of fleet purchase.
     *
     * @param PurchaseType|value-of<PurchaseType>|null $purchaseType
     */
    public function withPurchaseType(
        PurchaseType|string|null $purchaseType
    ): self {
        $self = clone $this;
        $self['purchaseType'] = $purchaseType;

        return $self;
    }

    /**
     * The type of service provided.
     *
     * @param ServiceType|value-of<ServiceType>|null $serviceType
     */
    public function withServiceType(ServiceType|string|null $serviceType): self
    {
        $self = clone $this;
        $self['serviceType'] = $serviceType;

        return $self;
    }

    /**
     * The fleet trailer number.
     */
    public function withTrailerNumber(?string $trailerNumber): self
    {
        $self = clone $this;
        $self['trailerNumber'] = $trailerNumber;

        return $self;
    }
}

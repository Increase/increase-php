<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardRefund;

use Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\CarRental;
use Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\Lodging;
use Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\PurchaseIdentifierFormat;
use Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\Travel;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Additional details about the card purchase, such as tax and industry-specific fields.
 *
 * @phpstan-import-type CarRentalShape from \Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\CarRental
 * @phpstan-import-type LodgingShape from \Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\Lodging
 * @phpstan-import-type TravelShape from \Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\Travel
 *
 * @phpstan-type PurchaseDetailsShape = array{
 *   carRental: null|CarRental|CarRentalShape,
 *   customerReferenceIdentifier: string|null,
 *   localTaxAmount: int|null,
 *   localTaxCurrency: string|null,
 *   lodging: null|Lodging|LodgingShape,
 *   nationalTaxAmount: int|null,
 *   nationalTaxCurrency: string|null,
 *   purchaseIdentifier: string|null,
 *   purchaseIdentifierFormat: null|PurchaseIdentifierFormat|value-of<PurchaseIdentifierFormat>,
 *   travel: null|Travel|TravelShape,
 * }
 */
final class PurchaseDetails implements BaseModel
{
    /** @use SdkModel<PurchaseDetailsShape> */
    use SdkModel;

    /**
     * Fields specific to car rentals.
     */
    #[Required('car_rental')]
    public ?CarRental $carRental;

    /**
     * An identifier from the merchant for the customer or consumer.
     */
    #[Required('customer_reference_identifier')]
    public ?string $customerReferenceIdentifier;

    /**
     * The state or provincial tax amount in minor units.
     */
    #[Required('local_tax_amount')]
    public ?int $localTaxAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the local tax assessed.
     */
    #[Required('local_tax_currency')]
    public ?string $localTaxCurrency;

    /**
     * Fields specific to lodging.
     */
    #[Required]
    public ?Lodging $lodging;

    /**
     * The national tax amount in minor units.
     */
    #[Required('national_tax_amount')]
    public ?int $nationalTaxAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the local tax assessed.
     */
    #[Required('national_tax_currency')]
    public ?string $nationalTaxCurrency;

    /**
     * An identifier from the merchant for the purchase to the issuer and cardholder.
     */
    #[Required('purchase_identifier')]
    public ?string $purchaseIdentifier;

    /**
     * The format of the purchase identifier.
     *
     * @var value-of<PurchaseIdentifierFormat>|null $purchaseIdentifierFormat
     */
    #[Required(
        'purchase_identifier_format',
        enum: PurchaseIdentifierFormat::class
    )]
    public ?string $purchaseIdentifierFormat;

    /**
     * Fields specific to travel.
     */
    #[Required]
    public ?Travel $travel;

    /**
     * `new PurchaseDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseDetails::with(
     *   carRental: ...,
     *   customerReferenceIdentifier: ...,
     *   localTaxAmount: ...,
     *   localTaxCurrency: ...,
     *   lodging: ...,
     *   nationalTaxAmount: ...,
     *   nationalTaxCurrency: ...,
     *   purchaseIdentifier: ...,
     *   purchaseIdentifierFormat: ...,
     *   travel: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseDetails)
     *   ->withCarRental(...)
     *   ->withCustomerReferenceIdentifier(...)
     *   ->withLocalTaxAmount(...)
     *   ->withLocalTaxCurrency(...)
     *   ->withLodging(...)
     *   ->withNationalTaxAmount(...)
     *   ->withNationalTaxCurrency(...)
     *   ->withPurchaseIdentifier(...)
     *   ->withPurchaseIdentifierFormat(...)
     *   ->withTravel(...)
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
     * @param CarRental|CarRentalShape|null $carRental
     * @param Lodging|LodgingShape|null $lodging
     * @param PurchaseIdentifierFormat|value-of<PurchaseIdentifierFormat>|null $purchaseIdentifierFormat
     * @param Travel|TravelShape|null $travel
     */
    public static function with(
        CarRental|array|null $carRental,
        ?string $customerReferenceIdentifier,
        ?int $localTaxAmount,
        ?string $localTaxCurrency,
        Lodging|array|null $lodging,
        ?int $nationalTaxAmount,
        ?string $nationalTaxCurrency,
        ?string $purchaseIdentifier,
        PurchaseIdentifierFormat|string|null $purchaseIdentifierFormat,
        Travel|array|null $travel,
    ): self {
        $self = new self;

        $self['carRental'] = $carRental;
        $self['customerReferenceIdentifier'] = $customerReferenceIdentifier;
        $self['localTaxAmount'] = $localTaxAmount;
        $self['localTaxCurrency'] = $localTaxCurrency;
        $self['lodging'] = $lodging;
        $self['nationalTaxAmount'] = $nationalTaxAmount;
        $self['nationalTaxCurrency'] = $nationalTaxCurrency;
        $self['purchaseIdentifier'] = $purchaseIdentifier;
        $self['purchaseIdentifierFormat'] = $purchaseIdentifierFormat;
        $self['travel'] = $travel;

        return $self;
    }

    /**
     * Fields specific to car rentals.
     *
     * @param CarRental|CarRentalShape|null $carRental
     */
    public function withCarRental(CarRental|array|null $carRental): self
    {
        $self = clone $this;
        $self['carRental'] = $carRental;

        return $self;
    }

    /**
     * An identifier from the merchant for the customer or consumer.
     */
    public function withCustomerReferenceIdentifier(
        ?string $customerReferenceIdentifier
    ): self {
        $self = clone $this;
        $self['customerReferenceIdentifier'] = $customerReferenceIdentifier;

        return $self;
    }

    /**
     * The state or provincial tax amount in minor units.
     */
    public function withLocalTaxAmount(?int $localTaxAmount): self
    {
        $self = clone $this;
        $self['localTaxAmount'] = $localTaxAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the local tax assessed.
     */
    public function withLocalTaxCurrency(?string $localTaxCurrency): self
    {
        $self = clone $this;
        $self['localTaxCurrency'] = $localTaxCurrency;

        return $self;
    }

    /**
     * Fields specific to lodging.
     *
     * @param Lodging|LodgingShape|null $lodging
     */
    public function withLodging(Lodging|array|null $lodging): self
    {
        $self = clone $this;
        $self['lodging'] = $lodging;

        return $self;
    }

    /**
     * The national tax amount in minor units.
     */
    public function withNationalTaxAmount(?int $nationalTaxAmount): self
    {
        $self = clone $this;
        $self['nationalTaxAmount'] = $nationalTaxAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the local tax assessed.
     */
    public function withNationalTaxCurrency(?string $nationalTaxCurrency): self
    {
        $self = clone $this;
        $self['nationalTaxCurrency'] = $nationalTaxCurrency;

        return $self;
    }

    /**
     * An identifier from the merchant for the purchase to the issuer and cardholder.
     */
    public function withPurchaseIdentifier(?string $purchaseIdentifier): self
    {
        $self = clone $this;
        $self['purchaseIdentifier'] = $purchaseIdentifier;

        return $self;
    }

    /**
     * The format of the purchase identifier.
     *
     * @param PurchaseIdentifierFormat|value-of<PurchaseIdentifierFormat>|null $purchaseIdentifierFormat
     */
    public function withPurchaseIdentifierFormat(
        PurchaseIdentifierFormat|string|null $purchaseIdentifierFormat
    ): self {
        $self = clone $this;
        $self['purchaseIdentifierFormat'] = $purchaseIdentifierFormat;

        return $self;
    }

    /**
     * Fields specific to travel.
     *
     * @param Travel|TravelShape|null $travel
     */
    public function withTravel(Travel|array|null $travel): self
    {
        $self = clone $this;
        $self['travel'] = $travel;

        return $self;
    }
}

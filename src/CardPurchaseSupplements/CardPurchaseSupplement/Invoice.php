<?php

declare(strict_types=1);

namespace Increase\CardPurchaseSupplements\CardPurchaseSupplement;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement\Invoice\DiscountTreatmentCode;
use Increase\CardPurchaseSupplements\CardPurchaseSupplement\Invoice\TaxTreatments;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Invoice-level information about the payment.
 *
 * @phpstan-type InvoiceShape = array{
 *   discountAmount: int|null,
 *   discountCurrency: string|null,
 *   discountTreatmentCode: null|DiscountTreatmentCode|value-of<DiscountTreatmentCode>,
 *   dutyTaxAmount: int|null,
 *   dutyTaxCurrency: string|null,
 *   orderDate: string|null,
 *   shippingAmount: int|null,
 *   shippingCurrency: string|null,
 *   shippingDestinationCountryCode: string|null,
 *   shippingDestinationPostalCode: string|null,
 *   shippingSourcePostalCode: string|null,
 *   shippingTaxAmount: int|null,
 *   shippingTaxCurrency: string|null,
 *   shippingTaxRate: string|null,
 *   taxTreatments: null|TaxTreatments|value-of<TaxTreatments>,
 *   uniqueValueAddedTaxInvoiceReference: string|null,
 * }
 */
final class Invoice implements BaseModel
{
    /** @use SdkModel<InvoiceShape> */
    use SdkModel;

    /**
     * Discount given to cardholder.
     */
    #[Required('discount_amount')]
    public ?int $discountAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the discount.
     */
    #[Required('discount_currency')]
    public ?string $discountCurrency;

    /**
     * Indicates how the merchant applied the discount.
     *
     * @var value-of<DiscountTreatmentCode>|null $discountTreatmentCode
     */
    #[Required('discount_treatment_code', enum: DiscountTreatmentCode::class)]
    public ?string $discountTreatmentCode;

    /**
     * Amount of duty taxes.
     */
    #[Required('duty_tax_amount')]
    public ?int $dutyTaxAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the duty tax.
     */
    #[Required('duty_tax_currency')]
    public ?string $dutyTaxCurrency;

    /**
     * Date the order was taken.
     */
    #[Required('order_date')]
    public ?string $orderDate;

    /**
     * The shipping cost.
     */
    #[Required('shipping_amount')]
    public ?int $shippingAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the shipping cost.
     */
    #[Required('shipping_currency')]
    public ?string $shippingCurrency;

    /**
     * Country code of the shipping destination.
     */
    #[Required('shipping_destination_country_code')]
    public ?string $shippingDestinationCountryCode;

    /**
     * Postal code of the shipping destination.
     */
    #[Required('shipping_destination_postal_code')]
    public ?string $shippingDestinationPostalCode;

    /**
     * Postal code of the location being shipped from.
     */
    #[Required('shipping_source_postal_code')]
    public ?string $shippingSourcePostalCode;

    /**
     * Taxes paid for freight and shipping.
     */
    #[Required('shipping_tax_amount')]
    public ?int $shippingTaxAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the shipping tax.
     */
    #[Required('shipping_tax_currency')]
    public ?string $shippingTaxCurrency;

    /**
     * Tax rate for freight and shipping.
     */
    #[Required('shipping_tax_rate')]
    public ?string $shippingTaxRate;

    /**
     * Indicates how the merchant applied taxes.
     *
     * @var value-of<TaxTreatments>|null $taxTreatments
     */
    #[Required('tax_treatments', enum: TaxTreatments::class)]
    public ?string $taxTreatments;

    /**
     * Value added tax invoice reference number.
     */
    #[Required('unique_value_added_tax_invoice_reference')]
    public ?string $uniqueValueAddedTaxInvoiceReference;

    /**
     * `new Invoice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Invoice::with(
     *   discountAmount: ...,
     *   discountCurrency: ...,
     *   discountTreatmentCode: ...,
     *   dutyTaxAmount: ...,
     *   dutyTaxCurrency: ...,
     *   orderDate: ...,
     *   shippingAmount: ...,
     *   shippingCurrency: ...,
     *   shippingDestinationCountryCode: ...,
     *   shippingDestinationPostalCode: ...,
     *   shippingSourcePostalCode: ...,
     *   shippingTaxAmount: ...,
     *   shippingTaxCurrency: ...,
     *   shippingTaxRate: ...,
     *   taxTreatments: ...,
     *   uniqueValueAddedTaxInvoiceReference: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Invoice)
     *   ->withDiscountAmount(...)
     *   ->withDiscountCurrency(...)
     *   ->withDiscountTreatmentCode(...)
     *   ->withDutyTaxAmount(...)
     *   ->withDutyTaxCurrency(...)
     *   ->withOrderDate(...)
     *   ->withShippingAmount(...)
     *   ->withShippingCurrency(...)
     *   ->withShippingDestinationCountryCode(...)
     *   ->withShippingDestinationPostalCode(...)
     *   ->withShippingSourcePostalCode(...)
     *   ->withShippingTaxAmount(...)
     *   ->withShippingTaxCurrency(...)
     *   ->withShippingTaxRate(...)
     *   ->withTaxTreatments(...)
     *   ->withUniqueValueAddedTaxInvoiceReference(...)
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
     * @param DiscountTreatmentCode|value-of<DiscountTreatmentCode>|null $discountTreatmentCode
     * @param TaxTreatments|value-of<TaxTreatments>|null $taxTreatments
     */
    public static function with(
        ?int $discountAmount,
        ?string $discountCurrency,
        DiscountTreatmentCode|string|null $discountTreatmentCode,
        ?int $dutyTaxAmount,
        ?string $dutyTaxCurrency,
        ?string $orderDate,
        ?int $shippingAmount,
        ?string $shippingCurrency,
        ?string $shippingDestinationCountryCode,
        ?string $shippingDestinationPostalCode,
        ?string $shippingSourcePostalCode,
        ?int $shippingTaxAmount,
        ?string $shippingTaxCurrency,
        ?string $shippingTaxRate,
        TaxTreatments|string|null $taxTreatments,
        ?string $uniqueValueAddedTaxInvoiceReference,
    ): self {
        $self = new self;

        $self['discountAmount'] = $discountAmount;
        $self['discountCurrency'] = $discountCurrency;
        $self['discountTreatmentCode'] = $discountTreatmentCode;
        $self['dutyTaxAmount'] = $dutyTaxAmount;
        $self['dutyTaxCurrency'] = $dutyTaxCurrency;
        $self['orderDate'] = $orderDate;
        $self['shippingAmount'] = $shippingAmount;
        $self['shippingCurrency'] = $shippingCurrency;
        $self['shippingDestinationCountryCode'] = $shippingDestinationCountryCode;
        $self['shippingDestinationPostalCode'] = $shippingDestinationPostalCode;
        $self['shippingSourcePostalCode'] = $shippingSourcePostalCode;
        $self['shippingTaxAmount'] = $shippingTaxAmount;
        $self['shippingTaxCurrency'] = $shippingTaxCurrency;
        $self['shippingTaxRate'] = $shippingTaxRate;
        $self['taxTreatments'] = $taxTreatments;
        $self['uniqueValueAddedTaxInvoiceReference'] = $uniqueValueAddedTaxInvoiceReference;

        return $self;
    }

    /**
     * Discount given to cardholder.
     */
    public function withDiscountAmount(?int $discountAmount): self
    {
        $self = clone $this;
        $self['discountAmount'] = $discountAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the discount.
     */
    public function withDiscountCurrency(?string $discountCurrency): self
    {
        $self = clone $this;
        $self['discountCurrency'] = $discountCurrency;

        return $self;
    }

    /**
     * Indicates how the merchant applied the discount.
     *
     * @param DiscountTreatmentCode|value-of<DiscountTreatmentCode>|null $discountTreatmentCode
     */
    public function withDiscountTreatmentCode(
        DiscountTreatmentCode|string|null $discountTreatmentCode
    ): self {
        $self = clone $this;
        $self['discountTreatmentCode'] = $discountTreatmentCode;

        return $self;
    }

    /**
     * Amount of duty taxes.
     */
    public function withDutyTaxAmount(?int $dutyTaxAmount): self
    {
        $self = clone $this;
        $self['dutyTaxAmount'] = $dutyTaxAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the duty tax.
     */
    public function withDutyTaxCurrency(?string $dutyTaxCurrency): self
    {
        $self = clone $this;
        $self['dutyTaxCurrency'] = $dutyTaxCurrency;

        return $self;
    }

    /**
     * Date the order was taken.
     */
    public function withOrderDate(?string $orderDate): self
    {
        $self = clone $this;
        $self['orderDate'] = $orderDate;

        return $self;
    }

    /**
     * The shipping cost.
     */
    public function withShippingAmount(?int $shippingAmount): self
    {
        $self = clone $this;
        $self['shippingAmount'] = $shippingAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the shipping cost.
     */
    public function withShippingCurrency(?string $shippingCurrency): self
    {
        $self = clone $this;
        $self['shippingCurrency'] = $shippingCurrency;

        return $self;
    }

    /**
     * Country code of the shipping destination.
     */
    public function withShippingDestinationCountryCode(
        ?string $shippingDestinationCountryCode
    ): self {
        $self = clone $this;
        $self['shippingDestinationCountryCode'] = $shippingDestinationCountryCode;

        return $self;
    }

    /**
     * Postal code of the shipping destination.
     */
    public function withShippingDestinationPostalCode(
        ?string $shippingDestinationPostalCode
    ): self {
        $self = clone $this;
        $self['shippingDestinationPostalCode'] = $shippingDestinationPostalCode;

        return $self;
    }

    /**
     * Postal code of the location being shipped from.
     */
    public function withShippingSourcePostalCode(
        ?string $shippingSourcePostalCode
    ): self {
        $self = clone $this;
        $self['shippingSourcePostalCode'] = $shippingSourcePostalCode;

        return $self;
    }

    /**
     * Taxes paid for freight and shipping.
     */
    public function withShippingTaxAmount(?int $shippingTaxAmount): self
    {
        $self = clone $this;
        $self['shippingTaxAmount'] = $shippingTaxAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the shipping tax.
     */
    public function withShippingTaxCurrency(?string $shippingTaxCurrency): self
    {
        $self = clone $this;
        $self['shippingTaxCurrency'] = $shippingTaxCurrency;

        return $self;
    }

    /**
     * Tax rate for freight and shipping.
     */
    public function withShippingTaxRate(?string $shippingTaxRate): self
    {
        $self = clone $this;
        $self['shippingTaxRate'] = $shippingTaxRate;

        return $self;
    }

    /**
     * Indicates how the merchant applied taxes.
     *
     * @param TaxTreatments|value-of<TaxTreatments>|null $taxTreatments
     */
    public function withTaxTreatments(
        TaxTreatments|string|null $taxTreatments
    ): self {
        $self = clone $this;
        $self['taxTreatments'] = $taxTreatments;

        return $self;
    }

    /**
     * Value added tax invoice reference number.
     */
    public function withUniqueValueAddedTaxInvoiceReference(
        ?string $uniqueValueAddedTaxInvoiceReference
    ): self {
        $self = clone $this;
        $self['uniqueValueAddedTaxInvoiceReference'] = $uniqueValueAddedTaxInvoiceReference;

        return $self;
    }
}

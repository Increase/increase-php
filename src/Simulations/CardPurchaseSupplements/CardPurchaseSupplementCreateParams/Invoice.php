<?php

declare(strict_types=1);

namespace Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Invoice-level information about the payment.
 *
 * @phpstan-type InvoiceShape = array{
 *   discountAmount?: int|null,
 *   dutyTaxAmount?: int|null,
 *   orderDate?: string|null,
 *   shippingAmount?: int|null,
 *   shippingDestinationCountryCode?: string|null,
 *   shippingDestinationPostalCode?: string|null,
 *   shippingSourcePostalCode?: string|null,
 *   shippingTaxAmount?: int|null,
 *   shippingTaxRate?: string|null,
 *   uniqueValueAddedTaxInvoiceReference?: string|null,
 * }
 */
final class Invoice implements BaseModel
{
    /** @use SdkModel<InvoiceShape> */
    use SdkModel;

    /**
     * Discount given to cardholder.
     */
    #[Optional('discount_amount')]
    public ?int $discountAmount;

    /**
     * Amount of duty taxes.
     */
    #[Optional('duty_tax_amount')]
    public ?int $dutyTaxAmount;

    /**
     * Date the order was taken.
     */
    #[Optional('order_date')]
    public ?string $orderDate;

    /**
     * The shipping cost.
     */
    #[Optional('shipping_amount')]
    public ?int $shippingAmount;

    /**
     * Country code of the shipping destination.
     */
    #[Optional('shipping_destination_country_code')]
    public ?string $shippingDestinationCountryCode;

    /**
     * Postal code of the shipping destination.
     */
    #[Optional('shipping_destination_postal_code')]
    public ?string $shippingDestinationPostalCode;

    /**
     * Postal code of the location being shipped from.
     */
    #[Optional('shipping_source_postal_code')]
    public ?string $shippingSourcePostalCode;

    /**
     * Taxes paid for freight and shipping.
     */
    #[Optional('shipping_tax_amount')]
    public ?int $shippingTaxAmount;

    /**
     * Tax rate for freight and shipping.
     */
    #[Optional('shipping_tax_rate')]
    public ?string $shippingTaxRate;

    /**
     * Value added tax invoice reference number.
     */
    #[Optional('unique_value_added_tax_invoice_reference')]
    public ?string $uniqueValueAddedTaxInvoiceReference;

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
        ?int $discountAmount = null,
        ?int $dutyTaxAmount = null,
        ?string $orderDate = null,
        ?int $shippingAmount = null,
        ?string $shippingDestinationCountryCode = null,
        ?string $shippingDestinationPostalCode = null,
        ?string $shippingSourcePostalCode = null,
        ?int $shippingTaxAmount = null,
        ?string $shippingTaxRate = null,
        ?string $uniqueValueAddedTaxInvoiceReference = null,
    ): self {
        $self = new self;

        null !== $discountAmount && $self['discountAmount'] = $discountAmount;
        null !== $dutyTaxAmount && $self['dutyTaxAmount'] = $dutyTaxAmount;
        null !== $orderDate && $self['orderDate'] = $orderDate;
        null !== $shippingAmount && $self['shippingAmount'] = $shippingAmount;
        null !== $shippingDestinationCountryCode && $self['shippingDestinationCountryCode'] = $shippingDestinationCountryCode;
        null !== $shippingDestinationPostalCode && $self['shippingDestinationPostalCode'] = $shippingDestinationPostalCode;
        null !== $shippingSourcePostalCode && $self['shippingSourcePostalCode'] = $shippingSourcePostalCode;
        null !== $shippingTaxAmount && $self['shippingTaxAmount'] = $shippingTaxAmount;
        null !== $shippingTaxRate && $self['shippingTaxRate'] = $shippingTaxRate;
        null !== $uniqueValueAddedTaxInvoiceReference && $self['uniqueValueAddedTaxInvoiceReference'] = $uniqueValueAddedTaxInvoiceReference;

        return $self;
    }

    /**
     * Discount given to cardholder.
     */
    public function withDiscountAmount(int $discountAmount): self
    {
        $self = clone $this;
        $self['discountAmount'] = $discountAmount;

        return $self;
    }

    /**
     * Amount of duty taxes.
     */
    public function withDutyTaxAmount(int $dutyTaxAmount): self
    {
        $self = clone $this;
        $self['dutyTaxAmount'] = $dutyTaxAmount;

        return $self;
    }

    /**
     * Date the order was taken.
     */
    public function withOrderDate(string $orderDate): self
    {
        $self = clone $this;
        $self['orderDate'] = $orderDate;

        return $self;
    }

    /**
     * The shipping cost.
     */
    public function withShippingAmount(int $shippingAmount): self
    {
        $self = clone $this;
        $self['shippingAmount'] = $shippingAmount;

        return $self;
    }

    /**
     * Country code of the shipping destination.
     */
    public function withShippingDestinationCountryCode(
        string $shippingDestinationCountryCode
    ): self {
        $self = clone $this;
        $self['shippingDestinationCountryCode'] = $shippingDestinationCountryCode;

        return $self;
    }

    /**
     * Postal code of the shipping destination.
     */
    public function withShippingDestinationPostalCode(
        string $shippingDestinationPostalCode
    ): self {
        $self = clone $this;
        $self['shippingDestinationPostalCode'] = $shippingDestinationPostalCode;

        return $self;
    }

    /**
     * Postal code of the location being shipped from.
     */
    public function withShippingSourcePostalCode(
        string $shippingSourcePostalCode
    ): self {
        $self = clone $this;
        $self['shippingSourcePostalCode'] = $shippingSourcePostalCode;

        return $self;
    }

    /**
     * Taxes paid for freight and shipping.
     */
    public function withShippingTaxAmount(int $shippingTaxAmount): self
    {
        $self = clone $this;
        $self['shippingTaxAmount'] = $shippingTaxAmount;

        return $self;
    }

    /**
     * Tax rate for freight and shipping.
     */
    public function withShippingTaxRate(string $shippingTaxRate): self
    {
        $self = clone $this;
        $self['shippingTaxRate'] = $shippingTaxRate;

        return $self;
    }

    /**
     * Value added tax invoice reference number.
     */
    public function withUniqueValueAddedTaxInvoiceReference(
        string $uniqueValueAddedTaxInvoiceReference
    ): self {
        $self = clone $this;
        $self['uniqueValueAddedTaxInvoiceReference'] = $uniqueValueAddedTaxInvoiceReference;

        return $self;
    }
}

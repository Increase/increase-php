<?php

declare(strict_types=1);

namespace Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type LineItemShape = array{
 *   discountAmount?: int|null,
 *   itemCommodityCode?: string|null,
 *   itemDescriptor?: string|null,
 *   itemQuantity?: string|null,
 *   productCode?: string|null,
 *   salesTaxAmount?: int|null,
 *   salesTaxRate?: string|null,
 *   totalAmount?: int|null,
 *   unitCost?: string|null,
 *   unitOfMeasureCode?: string|null,
 * }
 */
final class LineItem implements BaseModel
{
    /** @use SdkModel<LineItemShape> */
    use SdkModel;

    /**
     * Discount amount for this specific line item.
     */
    #[Optional('discount_amount')]
    public ?int $discountAmount;

    /**
     * Code used to categorize the purchase item.
     */
    #[Optional('item_commodity_code')]
    public ?string $itemCommodityCode;

    /**
     * Description of the purchase item.
     */
    #[Optional('item_descriptor')]
    public ?string $itemDescriptor;

    /**
     * The number of units of the product being purchased.
     */
    #[Optional('item_quantity')]
    public ?string $itemQuantity;

    /**
     * Code used to categorize the product being purchased.
     */
    #[Optional('product_code')]
    public ?string $productCode;

    /**
     * Sales tax amount for this line item.
     */
    #[Optional('sales_tax_amount')]
    public ?int $salesTaxAmount;

    /**
     * Sales tax rate for this line item.
     */
    #[Optional('sales_tax_rate')]
    public ?string $salesTaxRate;

    /**
     * Total amount of all line items.
     */
    #[Optional('total_amount')]
    public ?int $totalAmount;

    /**
     * Cost of line item per unit of measure, in major units.
     */
    #[Optional('unit_cost')]
    public ?string $unitCost;

    /**
     * Code indicating unit of measure (gallons, etc.).
     */
    #[Optional('unit_of_measure_code')]
    public ?string $unitOfMeasureCode;

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
        ?string $itemCommodityCode = null,
        ?string $itemDescriptor = null,
        ?string $itemQuantity = null,
        ?string $productCode = null,
        ?int $salesTaxAmount = null,
        ?string $salesTaxRate = null,
        ?int $totalAmount = null,
        ?string $unitCost = null,
        ?string $unitOfMeasureCode = null,
    ): self {
        $self = new self;

        null !== $discountAmount && $self['discountAmount'] = $discountAmount;
        null !== $itemCommodityCode && $self['itemCommodityCode'] = $itemCommodityCode;
        null !== $itemDescriptor && $self['itemDescriptor'] = $itemDescriptor;
        null !== $itemQuantity && $self['itemQuantity'] = $itemQuantity;
        null !== $productCode && $self['productCode'] = $productCode;
        null !== $salesTaxAmount && $self['salesTaxAmount'] = $salesTaxAmount;
        null !== $salesTaxRate && $self['salesTaxRate'] = $salesTaxRate;
        null !== $totalAmount && $self['totalAmount'] = $totalAmount;
        null !== $unitCost && $self['unitCost'] = $unitCost;
        null !== $unitOfMeasureCode && $self['unitOfMeasureCode'] = $unitOfMeasureCode;

        return $self;
    }

    /**
     * Discount amount for this specific line item.
     */
    public function withDiscountAmount(int $discountAmount): self
    {
        $self = clone $this;
        $self['discountAmount'] = $discountAmount;

        return $self;
    }

    /**
     * Code used to categorize the purchase item.
     */
    public function withItemCommodityCode(string $itemCommodityCode): self
    {
        $self = clone $this;
        $self['itemCommodityCode'] = $itemCommodityCode;

        return $self;
    }

    /**
     * Description of the purchase item.
     */
    public function withItemDescriptor(string $itemDescriptor): self
    {
        $self = clone $this;
        $self['itemDescriptor'] = $itemDescriptor;

        return $self;
    }

    /**
     * The number of units of the product being purchased.
     */
    public function withItemQuantity(string $itemQuantity): self
    {
        $self = clone $this;
        $self['itemQuantity'] = $itemQuantity;

        return $self;
    }

    /**
     * Code used to categorize the product being purchased.
     */
    public function withProductCode(string $productCode): self
    {
        $self = clone $this;
        $self['productCode'] = $productCode;

        return $self;
    }

    /**
     * Sales tax amount for this line item.
     */
    public function withSalesTaxAmount(int $salesTaxAmount): self
    {
        $self = clone $this;
        $self['salesTaxAmount'] = $salesTaxAmount;

        return $self;
    }

    /**
     * Sales tax rate for this line item.
     */
    public function withSalesTaxRate(string $salesTaxRate): self
    {
        $self = clone $this;
        $self['salesTaxRate'] = $salesTaxRate;

        return $self;
    }

    /**
     * Total amount of all line items.
     */
    public function withTotalAmount(int $totalAmount): self
    {
        $self = clone $this;
        $self['totalAmount'] = $totalAmount;

        return $self;
    }

    /**
     * Cost of line item per unit of measure, in major units.
     */
    public function withUnitCost(string $unitCost): self
    {
        $self = clone $this;
        $self['unitCost'] = $unitCost;

        return $self;
    }

    /**
     * Code indicating unit of measure (gallons, etc.).
     */
    public function withUnitOfMeasureCode(string $unitOfMeasureCode): self
    {
        $self = clone $this;
        $self['unitOfMeasureCode'] = $unitOfMeasureCode;

        return $self;
    }
}

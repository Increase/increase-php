<?php

declare(strict_types=1);

namespace Increase\CardPurchaseSupplements\CardPurchaseSupplement;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement\LineItem\DetailIndicator;
use Increase\CardPurchaseSupplements\CardPurchaseSupplement\LineItem\DiscountTreatmentCode;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type LineItemShape = array{
 *   id: string,
 *   detailIndicator: null|DetailIndicator|value-of<DetailIndicator>,
 *   discountAmount: int|null,
 *   discountCurrency: string|null,
 *   discountTreatmentCode: null|DiscountTreatmentCode|value-of<DiscountTreatmentCode>,
 *   itemCommodityCode: string|null,
 *   itemDescriptor: string|null,
 *   itemQuantity: string|null,
 *   productCode: string|null,
 *   salesTaxAmount: int|null,
 *   salesTaxCurrency: string|null,
 *   salesTaxRate: string|null,
 *   totalAmount: int|null,
 *   totalAmountCurrency: string|null,
 *   unitCost: string|null,
 *   unitCostCurrency: string|null,
 *   unitOfMeasureCode: string|null,
 * }
 */
final class LineItem implements BaseModel
{
    /** @use SdkModel<LineItemShape> */
    use SdkModel;

    /**
     * The Card Purchase Supplement Line Item identifier.
     */
    #[Required]
    public string $id;

    /**
     * Indicates the type of line item.
     *
     * @var value-of<DetailIndicator>|null $detailIndicator
     */
    #[Required('detail_indicator', enum: DetailIndicator::class)]
    public ?string $detailIndicator;

    /**
     * Discount amount for this specific line item.
     */
    #[Required('discount_amount')]
    public ?int $discountAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the discount.
     */
    #[Required('discount_currency')]
    public ?string $discountCurrency;

    /**
     * Indicates how the merchant applied the discount for this specific line item.
     *
     * @var value-of<DiscountTreatmentCode>|null $discountTreatmentCode
     */
    #[Required('discount_treatment_code', enum: DiscountTreatmentCode::class)]
    public ?string $discountTreatmentCode;

    /**
     * Code used to categorize the purchase item.
     */
    #[Required('item_commodity_code')]
    public ?string $itemCommodityCode;

    /**
     * Description of the purchase item.
     */
    #[Required('item_descriptor')]
    public ?string $itemDescriptor;

    /**
     * The number of units of the product being purchased.
     */
    #[Required('item_quantity')]
    public ?string $itemQuantity;

    /**
     * Code used to categorize the product being purchased.
     */
    #[Required('product_code')]
    public ?string $productCode;

    /**
     * Sales tax amount for this line item.
     */
    #[Required('sales_tax_amount')]
    public ?int $salesTaxAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the sales tax assessed.
     */
    #[Required('sales_tax_currency')]
    public ?string $salesTaxCurrency;

    /**
     * Sales tax rate for this line item.
     */
    #[Required('sales_tax_rate')]
    public ?string $salesTaxRate;

    /**
     * Total amount of all line items.
     */
    #[Required('total_amount')]
    public ?int $totalAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the total amount.
     */
    #[Required('total_amount_currency')]
    public ?string $totalAmountCurrency;

    /**
     * Cost of line item per unit of measure, in major units.
     */
    #[Required('unit_cost')]
    public ?string $unitCost;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the unit cost.
     */
    #[Required('unit_cost_currency')]
    public ?string $unitCostCurrency;

    /**
     * Code indicating unit of measure (gallons, etc.).
     */
    #[Required('unit_of_measure_code')]
    public ?string $unitOfMeasureCode;

    /**
     * `new LineItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LineItem::with(
     *   id: ...,
     *   detailIndicator: ...,
     *   discountAmount: ...,
     *   discountCurrency: ...,
     *   discountTreatmentCode: ...,
     *   itemCommodityCode: ...,
     *   itemDescriptor: ...,
     *   itemQuantity: ...,
     *   productCode: ...,
     *   salesTaxAmount: ...,
     *   salesTaxCurrency: ...,
     *   salesTaxRate: ...,
     *   totalAmount: ...,
     *   totalAmountCurrency: ...,
     *   unitCost: ...,
     *   unitCostCurrency: ...,
     *   unitOfMeasureCode: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LineItem)
     *   ->withID(...)
     *   ->withDetailIndicator(...)
     *   ->withDiscountAmount(...)
     *   ->withDiscountCurrency(...)
     *   ->withDiscountTreatmentCode(...)
     *   ->withItemCommodityCode(...)
     *   ->withItemDescriptor(...)
     *   ->withItemQuantity(...)
     *   ->withProductCode(...)
     *   ->withSalesTaxAmount(...)
     *   ->withSalesTaxCurrency(...)
     *   ->withSalesTaxRate(...)
     *   ->withTotalAmount(...)
     *   ->withTotalAmountCurrency(...)
     *   ->withUnitCost(...)
     *   ->withUnitCostCurrency(...)
     *   ->withUnitOfMeasureCode(...)
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
     * @param DetailIndicator|value-of<DetailIndicator>|null $detailIndicator
     * @param DiscountTreatmentCode|value-of<DiscountTreatmentCode>|null $discountTreatmentCode
     */
    public static function with(
        string $id,
        DetailIndicator|string|null $detailIndicator,
        ?int $discountAmount,
        ?string $discountCurrency,
        DiscountTreatmentCode|string|null $discountTreatmentCode,
        ?string $itemCommodityCode,
        ?string $itemDescriptor,
        ?string $itemQuantity,
        ?string $productCode,
        ?int $salesTaxAmount,
        ?string $salesTaxCurrency,
        ?string $salesTaxRate,
        ?int $totalAmount,
        ?string $totalAmountCurrency,
        ?string $unitCost,
        ?string $unitCostCurrency,
        ?string $unitOfMeasureCode,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['detailIndicator'] = $detailIndicator;
        $self['discountAmount'] = $discountAmount;
        $self['discountCurrency'] = $discountCurrency;
        $self['discountTreatmentCode'] = $discountTreatmentCode;
        $self['itemCommodityCode'] = $itemCommodityCode;
        $self['itemDescriptor'] = $itemDescriptor;
        $self['itemQuantity'] = $itemQuantity;
        $self['productCode'] = $productCode;
        $self['salesTaxAmount'] = $salesTaxAmount;
        $self['salesTaxCurrency'] = $salesTaxCurrency;
        $self['salesTaxRate'] = $salesTaxRate;
        $self['totalAmount'] = $totalAmount;
        $self['totalAmountCurrency'] = $totalAmountCurrency;
        $self['unitCost'] = $unitCost;
        $self['unitCostCurrency'] = $unitCostCurrency;
        $self['unitOfMeasureCode'] = $unitOfMeasureCode;

        return $self;
    }

    /**
     * The Card Purchase Supplement Line Item identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Indicates the type of line item.
     *
     * @param DetailIndicator|value-of<DetailIndicator>|null $detailIndicator
     */
    public function withDetailIndicator(
        DetailIndicator|string|null $detailIndicator
    ): self {
        $self = clone $this;
        $self['detailIndicator'] = $detailIndicator;

        return $self;
    }

    /**
     * Discount amount for this specific line item.
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
     * Indicates how the merchant applied the discount for this specific line item.
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
     * Code used to categorize the purchase item.
     */
    public function withItemCommodityCode(?string $itemCommodityCode): self
    {
        $self = clone $this;
        $self['itemCommodityCode'] = $itemCommodityCode;

        return $self;
    }

    /**
     * Description of the purchase item.
     */
    public function withItemDescriptor(?string $itemDescriptor): self
    {
        $self = clone $this;
        $self['itemDescriptor'] = $itemDescriptor;

        return $self;
    }

    /**
     * The number of units of the product being purchased.
     */
    public function withItemQuantity(?string $itemQuantity): self
    {
        $self = clone $this;
        $self['itemQuantity'] = $itemQuantity;

        return $self;
    }

    /**
     * Code used to categorize the product being purchased.
     */
    public function withProductCode(?string $productCode): self
    {
        $self = clone $this;
        $self['productCode'] = $productCode;

        return $self;
    }

    /**
     * Sales tax amount for this line item.
     */
    public function withSalesTaxAmount(?int $salesTaxAmount): self
    {
        $self = clone $this;
        $self['salesTaxAmount'] = $salesTaxAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the sales tax assessed.
     */
    public function withSalesTaxCurrency(?string $salesTaxCurrency): self
    {
        $self = clone $this;
        $self['salesTaxCurrency'] = $salesTaxCurrency;

        return $self;
    }

    /**
     * Sales tax rate for this line item.
     */
    public function withSalesTaxRate(?string $salesTaxRate): self
    {
        $self = clone $this;
        $self['salesTaxRate'] = $salesTaxRate;

        return $self;
    }

    /**
     * Total amount of all line items.
     */
    public function withTotalAmount(?int $totalAmount): self
    {
        $self = clone $this;
        $self['totalAmount'] = $totalAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the total amount.
     */
    public function withTotalAmountCurrency(?string $totalAmountCurrency): self
    {
        $self = clone $this;
        $self['totalAmountCurrency'] = $totalAmountCurrency;

        return $self;
    }

    /**
     * Cost of line item per unit of measure, in major units.
     */
    public function withUnitCost(?string $unitCost): self
    {
        $self = clone $this;
        $self['unitCost'] = $unitCost;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the unit cost.
     */
    public function withUnitCostCurrency(?string $unitCostCurrency): self
    {
        $self = clone $this;
        $self['unitCostCurrency'] = $unitCostCurrency;

        return $self;
    }

    /**
     * Code indicating unit of measure (gallons, etc.).
     */
    public function withUnitOfMeasureCode(?string $unitOfMeasureCode): self
    {
        $self = clone $this;
        $self['unitOfMeasureCode'] = $unitOfMeasureCode;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\CardPurchaseSupplements;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement\Invoice;
use Increase\CardPurchaseSupplements\CardPurchaseSupplement\LineItem;
use Increase\CardPurchaseSupplements\CardPurchaseSupplement\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Additional information about a card purchase (e.g., settlement or refund), such as level 3 line item data.
 *
 * @phpstan-import-type InvoiceShape from \Increase\CardPurchaseSupplements\CardPurchaseSupplement\Invoice
 * @phpstan-import-type LineItemShape from \Increase\CardPurchaseSupplements\CardPurchaseSupplement\LineItem
 *
 * @phpstan-type CardPurchaseSupplementShape = array{
 *   id: string,
 *   cardPaymentID: string|null,
 *   invoice: null|Invoice|InvoiceShape,
 *   lineItems: list<LineItem|LineItemShape>|null,
 *   transactionID: string,
 *   type: Type|value-of<Type>,
 * }
 */
final class CardPurchaseSupplement implements BaseModel
{
    /** @use SdkModel<CardPurchaseSupplementShape> */
    use SdkModel;

    /**
     * The Card Purchase Supplement identifier.
     */
    #[Required]
    public string $id;

    /**
     * The ID of the Card Payment this transaction belongs to.
     */
    #[Required('card_payment_id')]
    public ?string $cardPaymentID;

    /**
     * Invoice-level information about the payment.
     */
    #[Required]
    public ?Invoice $invoice;

    /**
     * Line item information, such as individual products purchased.
     *
     * @var list<LineItem>|null $lineItems
     */
    #[Required('line_items', list: LineItem::class)]
    public ?array $lineItems;

    /**
     * The ID of the transaction.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `card_purchase_supplement`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardPurchaseSupplement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardPurchaseSupplement::with(
     *   id: ...,
     *   cardPaymentID: ...,
     *   invoice: ...,
     *   lineItems: ...,
     *   transactionID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardPurchaseSupplement)
     *   ->withID(...)
     *   ->withCardPaymentID(...)
     *   ->withInvoice(...)
     *   ->withLineItems(...)
     *   ->withTransactionID(...)
     *   ->withType(...)
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
     * @param Invoice|InvoiceShape|null $invoice
     * @param list<LineItem|LineItemShape>|null $lineItems
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        ?string $cardPaymentID,
        Invoice|array|null $invoice,
        ?array $lineItems,
        string $transactionID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['cardPaymentID'] = $cardPaymentID;
        $self['invoice'] = $invoice;
        $self['lineItems'] = $lineItems;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Card Purchase Supplement identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The ID of the Card Payment this transaction belongs to.
     */
    public function withCardPaymentID(?string $cardPaymentID): self
    {
        $self = clone $this;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }

    /**
     * Invoice-level information about the payment.
     *
     * @param Invoice|InvoiceShape|null $invoice
     */
    public function withInvoice(Invoice|array|null $invoice): self
    {
        $self = clone $this;
        $self['invoice'] = $invoice;

        return $self;
    }

    /**
     * Line item information, such as individual products purchased.
     *
     * @param list<LineItem|LineItemShape>|null $lineItems
     */
    public function withLineItems(?array $lineItems): self
    {
        $self = clone $this;
        $self['lineItems'] = $lineItems;

        return $self;
    }

    /**
     * The ID of the transaction.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card_purchase_supplement`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}

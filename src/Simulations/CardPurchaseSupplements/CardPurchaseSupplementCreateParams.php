<?php

declare(strict_types=1);

namespace Increase\Simulations\CardPurchaseSupplements;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\Invoice;
use Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\LineItem;

/**
 * Simulates the creation of a Card Purchase Supplement (Level 3 data) for a card settlement. This happens asynchronously in production when Visa sends enhanced transaction data about a purchase.
 *
 * @see Increase\Services\Simulations\CardPurchaseSupplementsService::create()
 *
 * @phpstan-import-type InvoiceShape from \Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\Invoice
 * @phpstan-import-type LineItemShape from \Increase\Simulations\CardPurchaseSupplements\CardPurchaseSupplementCreateParams\LineItem
 *
 * @phpstan-type CardPurchaseSupplementCreateParamsShape = array{
 *   transactionID: string,
 *   invoice?: null|Invoice|InvoiceShape,
 *   lineItems?: list<LineItem|LineItemShape>|null,
 * }
 */
final class CardPurchaseSupplementCreateParams implements BaseModel
{
    /** @use SdkModel<CardPurchaseSupplementCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Transaction to create a Card Purchase Supplement for. The Transaction must have a source of type `card_settlement`.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * Invoice-level information about the payment.
     */
    #[Optional]
    public ?Invoice $invoice;

    /**
     * Line item information, such as individual products purchased.
     *
     * @var list<LineItem>|null $lineItems
     */
    #[Optional('line_items', list: LineItem::class)]
    public ?array $lineItems;

    /**
     * `new CardPurchaseSupplementCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardPurchaseSupplementCreateParams::with(transactionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardPurchaseSupplementCreateParams)->withTransactionID(...)
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
     */
    public static function with(
        string $transactionID,
        Invoice|array|null $invoice = null,
        ?array $lineItems = null,
    ): self {
        $self = new self;

        $self['transactionID'] = $transactionID;

        null !== $invoice && $self['invoice'] = $invoice;
        null !== $lineItems && $self['lineItems'] = $lineItems;

        return $self;
    }

    /**
     * The identifier of the Transaction to create a Card Purchase Supplement for. The Transaction must have a source of type `card_settlement`.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * Invoice-level information about the payment.
     *
     * @param Invoice|InvoiceShape $invoice
     */
    public function withInvoice(Invoice|array $invoice): self
    {
        $self = clone $this;
        $self['invoice'] = $invoice;

        return $self;
    }

    /**
     * Line item information, such as individual products purchased.
     *
     * @param list<LineItem|LineItemShape> $lineItems
     */
    public function withLineItems(array $lineItems): self
    {
        $self = clone $this;
        $self['lineItems'] = $lineItems;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams\Addenda\PaymentOrderRemittanceAdvice;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type InvoiceShape = array{invoiceNumber: string, paidAmount: int}
 */
final class Invoice implements BaseModel
{
    /** @use SdkModel<InvoiceShape> */
    use SdkModel;

    /**
     * The invoice number for this reference, determined in advance with the receiver.
     */
    #[Required('invoice_number')]
    public string $invoiceNumber;

    /**
     * The amount that was paid for this invoice in the minor unit of its currency. For dollars, for example, this is cents.
     */
    #[Required('paid_amount')]
    public int $paidAmount;

    /**
     * `new Invoice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Invoice::with(invoiceNumber: ..., paidAmount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Invoice)->withInvoiceNumber(...)->withPaidAmount(...)
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
     */
    public static function with(string $invoiceNumber, int $paidAmount): self
    {
        $self = new self;

        $self['invoiceNumber'] = $invoiceNumber;
        $self['paidAmount'] = $paidAmount;

        return $self;
    }

    /**
     * The invoice number for this reference, determined in advance with the receiver.
     */
    public function withInvoiceNumber(string $invoiceNumber): self
    {
        $self = clone $this;
        $self['invoiceNumber'] = $invoiceNumber;

        return $self;
    }

    /**
     * The amount that was paid for this invoice in the minor unit of its currency. For dollars, for example, this is cents.
     */
    public function withPaidAmount(int $paidAmount): self
    {
        $self = clone $this;
        $self['paidAmount'] = $paidAmount;

        return $self;
    }
}

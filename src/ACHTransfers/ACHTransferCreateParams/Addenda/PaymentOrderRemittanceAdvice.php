<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams\Addenda;

use Increase\ACHTransfers\ACHTransferCreateParams\Addenda\PaymentOrderRemittanceAdvice\Invoice;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Structured ASC X12 820 remittance advice records. Please reach out to [support@increase.com](mailto:support@increase.com) for more information. Required if and only if `category` is `payment_order_remittance_advice`.
 *
 * @phpstan-import-type InvoiceShape from \Increase\ACHTransfers\ACHTransferCreateParams\Addenda\PaymentOrderRemittanceAdvice\Invoice
 *
 * @phpstan-type PaymentOrderRemittanceAdviceShape = array{
 *   invoices: list<Invoice|InvoiceShape>
 * }
 */
final class PaymentOrderRemittanceAdvice implements BaseModel
{
    /** @use SdkModel<PaymentOrderRemittanceAdviceShape> */
    use SdkModel;

    /**
     * ASC X12 RMR records for this specific transfer.
     *
     * @var list<Invoice> $invoices
     */
    #[Required(list: Invoice::class)]
    public array $invoices;

    /**
     * `new PaymentOrderRemittanceAdvice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentOrderRemittanceAdvice::with(invoices: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentOrderRemittanceAdvice)->withInvoices(...)
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
     * @param list<Invoice|InvoiceShape> $invoices
     */
    public static function with(array $invoices): self
    {
        $self = new self;

        $self['invoices'] = $invoices;

        return $self;
    }

    /**
     * ASC X12 RMR records for this specific transfer.
     *
     * @param list<Invoice|InvoiceShape> $invoices
     */
    public function withInvoices(array $invoices): self
    {
        $self = clone $this;
        $self['invoices'] = $invoices;

        return $self;
    }
}

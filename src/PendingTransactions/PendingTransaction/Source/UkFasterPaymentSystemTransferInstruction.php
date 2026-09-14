<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PendingTransactions\PendingTransaction\Source\UkFasterPaymentSystemTransferInstruction\Currency;

/**
 * An UK Faster Payment System Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `uk_faster_payment_system_transfer_instruction`.
 *
 * @phpstan-type UkFasterPaymentSystemTransferInstructionShape = array{
 *   amount: int, currency: Currency|value-of<Currency>
 * }
 */
final class UkFasterPaymentSystemTransferInstruction implements BaseModel
{
    /** @use SdkModel<UkFasterPaymentSystemTransferInstructionShape> */
    use SdkModel;

    /**
     * The transfer amount in GBP pence.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code for the transfer's currency. This is always `GBP`.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * `new UkFasterPaymentSystemTransferInstruction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UkFasterPaymentSystemTransferInstruction::with(amount: ..., currency: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UkFasterPaymentSystemTransferInstruction)
     *   ->withAmount(...)
     *   ->withCurrency(...)
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
     * @param Currency|value-of<Currency> $currency
     */
    public static function with(int $amount, Currency|string $currency): self
    {
        $self = new self;

        $self['amount'] = $amount;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The transfer amount in GBP pence.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code for the transfer's currency. This is always `GBP`.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\FeePayment\Currency;

/**
 * A Fee Payment object. This field will be present in the JSON response if and only if `category` is equal to `fee_payment`. A Fee Payment represents a payment made to Increase.
 *
 * @phpstan-type FeePaymentShape = array{
 *   amount: int,
 *   currency: Currency|value-of<Currency>,
 *   feePeriodStart: string,
 *   programID: string|null,
 * }
 */
final class FeePayment implements BaseModel
{
    /** @use SdkModel<FeePaymentShape> */
    use SdkModel;

    /**
     * The amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The start of this payment's fee period, usually the first day of a month.
     */
    #[Required('fee_period_start')]
    public string $feePeriodStart;

    /**
     * The Program for which this fee was incurred.
     */
    #[Required('program_id')]
    public ?string $programID;

    /**
     * `new FeePayment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FeePayment::with(
     *   amount: ..., currency: ..., feePeriodStart: ..., programID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FeePayment)
     *   ->withAmount(...)
     *   ->withCurrency(...)
     *   ->withFeePeriodStart(...)
     *   ->withProgramID(...)
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
    public static function with(
        int $amount,
        Currency|string $currency,
        string $feePeriodStart,
        ?string $programID,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['currency'] = $currency;
        $self['feePeriodStart'] = $feePeriodStart;
        $self['programID'] = $programID;

        return $self;
    }

    /**
     * The amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction currency.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The start of this payment's fee period, usually the first day of a month.
     */
    public function withFeePeriodStart(string $feePeriodStart): self
    {
        $self = clone $this;
        $self['feePeriodStart'] = $feePeriodStart;

        return $self;
    }

    /**
     * The Program for which this fee was incurred.
     */
    public function withProgramID(?string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CashbackPayment\Currency;

/**
 * A Cashback Payment object. This field will be present in the JSON response if and only if `category` is equal to `cashback_payment`. A Cashback Payment represents the cashback paid to a cardholder for a given period. Cashback is usually paid monthly for the prior month's transactions.
 *
 * @phpstan-type CashbackPaymentShape = array{
 *   accruedOnCardID: string|null,
 *   amount: int,
 *   currency: Currency|value-of<Currency>,
 *   periodEnd: \DateTimeInterface,
 *   periodStart: \DateTimeInterface,
 * }
 */
final class CashbackPayment implements BaseModel
{
    /** @use SdkModel<CashbackPaymentShape> */
    use SdkModel;

    /**
     * The card on which the cashback was accrued.
     */
    #[Required('accrued_on_card_id')]
    public ?string $accruedOnCardID;

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
     * The end of the period for which this transaction paid cashback.
     */
    #[Required('period_end')]
    public \DateTimeInterface $periodEnd;

    /**
     * The start of the period for which this transaction paid cashback.
     */
    #[Required('period_start')]
    public \DateTimeInterface $periodStart;

    /**
     * `new CashbackPayment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CashbackPayment::with(
     *   accruedOnCardID: ...,
     *   amount: ...,
     *   currency: ...,
     *   periodEnd: ...,
     *   periodStart: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CashbackPayment)
     *   ->withAccruedOnCardID(...)
     *   ->withAmount(...)
     *   ->withCurrency(...)
     *   ->withPeriodEnd(...)
     *   ->withPeriodStart(...)
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
        ?string $accruedOnCardID,
        int $amount,
        Currency|string $currency,
        \DateTimeInterface $periodEnd,
        \DateTimeInterface $periodStart,
    ): self {
        $self = new self;

        $self['accruedOnCardID'] = $accruedOnCardID;
        $self['amount'] = $amount;
        $self['currency'] = $currency;
        $self['periodEnd'] = $periodEnd;
        $self['periodStart'] = $periodStart;

        return $self;
    }

    /**
     * The card on which the cashback was accrued.
     */
    public function withAccruedOnCardID(?string $accruedOnCardID): self
    {
        $self = clone $this;
        $self['accruedOnCardID'] = $accruedOnCardID;

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
     * The end of the period for which this transaction paid cashback.
     */
    public function withPeriodEnd(\DateTimeInterface $periodEnd): self
    {
        $self = clone $this;
        $self['periodEnd'] = $periodEnd;

        return $self;
    }

    /**
     * The start of the period for which this transaction paid cashback.
     */
    public function withPeriodStart(\DateTimeInterface $periodStart): self
    {
        $self = clone $this;
        $self['periodStart'] = $periodStart;

        return $self;
    }
}

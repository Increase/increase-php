<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardSettlement;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardSettlement\Cashback\Currency;

/**
 * Cashback earned on this transaction, if eligible. Cashback is paid out in aggregate, monthly.
 *
 * @phpstan-type CashbackShape = array{
 *   amount: string,
 *   currency: \Increase\Transactions\Transaction\Source\CardSettlement\Cashback\Currency|value-of<\Increase\Transactions\Transaction\Source\CardSettlement\Cashback\Currency>,
 * }
 */
final class Cashback implements BaseModel
{
    /** @use SdkModel<CashbackShape> */
    use SdkModel;

    /**
     * The cashback amount given as a string containing a decimal number. The amount is a positive number if it will be credited to you (e.g., settlements) and a negative number if it will be debited (e.g., refunds).
     */
    #[Required]
    public string $amount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the cashback.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(
        enum: Currency::class,
    )]
    public string $currency;

    /**
     * `new Cashback()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Cashback::with(amount: ..., currency: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Cashback)->withAmount(...)->withCurrency(...)
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
        string $amount,
        Currency|string $currency,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The cashback amount given as a string containing a decimal number. The amount is a positive number if it will be credited to you (e.g., settlements) and a negative number if it will be debited (e.g., refunds).
     */
    public function withAmount(string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the cashback.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(
        Currency|string $currency,
    ): self {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }
}

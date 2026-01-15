<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardRefund;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardRefund\Interchange\Currency;

/**
 * Interchange assessed as a part of this transaciton.
 *
 * @phpstan-type InterchangeShape = array{
 *   amount: string,
 *   code: string|null,
 *   currency: \Increase\Transactions\Transaction\Source\CardRefund\Interchange\Currency|value-of<\Increase\Transactions\Transaction\Source\CardRefund\Interchange\Currency>,
 * }
 */
final class Interchange implements BaseModel
{
    /** @use SdkModel<InterchangeShape> */
    use SdkModel;

    /**
     * The interchange amount given as a string containing a decimal number in major units (so e.g., "3.14" for $3.14). The amount is a positive number if it is credited to Increase (e.g., settlements) and a negative number if it is debited (e.g., refunds).
     */
    #[Required]
    public string $amount;

    /**
     * The card network specific interchange code.
     */
    #[Required]
    public ?string $code;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the interchange reimbursement.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(
        enum: Currency::class,
    )]
    public string $currency;

    /**
     * `new Interchange()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Interchange::with(amount: ..., code: ..., currency: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Interchange)->withAmount(...)->withCode(...)->withCurrency(...)
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
        ?string $code,
        Currency|string $currency,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['code'] = $code;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The interchange amount given as a string containing a decimal number in major units (so e.g., "3.14" for $3.14). The amount is a positive number if it is credited to Increase (e.g., settlements) and a negative number if it is debited (e.g., refunds).
     */
    public function withAmount(string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The card network specific interchange code.
     */
    public function withCode(?string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the interchange reimbursement.
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

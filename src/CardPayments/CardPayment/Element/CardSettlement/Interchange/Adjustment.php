<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardSettlement\Interchange;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An adjustment the card network made to the interchange after this transaction cleared, if any.
 *
 * @phpstan-type AdjustmentShape = array{
 *   adjustedAt: \DateTimeInterface, amount: string, code: string
 * }
 */
final class Adjustment implements BaseModel
{
    /** @use SdkModel<AdjustmentShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the interchange was adjusted.
     */
    #[Required('adjusted_at')]
    public \DateTimeInterface $adjustedAt;

    /**
     * The adjustment amount given as a string containing a decimal number in major units (so e.g., "3.14" for $3.14). The amount is a positive number if it is credited to Increase and a negative number if it is debited.
     */
    #[Required]
    public string $amount;

    /**
     * The card network specific interchange code that applies after the adjustment.
     */
    #[Required]
    public string $code;

    /**
     * `new Adjustment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Adjustment::with(adjustedAt: ..., amount: ..., code: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Adjustment)->withAdjustedAt(...)->withAmount(...)->withCode(...)
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
    public static function with(
        \DateTimeInterface $adjustedAt,
        string $amount,
        string $code
    ): self {
        $self = new self;

        $self['adjustedAt'] = $adjustedAt;
        $self['amount'] = $amount;
        $self['code'] = $code;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the interchange was adjusted.
     */
    public function withAdjustedAt(\DateTimeInterface $adjustedAt): self
    {
        $self = clone $this;
        $self['adjustedAt'] = $adjustedAt;

        return $self;
    }

    /**
     * The adjustment amount given as a string containing a decimal number in major units (so e.g., "3.14" for $3.14). The amount is a positive number if it is credited to Increase and a negative number if it is debited.
     */
    public function withAmount(string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The card network specific interchange code that applies after the adjustment.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }
}

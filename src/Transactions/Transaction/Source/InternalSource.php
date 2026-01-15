<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\InternalSource\Currency;
use Increase\Transactions\Transaction\Source\InternalSource\Reason;

/**
 * An Internal Source object. This field will be present in the JSON response if and only if `category` is equal to `internal_source`. A transaction between the user and Increase. See the `reason` attribute for more information.
 *
 * @phpstan-type InternalSourceShape = array{
 *   amount: int,
 *   currency: Currency|value-of<Currency>,
 *   reason: Reason|value-of<Reason>,
 * }
 */
final class InternalSource implements BaseModel
{
    /** @use SdkModel<InternalSourceShape> */
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
     * An Internal Source is a transaction between you and Increase. This describes the reason for the transaction.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new InternalSource()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InternalSource::with(amount: ..., currency: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InternalSource)->withAmount(...)->withCurrency(...)->withReason(...)
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
     * @param Reason|value-of<Reason> $reason
     */
    public static function with(
        int $amount,
        Currency|string $currency,
        Reason|string $reason
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['currency'] = $currency;
        $self['reason'] = $reason;

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
     * An Internal Source is a transaction between you and Increase. This describes the reason for the transaction.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}

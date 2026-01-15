<?php

declare(strict_types=1);

namespace Increase\CardPushTransfers\CardPushTransfer;

use Increase\CardPushTransfers\CardPushTransfer\PresentmentAmount\Currency;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The amount that was transferred. The receiving bank will have converted this to the cardholder's currency. The amount that is applied to your Increase account matches the currency of your account.
 *
 * @phpstan-type PresentmentAmountShape = array{
 *   currency: Currency|value-of<Currency>, value: string
 * }
 */
final class PresentmentAmount implements BaseModel
{
    /** @use SdkModel<PresentmentAmountShape> */
    use SdkModel;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The amount value represented as a string containing a decimal number in major units (so e.g., "12.34" for $12.34).
     */
    #[Required]
    public string $value;

    /**
     * `new PresentmentAmount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PresentmentAmount::with(currency: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PresentmentAmount)->withCurrency(...)->withValue(...)
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
    public static function with(Currency|string $currency, string $value): self
    {
        $self = new self;

        $self['currency'] = $currency;
        $self['value'] = $value;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code.
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
     * The amount value represented as a string containing a decimal number in major units (so e.g., "12.34" for $12.34).
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}

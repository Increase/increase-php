<?php

declare(strict_types=1);

namespace Increase\CardPushTransfers\CardPushTransferCreateParams;

use Increase\CardPushTransfers\CardPushTransferCreateParams\PresentmentAmount\Currency;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The amount to transfer. The receiving bank will convert this to the cardholder's currency. The amount that is applied to your Increase account matches the currency of your account.
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
     * The ISO 4217 currency code representing the currency of the amount.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The amount value as a decimal string in the currency's major unit. For example, for USD, '1234.56' represents 1234 dollars and 56 cents. For JPY, '1234' represents 1234 yen. A currency with minor units requires at least one decimal place and supports up to the number of decimal places defined by the currency's minor units. A currency without minor units does not support any decimal places.
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
     * The ISO 4217 currency code representing the currency of the amount.
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
     * The amount value as a decimal string in the currency's major unit. For example, for USD, '1234.56' represents 1234 dollars and 56 cents. For JPY, '1234' represents 1234 yen. A currency with minor units requires at least one decimal place and supports up to the number of decimal places defined by the currency's minor units. A currency without minor units does not support any decimal places.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}

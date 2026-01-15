<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthorization\AdditionalAmounts;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The original pre-authorized amount.
 *
 * @phpstan-type OriginalShape = array{amount: int, currency: string}
 */
final class Original implements BaseModel
{
    /** @use SdkModel<OriginalShape> */
    use SdkModel;

    /**
     * The amount in minor units of the `currency` field. The amount is positive if it is added to the amount (such as an ATM surcharge fee) and negative if it is subtracted from the amount (such as a discount).
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the additional amount's currency.
     */
    #[Required]
    public string $currency;

    /**
     * `new Original()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Original::with(amount: ..., currency: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Original)->withAmount(...)->withCurrency(...)
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
    public static function with(int $amount, string $currency): self
    {
        $self = new self;

        $self['amount'] = $amount;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The amount in minor units of the `currency` field. The amount is positive if it is added to the amount (such as an ATM surcharge fee) and negative if it is subtracted from the amount (such as a discount).
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the additional amount's currency.
     */
    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }
}

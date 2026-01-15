<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardRevenuePayment\Currency;

/**
 * A Card Revenue Payment object. This field will be present in the JSON response if and only if `category` is equal to `card_revenue_payment`. Card Revenue Payments reflect earnings from fees on card transactions.
 *
 * @phpstan-type CardRevenuePaymentShape = array{
 *   amount: int,
 *   currency: Currency|value-of<Currency>,
 *   periodEnd: \DateTimeInterface,
 *   periodStart: \DateTimeInterface,
 *   transactedOnAccountID: string|null,
 * }
 */
final class CardRevenuePayment implements BaseModel
{
    /** @use SdkModel<CardRevenuePaymentShape> */
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
     * The end of the period for which this transaction paid interest.
     */
    #[Required('period_end')]
    public \DateTimeInterface $periodEnd;

    /**
     * The start of the period for which this transaction paid interest.
     */
    #[Required('period_start')]
    public \DateTimeInterface $periodStart;

    /**
     * The account the card belonged to.
     */
    #[Required('transacted_on_account_id')]
    public ?string $transactedOnAccountID;

    /**
     * `new CardRevenuePayment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardRevenuePayment::with(
     *   amount: ...,
     *   currency: ...,
     *   periodEnd: ...,
     *   periodStart: ...,
     *   transactedOnAccountID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardRevenuePayment)
     *   ->withAmount(...)
     *   ->withCurrency(...)
     *   ->withPeriodEnd(...)
     *   ->withPeriodStart(...)
     *   ->withTransactedOnAccountID(...)
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
        \DateTimeInterface $periodEnd,
        \DateTimeInterface $periodStart,
        ?string $transactedOnAccountID,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['currency'] = $currency;
        $self['periodEnd'] = $periodEnd;
        $self['periodStart'] = $periodStart;
        $self['transactedOnAccountID'] = $transactedOnAccountID;

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
     * The end of the period for which this transaction paid interest.
     */
    public function withPeriodEnd(\DateTimeInterface $periodEnd): self
    {
        $self = clone $this;
        $self['periodEnd'] = $periodEnd;

        return $self;
    }

    /**
     * The start of the period for which this transaction paid interest.
     */
    public function withPeriodStart(\DateTimeInterface $periodStart): self
    {
        $self = clone $this;
        $self['periodStart'] = $periodStart;

        return $self;
    }

    /**
     * The account the card belonged to.
     */
    public function withTransactedOnAccountID(
        ?string $transactedOnAccountID
    ): self {
        $self = clone $this;
        $self['transactedOnAccountID'] = $transactedOnAccountID;

        return $self;
    }
}

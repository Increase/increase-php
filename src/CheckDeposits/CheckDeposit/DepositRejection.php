<?php

declare(strict_types=1);

namespace Increase\CheckDeposits\CheckDeposit;

use Increase\CheckDeposits\CheckDeposit\DepositRejection\Currency;
use Increase\CheckDeposits\CheckDeposit\DepositRejection\Reason;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your deposit is rejected by Increase, this will contain details as to why it was rejected.
 *
 * @phpstan-type DepositRejectionShape = array{
 *   amount: int,
 *   checkDepositID: string,
 *   currency: Currency|value-of<Currency>,
 *   declinedTransactionID: string,
 *   reason: Reason|value-of<Reason>,
 *   rejectedAt: \DateTimeInterface,
 * }
 */
final class DepositRejection implements BaseModel
{
    /** @use SdkModel<DepositRejectionShape> */
    use SdkModel;

    /**
     * The rejected amount in the minor unit of check's currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the Check Deposit that was rejected.
     */
    #[Required('check_deposit_id')]
    public string $checkDepositID;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the check's currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The identifier of the associated declined transaction.
     */
    #[Required('declined_transaction_id')]
    public string $declinedTransactionID;

    /**
     * Why the check deposit was rejected.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the check deposit was rejected.
     */
    #[Required('rejected_at')]
    public \DateTimeInterface $rejectedAt;

    /**
     * `new DepositRejection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DepositRejection::with(
     *   amount: ...,
     *   checkDepositID: ...,
     *   currency: ...,
     *   declinedTransactionID: ...,
     *   reason: ...,
     *   rejectedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DepositRejection)
     *   ->withAmount(...)
     *   ->withCheckDepositID(...)
     *   ->withCurrency(...)
     *   ->withDeclinedTransactionID(...)
     *   ->withReason(...)
     *   ->withRejectedAt(...)
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
        string $checkDepositID,
        Currency|string $currency,
        string $declinedTransactionID,
        Reason|string $reason,
        \DateTimeInterface $rejectedAt,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['checkDepositID'] = $checkDepositID;
        $self['currency'] = $currency;
        $self['declinedTransactionID'] = $declinedTransactionID;
        $self['reason'] = $reason;
        $self['rejectedAt'] = $rejectedAt;

        return $self;
    }

    /**
     * The rejected amount in the minor unit of check's currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Check Deposit that was rejected.
     */
    public function withCheckDepositID(string $checkDepositID): self
    {
        $self = clone $this;
        $self['checkDepositID'] = $checkDepositID;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the check's currency.
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
     * The identifier of the associated declined transaction.
     */
    public function withDeclinedTransactionID(
        string $declinedTransactionID
    ): self {
        $self = clone $this;
        $self['declinedTransactionID'] = $declinedTransactionID;

        return $self;
    }

    /**
     * Why the check deposit was rejected.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the check deposit was rejected.
     */
    public function withRejectedAt(\DateTimeInterface $rejectedAt): self
    {
        $self = clone $this;
        $self['rejectedAt'] = $rejectedAt;

        return $self;
    }
}

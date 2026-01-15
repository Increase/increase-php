<?php

declare(strict_types=1);

namespace Increase\CheckDeposits\CheckDeposit;

use Increase\CheckDeposits\CheckDeposit\DepositReturn\Currency;
use Increase\CheckDeposits\CheckDeposit\DepositReturn\ReturnReason;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your deposit is returned, this will contain details as to why it was returned.
 *
 * @phpstan-type DepositReturnShape = array{
 *   amount: int,
 *   checkDepositID: string,
 *   currency: Currency|value-of<Currency>,
 *   returnReason: ReturnReason|value-of<ReturnReason>,
 *   returnedAt: \DateTimeInterface,
 *   transactionID: string,
 * }
 */
final class DepositReturn implements BaseModel
{
    /** @use SdkModel<DepositReturnShape> */
    use SdkModel;

    /**
     * The returned amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the Check Deposit that was returned.
     */
    #[Required('check_deposit_id')]
    public string $checkDepositID;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Why this check was returned by the bank holding the account it was drawn against.
     *
     * @var value-of<ReturnReason> $returnReason
     */
    #[Required('return_reason', enum: ReturnReason::class)]
    public string $returnReason;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the check deposit was returned.
     */
    #[Required('returned_at')]
    public \DateTimeInterface $returnedAt;

    /**
     * The identifier of the transaction that reversed the original check deposit transaction.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * `new DepositReturn()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DepositReturn::with(
     *   amount: ...,
     *   checkDepositID: ...,
     *   currency: ...,
     *   returnReason: ...,
     *   returnedAt: ...,
     *   transactionID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DepositReturn)
     *   ->withAmount(...)
     *   ->withCheckDepositID(...)
     *   ->withCurrency(...)
     *   ->withReturnReason(...)
     *   ->withReturnedAt(...)
     *   ->withTransactionID(...)
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
     * @param ReturnReason|value-of<ReturnReason> $returnReason
     */
    public static function with(
        int $amount,
        string $checkDepositID,
        Currency|string $currency,
        ReturnReason|string $returnReason,
        \DateTimeInterface $returnedAt,
        string $transactionID,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['checkDepositID'] = $checkDepositID;
        $self['currency'] = $currency;
        $self['returnReason'] = $returnReason;
        $self['returnedAt'] = $returnedAt;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * The returned amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Check Deposit that was returned.
     */
    public function withCheckDepositID(string $checkDepositID): self
    {
        $self = clone $this;
        $self['checkDepositID'] = $checkDepositID;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's currency.
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
     * Why this check was returned by the bank holding the account it was drawn against.
     *
     * @param ReturnReason|value-of<ReturnReason> $returnReason
     */
    public function withReturnReason(ReturnReason|string $returnReason): self
    {
        $self = clone $this;
        $self['returnReason'] = $returnReason;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the check deposit was returned.
     */
    public function withReturnedAt(\DateTimeInterface $returnedAt): self
    {
        $self = clone $this;
        $self['returnedAt'] = $returnedAt;

        return $self;
    }

    /**
     * The identifier of the transaction that reversed the original check deposit transaction.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}

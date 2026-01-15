<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * An Account Revenue Payment object. This field will be present in the JSON response if and only if `category` is equal to `account_revenue_payment`. An Account Revenue Payment represents a payment made to an account from the bank. Account revenue is a type of non-interest income.
 *
 * @phpstan-type AccountRevenuePaymentShape = array{
 *   accruedOnAccountID: string,
 *   periodEnd: \DateTimeInterface,
 *   periodStart: \DateTimeInterface,
 * }
 */
final class AccountRevenuePayment implements BaseModel
{
    /** @use SdkModel<AccountRevenuePaymentShape> */
    use SdkModel;

    /**
     * The account on which the account revenue was accrued.
     */
    #[Required('accrued_on_account_id')]
    public string $accruedOnAccountID;

    /**
     * The end of the period for which this transaction paid account revenue.
     */
    #[Required('period_end')]
    public \DateTimeInterface $periodEnd;

    /**
     * The start of the period for which this transaction paid account revenue.
     */
    #[Required('period_start')]
    public \DateTimeInterface $periodStart;

    /**
     * `new AccountRevenuePayment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountRevenuePayment::with(
     *   accruedOnAccountID: ..., periodEnd: ..., periodStart: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountRevenuePayment)
     *   ->withAccruedOnAccountID(...)
     *   ->withPeriodEnd(...)
     *   ->withPeriodStart(...)
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
        string $accruedOnAccountID,
        \DateTimeInterface $periodEnd,
        \DateTimeInterface $periodStart,
    ): self {
        $self = new self;

        $self['accruedOnAccountID'] = $accruedOnAccountID;
        $self['periodEnd'] = $periodEnd;
        $self['periodStart'] = $periodStart;

        return $self;
    }

    /**
     * The account on which the account revenue was accrued.
     */
    public function withAccruedOnAccountID(string $accruedOnAccountID): self
    {
        $self = clone $this;
        $self['accruedOnAccountID'] = $accruedOnAccountID;

        return $self;
    }

    /**
     * The end of the period for which this transaction paid account revenue.
     */
    public function withPeriodEnd(\DateTimeInterface $periodEnd): self
    {
        $self = clone $this;
        $self['periodEnd'] = $periodEnd;

        return $self;
    }

    /**
     * The start of the period for which this transaction paid account revenue.
     */
    public function withPeriodStart(\DateTimeInterface $periodStart): self
    {
        $self = clone $this;
        $self['periodStart'] = $periodStart;

        return $self;
    }
}

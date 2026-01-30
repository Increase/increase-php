<?php

declare(strict_types=1);

namespace Increase\Accounts\AccountCreateParams;

use Increase\Accounts\AccountCreateParams\Loan\StatementPaymentType;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The loan details for the account.
 *
 * @phpstan-type LoanShape = array{
 *   creditLimit: int,
 *   gracePeriodDays: int,
 *   statementDayOfMonth: int,
 *   statementPaymentType: StatementPaymentType|value-of<StatementPaymentType>,
 *   maturityDate?: string|null,
 * }
 */
final class Loan implements BaseModel
{
    /** @use SdkModel<LoanShape> */
    use SdkModel;

    /**
     * The maximum amount of money that can be drawn from the Account.
     */
    #[Required('credit_limit')]
    public int $creditLimit;

    /**
     * The number of days after the statement date that the Account can be past due before being considered delinquent.
     */
    #[Required('grace_period_days')]
    public int $gracePeriodDays;

    /**
     * The day of the month on which the loan statement is generated.
     */
    #[Required('statement_day_of_month')]
    public int $statementDayOfMonth;

    /**
     * The type of statement payment for the account.
     *
     * @var value-of<StatementPaymentType> $statementPaymentType
     */
    #[Required('statement_payment_type', enum: StatementPaymentType::class)]
    public string $statementPaymentType;

    /**
     * The date on which the loan matures.
     */
    #[Optional('maturity_date')]
    public ?string $maturityDate;

    /**
     * `new Loan()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Loan::with(
     *   creditLimit: ...,
     *   gracePeriodDays: ...,
     *   statementDayOfMonth: ...,
     *   statementPaymentType: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Loan)
     *   ->withCreditLimit(...)
     *   ->withGracePeriodDays(...)
     *   ->withStatementDayOfMonth(...)
     *   ->withStatementPaymentType(...)
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
     * @param StatementPaymentType|value-of<StatementPaymentType> $statementPaymentType
     */
    public static function with(
        int $creditLimit,
        int $gracePeriodDays,
        int $statementDayOfMonth,
        StatementPaymentType|string $statementPaymentType,
        ?string $maturityDate = null,
    ): self {
        $self = new self;

        $self['creditLimit'] = $creditLimit;
        $self['gracePeriodDays'] = $gracePeriodDays;
        $self['statementDayOfMonth'] = $statementDayOfMonth;
        $self['statementPaymentType'] = $statementPaymentType;

        null !== $maturityDate && $self['maturityDate'] = $maturityDate;

        return $self;
    }

    /**
     * The maximum amount of money that can be drawn from the Account.
     */
    public function withCreditLimit(int $creditLimit): self
    {
        $self = clone $this;
        $self['creditLimit'] = $creditLimit;

        return $self;
    }

    /**
     * The number of days after the statement date that the Account can be past due before being considered delinquent.
     */
    public function withGracePeriodDays(int $gracePeriodDays): self
    {
        $self = clone $this;
        $self['gracePeriodDays'] = $gracePeriodDays;

        return $self;
    }

    /**
     * The day of the month on which the loan statement is generated.
     */
    public function withStatementDayOfMonth(int $statementDayOfMonth): self
    {
        $self = clone $this;
        $self['statementDayOfMonth'] = $statementDayOfMonth;

        return $self;
    }

    /**
     * The type of statement payment for the account.
     *
     * @param StatementPaymentType|value-of<StatementPaymentType> $statementPaymentType
     */
    public function withStatementPaymentType(
        StatementPaymentType|string $statementPaymentType
    ): self {
        $self = clone $this;
        $self['statementPaymentType'] = $statementPaymentType;

        return $self;
    }

    /**
     * The date on which the loan matures.
     */
    public function withMaturityDate(string $maturityDate): self
    {
        $self = clone $this;
        $self['maturityDate'] = $maturityDate;

        return $self;
    }
}

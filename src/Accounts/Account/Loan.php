<?php

declare(strict_types=1);

namespace Increase\Accounts\Account;

use Increase\Accounts\Account\Loan\StatementPaymentType;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The Account's loan-related information, if the Account is a loan account.
 *
 * @phpstan-type LoanShape = array{
 *   creditLimit: int,
 *   gracePeriodDays: int,
 *   maturityDate: string|null,
 *   statementDayOfMonth: int,
 *   statementPaymentType: StatementPaymentType|value-of<StatementPaymentType>,
 * }
 */
final class Loan implements BaseModel
{
    /** @use SdkModel<LoanShape> */
    use SdkModel;

    /**
     * The maximum amount of money that can be borrowed on the Account.
     */
    #[Required('credit_limit')]
    public int $creditLimit;

    /**
     * The number of days after the statement date that the Account can be past due before being considered delinquent.
     */
    #[Required('grace_period_days')]
    public int $gracePeriodDays;

    /**
     * The date on which the loan matures.
     */
    #[Required('maturity_date')]
    public ?string $maturityDate;

    /**
     * The day of the month on which the loan statement is generated.
     */
    #[Required('statement_day_of_month')]
    public int $statementDayOfMonth;

    /**
     * The type of payment for the loan.
     *
     * @var value-of<StatementPaymentType> $statementPaymentType
     */
    #[Required('statement_payment_type', enum: StatementPaymentType::class)]
    public string $statementPaymentType;

    /**
     * `new Loan()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Loan::with(
     *   creditLimit: ...,
     *   gracePeriodDays: ...,
     *   maturityDate: ...,
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
     *   ->withMaturityDate(...)
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
        ?string $maturityDate,
        int $statementDayOfMonth,
        StatementPaymentType|string $statementPaymentType,
    ): self {
        $self = new self;

        $self['creditLimit'] = $creditLimit;
        $self['gracePeriodDays'] = $gracePeriodDays;
        $self['maturityDate'] = $maturityDate;
        $self['statementDayOfMonth'] = $statementDayOfMonth;
        $self['statementPaymentType'] = $statementPaymentType;

        return $self;
    }

    /**
     * The maximum amount of money that can be borrowed on the Account.
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
     * The date on which the loan matures.
     */
    public function withMaturityDate(?string $maturityDate): self
    {
        $self = clone $this;
        $self['maturityDate'] = $maturityDate;

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
     * The type of payment for the loan.
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
}

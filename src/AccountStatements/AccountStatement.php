<?php

declare(strict_types=1);

namespace Increase\AccountStatements;

use Increase\AccountStatements\AccountStatement\Loan;
use Increase\AccountStatements\AccountStatement\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Account Statements are generated monthly for every active Account. You can access the statement's data via the API or retrieve a PDF with its details via its associated File.
 *
 * @phpstan-import-type LoanShape from \Increase\AccountStatements\AccountStatement\Loan
 *
 * @phpstan-type AccountStatementShape = array{
 *   id: string,
 *   accountID: string,
 *   createdAt: \DateTimeInterface,
 *   endingBalance: int,
 *   fileID: string,
 *   loan: null|Loan|LoanShape,
 *   startingBalance: int,
 *   statementPeriodEnd: \DateTimeInterface,
 *   statementPeriodStart: \DateTimeInterface,
 *   type: Type|value-of<Type>,
 * }
 */
final class AccountStatement implements BaseModel
{
    /** @use SdkModel<AccountStatementShape> */
    use SdkModel;

    /**
     * The Account Statement identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the Account this Account Statement belongs to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Account Statement was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The Account's balance at the start of its statement period.
     */
    #[Required('ending_balance')]
    public int $endingBalance;

    /**
     * The identifier of the File containing a PDF of the statement.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * The loan balances.
     */
    #[Required]
    public ?Loan $loan;

    /**
     * The Account's balance at the start of its statement period.
     */
    #[Required('starting_balance')]
    public int $startingBalance;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time representing the end of the period the Account Statement covers.
     */
    #[Required('statement_period_end')]
    public \DateTimeInterface $statementPeriodEnd;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time representing the start of the period the Account Statement covers.
     */
    #[Required('statement_period_start')]
    public \DateTimeInterface $statementPeriodStart;

    /**
     * A constant representing the object's type. For this resource it will always be `account_statement`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new AccountStatement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountStatement::with(
     *   id: ...,
     *   accountID: ...,
     *   createdAt: ...,
     *   endingBalance: ...,
     *   fileID: ...,
     *   loan: ...,
     *   startingBalance: ...,
     *   statementPeriodEnd: ...,
     *   statementPeriodStart: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountStatement)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withCreatedAt(...)
     *   ->withEndingBalance(...)
     *   ->withFileID(...)
     *   ->withLoan(...)
     *   ->withStartingBalance(...)
     *   ->withStatementPeriodEnd(...)
     *   ->withStatementPeriodStart(...)
     *   ->withType(...)
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
     * @param Loan|LoanShape|null $loan
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        \DateTimeInterface $createdAt,
        int $endingBalance,
        string $fileID,
        Loan|array|null $loan,
        int $startingBalance,
        \DateTimeInterface $statementPeriodEnd,
        \DateTimeInterface $statementPeriodStart,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['createdAt'] = $createdAt;
        $self['endingBalance'] = $endingBalance;
        $self['fileID'] = $fileID;
        $self['loan'] = $loan;
        $self['startingBalance'] = $startingBalance;
        $self['statementPeriodEnd'] = $statementPeriodEnd;
        $self['statementPeriodStart'] = $statementPeriodStart;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Account Statement identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the Account this Account Statement belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Account Statement was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The Account's balance at the start of its statement period.
     */
    public function withEndingBalance(int $endingBalance): self
    {
        $self = clone $this;
        $self['endingBalance'] = $endingBalance;

        return $self;
    }

    /**
     * The identifier of the File containing a PDF of the statement.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * The loan balances.
     *
     * @param Loan|LoanShape|null $loan
     */
    public function withLoan(Loan|array|null $loan): self
    {
        $self = clone $this;
        $self['loan'] = $loan;

        return $self;
    }

    /**
     * The Account's balance at the start of its statement period.
     */
    public function withStartingBalance(int $startingBalance): self
    {
        $self = clone $this;
        $self['startingBalance'] = $startingBalance;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time representing the end of the period the Account Statement covers.
     */
    public function withStatementPeriodEnd(
        \DateTimeInterface $statementPeriodEnd
    ): self {
        $self = clone $this;
        $self['statementPeriodEnd'] = $statementPeriodEnd;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time representing the start of the period the Account Statement covers.
     */
    public function withStatementPeriodStart(
        \DateTimeInterface $statementPeriodStart
    ): self {
        $self = clone $this;
        $self['statementPeriodStart'] = $statementPeriodStart;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `account_statement`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}

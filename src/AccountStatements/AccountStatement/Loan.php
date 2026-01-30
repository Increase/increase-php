<?php

declare(strict_types=1);

namespace Increase\AccountStatements\AccountStatement;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The loan balances.
 *
 * @phpstan-type LoanShape = array{
 *   dueAt: \DateTimeInterface|null, dueBalance: int, pastDueBalance: int
 * }
 */
final class Loan implements BaseModel
{
    /** @use SdkModel<LoanShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the loan payment is due.
     */
    #[Required('due_at')]
    public ?\DateTimeInterface $dueAt;

    /**
     * The total amount due on the loan.
     */
    #[Required('due_balance')]
    public int $dueBalance;

    /**
     * The amount past due on the loan.
     */
    #[Required('past_due_balance')]
    public int $pastDueBalance;

    /**
     * `new Loan()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Loan::with(dueAt: ..., dueBalance: ..., pastDueBalance: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Loan)->withDueAt(...)->withDueBalance(...)->withPastDueBalance(...)
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
        ?\DateTimeInterface $dueAt,
        int $dueBalance,
        int $pastDueBalance
    ): self {
        $self = new self;

        $self['dueAt'] = $dueAt;
        $self['dueBalance'] = $dueBalance;
        $self['pastDueBalance'] = $pastDueBalance;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the loan payment is due.
     */
    public function withDueAt(?\DateTimeInterface $dueAt): self
    {
        $self = clone $this;
        $self['dueAt'] = $dueAt;

        return $self;
    }

    /**
     * The total amount due on the loan.
     */
    public function withDueBalance(int $dueBalance): self
    {
        $self = clone $this;
        $self['dueBalance'] = $dueBalance;

        return $self;
    }

    /**
     * The amount past due on the loan.
     */
    public function withPastDueBalance(int $pastDueBalance): self
    {
        $self = clone $this;
        $self['pastDueBalance'] = $pastDueBalance;

        return $self;
    }
}

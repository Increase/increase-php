<?php

declare(strict_types=1);

namespace Increase\Accounts\BalanceLookup;

use Increase\Accounts\BalanceLookup\Loan\Receivables;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The loan balances for the Account.
 *
 * @phpstan-import-type ReceivablesShape from \Increase\Accounts\BalanceLookup\Loan\Receivables
 *
 * @phpstan-type LoanShape = array{
 *   dueAt: \DateTimeInterface|null,
 *   dueBalance: int,
 *   pastDueBalance: int,
 *   receivables: null|Receivables|ReceivablesShape,
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
     * The receivables balances for the loan.
     */
    #[Required]
    public ?Receivables $receivables;

    /**
     * `new Loan()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Loan::with(dueAt: ..., dueBalance: ..., pastDueBalance: ..., receivables: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Loan)
     *   ->withDueAt(...)
     *   ->withDueBalance(...)
     *   ->withPastDueBalance(...)
     *   ->withReceivables(...)
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
     * @param Receivables|ReceivablesShape|null $receivables
     */
    public static function with(
        ?\DateTimeInterface $dueAt,
        int $dueBalance,
        int $pastDueBalance,
        Receivables|array|null $receivables,
    ): self {
        $self = new self;

        $self['dueAt'] = $dueAt;
        $self['dueBalance'] = $dueBalance;
        $self['pastDueBalance'] = $pastDueBalance;
        $self['receivables'] = $receivables;

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

    /**
     * The receivables balances for the loan.
     *
     * @param Receivables|ReceivablesShape|null $receivables
     */
    public function withReceivables(Receivables|array|null $receivables): self
    {
        $self = clone $this;
        $self['receivables'] = $receivables;

        return $self;
    }
}

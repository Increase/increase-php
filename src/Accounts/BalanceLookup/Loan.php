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
 *   dueFees: int|null,
 *   dueInterest: int|null,
 *   duePrincipal: int|null,
 *   notDueFees: int|null,
 *   notDueInterest: int|null,
 *   notDuePrincipal: int|null,
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
     * The fees on the loan that are due and unpaid.
     */
    #[Required('due_fees')]
    public ?int $dueFees;

    /**
     * The interest on the loan that is due and unpaid.
     */
    #[Required('due_interest')]
    public ?int $dueInterest;

    /**
     * The principal on the loan that is due and unpaid.
     */
    #[Required('due_principal')]
    public ?int $duePrincipal;

    /**
     * The fees on the loan that are not yet due.
     */
    #[Required('not_due_fees')]
    public ?int $notDueFees;

    /**
     * The interest on the loan that is not yet due.
     */
    #[Required('not_due_interest')]
    public ?int $notDueInterest;

    /**
     * The principal on the loan that is not yet due.
     */
    #[Required('not_due_principal')]
    public ?int $notDuePrincipal;

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
     * Loan::with(
     *   dueAt: ...,
     *   dueBalance: ...,
     *   dueFees: ...,
     *   dueInterest: ...,
     *   duePrincipal: ...,
     *   notDueFees: ...,
     *   notDueInterest: ...,
     *   notDuePrincipal: ...,
     *   pastDueBalance: ...,
     *   receivables: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Loan)
     *   ->withDueAt(...)
     *   ->withDueBalance(...)
     *   ->withDueFees(...)
     *   ->withDueInterest(...)
     *   ->withDuePrincipal(...)
     *   ->withNotDueFees(...)
     *   ->withNotDueInterest(...)
     *   ->withNotDuePrincipal(...)
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
        ?int $dueFees,
        ?int $dueInterest,
        ?int $duePrincipal,
        ?int $notDueFees,
        ?int $notDueInterest,
        ?int $notDuePrincipal,
        int $pastDueBalance,
        Receivables|array|null $receivables,
    ): self {
        $self = new self;

        $self['dueAt'] = $dueAt;
        $self['dueBalance'] = $dueBalance;
        $self['dueFees'] = $dueFees;
        $self['dueInterest'] = $dueInterest;
        $self['duePrincipal'] = $duePrincipal;
        $self['notDueFees'] = $notDueFees;
        $self['notDueInterest'] = $notDueInterest;
        $self['notDuePrincipal'] = $notDuePrincipal;
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
     * The fees on the loan that are due and unpaid.
     */
    public function withDueFees(?int $dueFees): self
    {
        $self = clone $this;
        $self['dueFees'] = $dueFees;

        return $self;
    }

    /**
     * The interest on the loan that is due and unpaid.
     */
    public function withDueInterest(?int $dueInterest): self
    {
        $self = clone $this;
        $self['dueInterest'] = $dueInterest;

        return $self;
    }

    /**
     * The principal on the loan that is due and unpaid.
     */
    public function withDuePrincipal(?int $duePrincipal): self
    {
        $self = clone $this;
        $self['duePrincipal'] = $duePrincipal;

        return $self;
    }

    /**
     * The fees on the loan that are not yet due.
     */
    public function withNotDueFees(?int $notDueFees): self
    {
        $self = clone $this;
        $self['notDueFees'] = $notDueFees;

        return $self;
    }

    /**
     * The interest on the loan that is not yet due.
     */
    public function withNotDueInterest(?int $notDueInterest): self
    {
        $self = clone $this;
        $self['notDueInterest'] = $notDueInterest;

        return $self;
    }

    /**
     * The principal on the loan that is not yet due.
     */
    public function withNotDuePrincipal(?int $notDuePrincipal): self
    {
        $self = clone $this;
        $self['notDuePrincipal'] = $notDuePrincipal;

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

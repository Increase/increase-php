<?php

declare(strict_types=1);

namespace Increase\Accounts\BalanceLookup;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The loan balances for the Account.
 *
 * @phpstan-type LoanShape = array{
 *   dueFees: int|null,
 *   dueInterest: int|null,
 *   duePrincipal: int|null,
 *   notDueFees: int|null,
 *   notDueInterest: int|null,
 *   notDuePrincipal: int|null,
 * }
 */
final class Loan implements BaseModel
{
    /** @use SdkModel<LoanShape> */
    use SdkModel;

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
     * `new Loan()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Loan::with(
     *   dueFees: ...,
     *   dueInterest: ...,
     *   duePrincipal: ...,
     *   notDueFees: ...,
     *   notDueInterest: ...,
     *   notDuePrincipal: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Loan)
     *   ->withDueFees(...)
     *   ->withDueInterest(...)
     *   ->withDuePrincipal(...)
     *   ->withNotDueFees(...)
     *   ->withNotDueInterest(...)
     *   ->withNotDuePrincipal(...)
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
        ?int $dueFees,
        ?int $dueInterest,
        ?int $duePrincipal,
        ?int $notDueFees,
        ?int $notDueInterest,
        ?int $notDuePrincipal,
    ): self {
        $self = new self;

        $self['dueFees'] = $dueFees;
        $self['dueInterest'] = $dueInterest;
        $self['duePrincipal'] = $duePrincipal;
        $self['notDueFees'] = $notDueFees;
        $self['notDueInterest'] = $notDueInterest;
        $self['notDuePrincipal'] = $notDuePrincipal;

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
}

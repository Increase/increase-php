<?php

declare(strict_types=1);

namespace Increase\Accounts\AccountUpdateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The loan details for the account.
 *
 * @phpstan-type LoanShape = array{creditLimit: int}
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
     * `new Loan()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Loan::with(creditLimit: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Loan)->withCreditLimit(...)
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
    public static function with(int $creditLimit): self
    {
        $self = new self;

        $self['creditLimit'] = $creditLimit;

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
}

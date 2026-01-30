<?php

declare(strict_types=1);

namespace Increase\Accounts;

use Increase\Accounts\AccountUpdateParams\Loan;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Update an Account.
 *
 * @see Increase\Services\AccountsService::update()
 *
 * @phpstan-import-type LoanShape from \Increase\Accounts\AccountUpdateParams\Loan
 *
 * @phpstan-type AccountUpdateParamsShape = array{
 *   loan?: null|Loan|LoanShape, name?: string|null
 * }
 */
final class AccountUpdateParams implements BaseModel
{
    /** @use SdkModel<AccountUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The loan details for the account.
     */
    #[Optional]
    public ?Loan $loan;

    /**
     * The new name of the Account.
     */
    #[Optional]
    public ?string $name;

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
     */
    public static function with(
        Loan|array|null $loan = null,
        ?string $name = null
    ): self {
        $self = new self;

        null !== $loan && $self['loan'] = $loan;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * The loan details for the account.
     *
     * @param Loan|LoanShape $loan
     */
    public function withLoan(Loan|array $loan): self
    {
        $self = clone $this;
        $self['loan'] = $loan;

        return $self;
    }

    /**
     * The new name of the Account.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}

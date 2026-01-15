<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Options for the created export. Required if `category` is equal to `account_statement_bai2`.
 *
 * @phpstan-type AccountStatementBai2Shape = array{
 *   accountID?: string|null, effectiveDate?: string|null, programID?: string|null
 * }
 */
final class AccountStatementBai2 implements BaseModel
{
    /** @use SdkModel<AccountStatementBai2Shape> */
    use SdkModel;

    /**
     * The Account to create a BAI2 report for. If not provided, all open accounts will be included.
     */
    #[Optional('account_id')]
    public ?string $accountID;

    /**
     * The date to create a BAI2 report for. If not provided, the current date will be used. The timezone is UTC. If the current date is used, the report will include intraday balances, otherwise it will include end-of-day balances for the provided date.
     */
    #[Optional('effective_date')]
    public ?string $effectiveDate;

    /**
     * The Program to create a BAI2 report for. If not provided, all open accounts will be included.
     */
    #[Optional('program_id')]
    public ?string $programID;

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
        ?string $accountID = null,
        ?string $effectiveDate = null,
        ?string $programID = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $effectiveDate && $self['effectiveDate'] = $effectiveDate;
        null !== $programID && $self['programID'] = $programID;

        return $self;
    }

    /**
     * The Account to create a BAI2 report for. If not provided, all open accounts will be included.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The date to create a BAI2 report for. If not provided, the current date will be used. The timezone is UTC. If the current date is used, the report will include intraday balances, otherwise it will include end-of-day balances for the provided date.
     */
    public function withEffectiveDate(string $effectiveDate): self
    {
        $self = clone $this;
        $self['effectiveDate'] = $effectiveDate;

        return $self;
    }

    /**
     * The Program to create a BAI2 report for. If not provided, all open accounts will be included.
     */
    public function withProgramID(string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

        return $self;
    }
}

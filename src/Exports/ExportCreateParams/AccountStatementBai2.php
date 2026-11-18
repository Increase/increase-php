<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Options for the created export. Required if `category` is equal to `account_statement_bai2`. Each as-of date from `on_or_after_date` through `on_or_before_date` gets its own BAI2 group (`02` record) in the file. If a group's as-of date is before the UTC date the Export was created, it has end-of-day balances. If it's the UTC date the Export was created, it has intraday balances as of the time the Export was created.
 *
 * @phpstan-type AccountStatementBai2Shape = array{
 *   accountID?: string|null,
 *   onOrAfterDate?: string|null,
 *   onOrBeforeDate?: string|null,
 *   programID?: string|null,
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
     * The first as-of date (UTC) to report. Each as-of date gets its own group in the BAI2 file. If not provided, the report starts from the earliest included Account.
     */
    #[Optional('on_or_after_date')]
    public ?string $onOrAfterDate;

    /**
     * The last as-of date (UTC) to report. If not provided, the report runs through the current UTC date.
     */
    #[Optional('on_or_before_date')]
    public ?string $onOrBeforeDate;

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
        ?string $onOrAfterDate = null,
        ?string $onOrBeforeDate = null,
        ?string $programID = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $onOrAfterDate && $self['onOrAfterDate'] = $onOrAfterDate;
        null !== $onOrBeforeDate && $self['onOrBeforeDate'] = $onOrBeforeDate;
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
     * The first as-of date (UTC) to report. Each as-of date gets its own group in the BAI2 file. If not provided, the report starts from the earliest included Account.
     */
    public function withOnOrAfterDate(string $onOrAfterDate): self
    {
        $self = clone $this;
        $self['onOrAfterDate'] = $onOrAfterDate;

        return $self;
    }

    /**
     * The last as-of date (UTC) to report. If not provided, the report runs through the current UTC date.
     */
    public function withOnOrBeforeDate(string $onOrBeforeDate): self
    {
        $self = clone $this;
        $self['onOrBeforeDate'] = $onOrBeforeDate;

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

<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details of the account statement BAI2 export. This field will be present when the `category` is equal to `account_statement_bai2`.
 *
 * @phpstan-type AccountStatementBai2Shape = array{
 *   accountID: string|null,
 *   onOrAfterDate: string|null,
 *   onOrBeforeDate: string|null,
 *   programID: string|null,
 * }
 */
final class AccountStatementBai2 implements BaseModel
{
    /** @use SdkModel<AccountStatementBai2Shape> */
    use SdkModel;

    /**
     * Filter results by Account.
     */
    #[Required('account_id')]
    public ?string $accountID;

    /**
     * The first as-of date (UTC) reported in the BAI2 file. If null, the report started from the earliest included Account.
     */
    #[Required('on_or_after_date')]
    public ?string $onOrAfterDate;

    /**
     * The last as-of date (UTC) reported in the BAI2 file. If null, the report ran through the date the Export was created.
     */
    #[Required('on_or_before_date')]
    public ?string $onOrBeforeDate;

    /**
     * Filter results by Program.
     */
    #[Required('program_id')]
    public ?string $programID;

    /**
     * `new AccountStatementBai2()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountStatementBai2::with(
     *   accountID: ..., onOrAfterDate: ..., onOrBeforeDate: ..., programID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountStatementBai2)
     *   ->withAccountID(...)
     *   ->withOnOrAfterDate(...)
     *   ->withOnOrBeforeDate(...)
     *   ->withProgramID(...)
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
        ?string $accountID,
        ?string $onOrAfterDate,
        ?string $onOrBeforeDate,
        ?string $programID,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['onOrAfterDate'] = $onOrAfterDate;
        $self['onOrBeforeDate'] = $onOrBeforeDate;
        $self['programID'] = $programID;

        return $self;
    }

    /**
     * Filter results by Account.
     */
    public function withAccountID(?string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The first as-of date (UTC) reported in the BAI2 file. If null, the report started from the earliest included Account.
     */
    public function withOnOrAfterDate(?string $onOrAfterDate): self
    {
        $self = clone $this;
        $self['onOrAfterDate'] = $onOrAfterDate;

        return $self;
    }

    /**
     * The last as-of date (UTC) reported in the BAI2 file. If null, the report ran through the date the Export was created.
     */
    public function withOnOrBeforeDate(?string $onOrBeforeDate): self
    {
        $self = clone $this;
        $self['onOrBeforeDate'] = $onOrBeforeDate;

        return $self;
    }

    /**
     * Filter results by Program.
     */
    public function withProgramID(?string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

        return $self;
    }
}

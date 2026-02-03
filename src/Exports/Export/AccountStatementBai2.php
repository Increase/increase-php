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
 *   accountID: string|null, effectiveDate: string|null, programID: string|null
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
     * The date for which to retrieve the balance.
     */
    #[Required('effective_date')]
    public ?string $effectiveDate;

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
     * AccountStatementBai2::with(accountID: ..., effectiveDate: ..., programID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountStatementBai2)
     *   ->withAccountID(...)
     *   ->withEffectiveDate(...)
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
        ?string $effectiveDate,
        ?string $programID
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['effectiveDate'] = $effectiveDate;
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
     * The date for which to retrieve the balance.
     */
    public function withEffectiveDate(?string $effectiveDate): self
    {
        $self = clone $this;
        $self['effectiveDate'] = $effectiveDate;

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

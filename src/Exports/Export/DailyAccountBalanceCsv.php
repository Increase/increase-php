<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details of the daily account balance CSV export. This field will be present when the `category` is equal to `daily_account_balance_csv`.
 *
 * @phpstan-type DailyAccountBalanceCsvShape = array{
 *   accountID: string|null,
 *   onOrAfterDate: string|null,
 *   onOrBeforeDate: string|null,
 * }
 */
final class DailyAccountBalanceCsv implements BaseModel
{
    /** @use SdkModel<DailyAccountBalanceCsvShape> */
    use SdkModel;

    /**
     * Filter results by Account.
     */
    #[Required('account_id')]
    public ?string $accountID;

    /**
     * Filter balances on or after this date.
     */
    #[Required('on_or_after_date')]
    public ?string $onOrAfterDate;

    /**
     * Filter balances on or before this date.
     */
    #[Required('on_or_before_date')]
    public ?string $onOrBeforeDate;

    /**
     * `new DailyAccountBalanceCsv()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DailyAccountBalanceCsv::with(
     *   accountID: ..., onOrAfterDate: ..., onOrBeforeDate: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DailyAccountBalanceCsv)
     *   ->withAccountID(...)
     *   ->withOnOrAfterDate(...)
     *   ->withOnOrBeforeDate(...)
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
        ?string $onOrBeforeDate
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['onOrAfterDate'] = $onOrAfterDate;
        $self['onOrBeforeDate'] = $onOrBeforeDate;

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
     * Filter balances on or after this date.
     */
    public function withOnOrAfterDate(?string $onOrAfterDate): self
    {
        $self = clone $this;
        $self['onOrAfterDate'] = $onOrAfterDate;

        return $self;
    }

    /**
     * Filter balances on or before this date.
     */
    public function withOnOrBeforeDate(?string $onOrBeforeDate): self
    {
        $self = clone $this;
        $self['onOrBeforeDate'] = $onOrBeforeDate;

        return $self;
    }
}

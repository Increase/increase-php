<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details of the bookkeeping account balance CSV export. This field will be present when the `category` is equal to `bookkeeping_account_balance_csv`.
 *
 * @phpstan-type BookkeepingAccountBalanceCsvShape = array{
 *   bookkeepingAccountID: string|null,
 *   onOrAfterDate: string|null,
 *   onOrBeforeDate: string|null,
 * }
 */
final class BookkeepingAccountBalanceCsv implements BaseModel
{
    /** @use SdkModel<BookkeepingAccountBalanceCsvShape> */
    use SdkModel;

    /**
     * Filter results by Bookkeeping Account.
     */
    #[Required('bookkeeping_account_id')]
    public ?string $bookkeepingAccountID;

    /**
     * Filter balances to those on or after this date.
     */
    #[Required('on_or_after_date')]
    public ?string $onOrAfterDate;

    /**
     * Filter balances to those on or before this date.
     */
    #[Required('on_or_before_date')]
    public ?string $onOrBeforeDate;

    /**
     * `new BookkeepingAccountBalanceCsv()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BookkeepingAccountBalanceCsv::with(
     *   bookkeepingAccountID: ..., onOrAfterDate: ..., onOrBeforeDate: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BookkeepingAccountBalanceCsv)
     *   ->withBookkeepingAccountID(...)
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
        ?string $bookkeepingAccountID,
        ?string $onOrAfterDate,
        ?string $onOrBeforeDate,
    ): self {
        $self = new self;

        $self['bookkeepingAccountID'] = $bookkeepingAccountID;
        $self['onOrAfterDate'] = $onOrAfterDate;
        $self['onOrBeforeDate'] = $onOrBeforeDate;

        return $self;
    }

    /**
     * Filter results by Bookkeeping Account.
     */
    public function withBookkeepingAccountID(
        ?string $bookkeepingAccountID
    ): self {
        $self = clone $this;
        $self['bookkeepingAccountID'] = $bookkeepingAccountID;

        return $self;
    }

    /**
     * Filter balances to those on or after this date.
     */
    public function withOnOrAfterDate(?string $onOrAfterDate): self
    {
        $self = clone $this;
        $self['onOrAfterDate'] = $onOrAfterDate;

        return $self;
    }

    /**
     * Filter balances to those on or before this date.
     */
    public function withOnOrBeforeDate(?string $onOrBeforeDate): self
    {
        $self = clone $this;
        $self['onOrBeforeDate'] = $onOrBeforeDate;

        return $self;
    }
}

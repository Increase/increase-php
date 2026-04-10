<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Options for the created export. Required if `category` is equal to `bookkeeping_account_balance_csv`.
 *
 * @phpstan-type BookkeepingAccountBalanceCsvShape = array{
 *   bookkeepingAccountID?: string|null,
 *   onOrAfterDate?: string|null,
 *   onOrBeforeDate?: string|null,
 * }
 */
final class BookkeepingAccountBalanceCsv implements BaseModel
{
    /** @use SdkModel<BookkeepingAccountBalanceCsvShape> */
    use SdkModel;

    /**
     * Filter exported Bookkeeping Account Balances to the specified Bookkeeping Account.
     */
    #[Optional('bookkeeping_account_id')]
    public ?string $bookkeepingAccountID;

    /**
     * Filter exported Balances to those on or after this date.
     */
    #[Optional('on_or_after_date')]
    public ?string $onOrAfterDate;

    /**
     * Filter exported Balances to those on or before this date.
     */
    #[Optional('on_or_before_date')]
    public ?string $onOrBeforeDate;

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
        ?string $bookkeepingAccountID = null,
        ?string $onOrAfterDate = null,
        ?string $onOrBeforeDate = null,
    ): self {
        $self = new self;

        null !== $bookkeepingAccountID && $self['bookkeepingAccountID'] = $bookkeepingAccountID;
        null !== $onOrAfterDate && $self['onOrAfterDate'] = $onOrAfterDate;
        null !== $onOrBeforeDate && $self['onOrBeforeDate'] = $onOrBeforeDate;

        return $self;
    }

    /**
     * Filter exported Bookkeeping Account Balances to the specified Bookkeeping Account.
     */
    public function withBookkeepingAccountID(string $bookkeepingAccountID): self
    {
        $self = clone $this;
        $self['bookkeepingAccountID'] = $bookkeepingAccountID;

        return $self;
    }

    /**
     * Filter exported Balances to those on or after this date.
     */
    public function withOnOrAfterDate(string $onOrAfterDate): self
    {
        $self = clone $this;
        $self['onOrAfterDate'] = $onOrAfterDate;

        return $self;
    }

    /**
     * Filter exported Balances to those on or before this date.
     */
    public function withOnOrBeforeDate(string $onOrBeforeDate): self
    {
        $self = clone $this;
        $self['onOrBeforeDate'] = $onOrBeforeDate;

        return $self;
    }
}

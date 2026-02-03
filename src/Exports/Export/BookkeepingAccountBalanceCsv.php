<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\Export\BookkeepingAccountBalanceCsv\CreatedAt;

/**
 * Details of the bookkeeping account balance CSV export. This field will be present when the `category` is equal to `bookkeeping_account_balance_csv`.
 *
 * @phpstan-import-type CreatedAtShape from \Increase\Exports\Export\BookkeepingAccountBalanceCsv\CreatedAt
 *
 * @phpstan-type BookkeepingAccountBalanceCsvShape = array{
 *   bookkeepingAccountID: string|null, createdAt: null|CreatedAt|CreatedAtShape
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
     * Filter balances by their created date.
     */
    #[Required('created_at')]
    public ?CreatedAt $createdAt;

    /**
     * `new BookkeepingAccountBalanceCsv()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BookkeepingAccountBalanceCsv::with(bookkeepingAccountID: ..., createdAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BookkeepingAccountBalanceCsv)
     *   ->withBookkeepingAccountID(...)
     *   ->withCreatedAt(...)
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
     *
     * @param CreatedAt|CreatedAtShape|null $createdAt
     */
    public static function with(
        ?string $bookkeepingAccountID,
        CreatedAt|array|null $createdAt
    ): self {
        $self = new self;

        $self['bookkeepingAccountID'] = $bookkeepingAccountID;
        $self['createdAt'] = $createdAt;

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
     * Filter balances by their created date.
     *
     * @param CreatedAt|CreatedAtShape|null $createdAt
     */
    public function withCreatedAt(CreatedAt|array|null $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }
}

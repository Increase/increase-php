<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\ExportCreateParams\BookkeepingAccountBalanceCsv\CreatedAt;

/**
 * Options for the created export. Required if `category` is equal to `bookkeeping_account_balance_csv`.
 *
 * @phpstan-import-type CreatedAtShape from \Increase\Exports\ExportCreateParams\BookkeepingAccountBalanceCsv\CreatedAt
 *
 * @phpstan-type BookkeepingAccountBalanceCsvShape = array{
 *   bookkeepingAccountID?: string|null, createdAt?: null|CreatedAt|CreatedAtShape
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
     * Filter results by time range on the `created_at` attribute.
     */
    #[Optional('created_at')]
    public ?CreatedAt $createdAt;

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
        ?string $bookkeepingAccountID = null,
        CreatedAt|array|null $createdAt = null
    ): self {
        $self = new self;

        null !== $bookkeepingAccountID && $self['bookkeepingAccountID'] = $bookkeepingAccountID;
        null !== $createdAt && $self['createdAt'] = $createdAt;

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
     * Filter results by time range on the `created_at` attribute.
     *
     * @param CreatedAt|CreatedAtShape $createdAt
     */
    public function withCreatedAt(CreatedAt|array $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\BookkeepingEntries;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * List Bookkeeping Entries.
 *
 * @see Increase\Services\BookkeepingEntriesService::list()
 *
 * @phpstan-type BookkeepingEntryListParamsShape = array{
 *   accountID?: string|null, cursor?: string|null, limit?: int|null
 * }
 */
final class BookkeepingEntryListParams implements BaseModel
{
    /** @use SdkModel<BookkeepingEntryListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier for the Bookkeeping Account to filter by.
     */
    #[Optional]
    public ?string $accountID;

    /**
     * Return the page of entries after this one.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    #[Optional]
    public ?int $limit;

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
        ?string $cursor = null,
        ?int $limit = null
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * The identifier for the Bookkeeping Account to filter by.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Return the page of entries after this one.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}

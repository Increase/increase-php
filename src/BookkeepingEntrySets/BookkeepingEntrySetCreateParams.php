<?php

declare(strict_types=1);

namespace Increase\BookkeepingEntrySets;

use Increase\BookkeepingEntrySets\BookkeepingEntrySetCreateParams\Entry;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Bookkeeping Entry Set.
 *
 * @see Increase\Services\BookkeepingEntrySetsService::create()
 *
 * @phpstan-import-type EntryShape from \Increase\BookkeepingEntrySets\BookkeepingEntrySetCreateParams\Entry
 *
 * @phpstan-type BookkeepingEntrySetCreateParamsShape = array{
 *   entries: list<Entry|EntryShape>,
 *   date?: \DateTimeInterface|null,
 *   transactionID?: string|null,
 * }
 */
final class BookkeepingEntrySetCreateParams implements BaseModel
{
    /** @use SdkModel<BookkeepingEntrySetCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The bookkeeping entries.
     *
     * @var list<Entry> $entries
     */
    #[Required(list: Entry::class)]
    public array $entries;

    /**
     * The date of the transaction. Optional if `transaction_id` is provided, in which case we use the `date` of that transaction. Required otherwise.
     */
    #[Optional]
    public ?\DateTimeInterface $date;

    /**
     * The identifier of the Transaction related to this entry set, if any.
     */
    #[Optional('transaction_id')]
    public ?string $transactionID;

    /**
     * `new BookkeepingEntrySetCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BookkeepingEntrySetCreateParams::with(entries: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BookkeepingEntrySetCreateParams)->withEntries(...)
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
     * @param list<Entry|EntryShape> $entries
     */
    public static function with(
        array $entries,
        ?\DateTimeInterface $date = null,
        ?string $transactionID = null,
    ): self {
        $self = new self;

        $self['entries'] = $entries;

        null !== $date && $self['date'] = $date;
        null !== $transactionID && $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * The bookkeeping entries.
     *
     * @param list<Entry|EntryShape> $entries
     */
    public function withEntries(array $entries): self
    {
        $self = clone $this;
        $self['entries'] = $entries;

        return $self;
    }

    /**
     * The date of the transaction. Optional if `transaction_id` is provided, in which case we use the `date` of that transaction. Required otherwise.
     */
    public function withDate(\DateTimeInterface $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * The identifier of the Transaction related to this entry set, if any.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}

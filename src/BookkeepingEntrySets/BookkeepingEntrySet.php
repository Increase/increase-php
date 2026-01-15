<?php

declare(strict_types=1);

namespace Increase\BookkeepingEntrySets;

use Increase\BookkeepingEntrySets\BookkeepingEntrySet\Entry;
use Increase\BookkeepingEntrySets\BookkeepingEntrySet\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Entry Sets are accounting entries that are transactionally applied. Your compliance setup might require annotating money movements using this API. Learn more in our [guide to Bookkeeping](https://increase.com/documentation/bookkeeping#bookkeeping).
 *
 * @phpstan-import-type EntryShape from \Increase\BookkeepingEntrySets\BookkeepingEntrySet\Entry
 *
 * @phpstan-type BookkeepingEntrySetShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   date: \DateTimeInterface,
 *   entries: list<Entry|EntryShape>,
 *   idempotencyKey: string|null,
 *   transactionID: string|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class BookkeepingEntrySet implements BaseModel
{
    /** @use SdkModel<BookkeepingEntrySetShape> */
    use SdkModel;

    /**
     * The entry set identifier.
     */
    #[Required]
    public string $id;

    /**
     * When the entry set was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The timestamp of the entry set.
     */
    #[Required]
    public \DateTimeInterface $date;

    /**
     * The entries.
     *
     * @var list<Entry> $entries
     */
    #[Required(list: Entry::class)]
    public array $entries;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The transaction identifier, if any.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `bookkeeping_entry_set`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new BookkeepingEntrySet()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BookkeepingEntrySet::with(
     *   id: ...,
     *   createdAt: ...,
     *   date: ...,
     *   entries: ...,
     *   idempotencyKey: ...,
     *   transactionID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BookkeepingEntrySet)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDate(...)
     *   ->withEntries(...)
     *   ->withIdempotencyKey(...)
     *   ->withTransactionID(...)
     *   ->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        \DateTimeInterface $date,
        array $entries,
        ?string $idempotencyKey,
        ?string $transactionID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['date'] = $date;
        $self['entries'] = $entries;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The entry set identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * When the entry set was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The timestamp of the entry set.
     */
    public function withDate(\DateTimeInterface $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * The entries.
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
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * The transaction identifier, if any.
     */
    public function withTransactionID(?string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `bookkeeping_entry_set`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}

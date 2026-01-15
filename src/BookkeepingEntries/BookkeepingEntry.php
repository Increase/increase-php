<?php

declare(strict_types=1);

namespace Increase\BookkeepingEntries;

use Increase\BookkeepingEntries\BookkeepingEntry\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Entries are T-account entries recording debits and credits. Your compliance setup might require annotating money movements using this API. Learn more in our [guide to Bookkeeping](https://increase.com/documentation/bookkeeping#bookkeeping).
 *
 * @phpstan-type BookkeepingEntryShape = array{
 *   id: string,
 *   accountID: string,
 *   amount: int,
 *   createdAt: \DateTimeInterface,
 *   entrySetID: string,
 *   type: Type|value-of<Type>,
 * }
 */
final class BookkeepingEntry implements BaseModel
{
    /** @use SdkModel<BookkeepingEntryShape> */
    use SdkModel;

    /**
     * The entry identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the Account the Entry belongs to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The Entry amount in the minor unit of its currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * When the entry set was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The identifier for the Account the Entry belongs to.
     */
    #[Required('entry_set_id')]
    public string $entrySetID;

    /**
     * A constant representing the object's type. For this resource it will always be `bookkeeping_entry`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new BookkeepingEntry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BookkeepingEntry::with(
     *   id: ...,
     *   accountID: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   entrySetID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BookkeepingEntry)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withEntrySetID(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        int $amount,
        \DateTimeInterface $createdAt,
        string $entrySetID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['entrySetID'] = $entrySetID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The entry identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the Account the Entry belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The Entry amount in the minor unit of its currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

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
     * The identifier for the Account the Entry belongs to.
     */
    public function withEntrySetID(string $entrySetID): self
    {
        $self = clone $this;
        $self['entrySetID'] = $entrySetID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `bookkeeping_entry`.
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

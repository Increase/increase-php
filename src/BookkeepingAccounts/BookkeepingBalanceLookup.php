<?php

declare(strict_types=1);

namespace Increase\BookkeepingAccounts;

use Increase\BookkeepingAccounts\BookkeepingBalanceLookup\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Represents a request to lookup the balance of an Bookkeeping Account at a given point in time.
 *
 * @phpstan-type BookkeepingBalanceLookupShape = array{
 *   balance: int, bookkeepingAccountID: string, type: Type|value-of<Type>
 * }
 */
final class BookkeepingBalanceLookup implements BaseModel
{
    /** @use SdkModel<BookkeepingBalanceLookupShape> */
    use SdkModel;

    /**
     * The Bookkeeping Account's current balance, representing the sum of all Bookkeeping Entries on the Bookkeeping Account.
     */
    #[Required]
    public int $balance;

    /**
     * The identifier for the account for which the balance was queried.
     */
    #[Required('bookkeeping_account_id')]
    public string $bookkeepingAccountID;

    /**
     * A constant representing the object's type. For this resource it will always be `bookkeeping_balance_lookup`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new BookkeepingBalanceLookup()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BookkeepingBalanceLookup::with(
     *   balance: ..., bookkeepingAccountID: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BookkeepingBalanceLookup)
     *   ->withBalance(...)
     *   ->withBookkeepingAccountID(...)
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
        int $balance,
        string $bookkeepingAccountID,
        Type|string $type
    ): self {
        $self = new self;

        $self['balance'] = $balance;
        $self['bookkeepingAccountID'] = $bookkeepingAccountID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Bookkeeping Account's current balance, representing the sum of all Bookkeeping Entries on the Bookkeeping Account.
     */
    public function withBalance(int $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }

    /**
     * The identifier for the account for which the balance was queried.
     */
    public function withBookkeepingAccountID(string $bookkeepingAccountID): self
    {
        $self = clone $this;
        $self['bookkeepingAccountID'] = $bookkeepingAccountID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `bookkeeping_balance_lookup`.
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

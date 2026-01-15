<?php

declare(strict_types=1);

namespace Increase\Accounts;

use Increase\Accounts\BalanceLookup\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Represents a request to lookup the balance of an Account at a given point in time.
 *
 * @phpstan-type BalanceLookupShape = array{
 *   accountID: string,
 *   availableBalance: int,
 *   currentBalance: int,
 *   type: Type|value-of<Type>,
 * }
 */
final class BalanceLookup implements BaseModel
{
    /** @use SdkModel<BalanceLookupShape> */
    use SdkModel;

    /**
     * The identifier for the account for which the balance was queried.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The Account's available balance, representing the current balance less any open Pending Transactions on the Account.
     */
    #[Required('available_balance')]
    public int $availableBalance;

    /**
     * The Account's current balance, representing the sum of all posted Transactions on the Account.
     */
    #[Required('current_balance')]
    public int $currentBalance;

    /**
     * A constant representing the object's type. For this resource it will always be `balance_lookup`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new BalanceLookup()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BalanceLookup::with(
     *   accountID: ..., availableBalance: ..., currentBalance: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BalanceLookup)
     *   ->withAccountID(...)
     *   ->withAvailableBalance(...)
     *   ->withCurrentBalance(...)
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
        string $accountID,
        int $availableBalance,
        int $currentBalance,
        Type|string $type,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['availableBalance'] = $availableBalance;
        $self['currentBalance'] = $currentBalance;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The identifier for the account for which the balance was queried.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The Account's available balance, representing the current balance less any open Pending Transactions on the Account.
     */
    public function withAvailableBalance(int $availableBalance): self
    {
        $self = clone $this;
        $self['availableBalance'] = $availableBalance;

        return $self;
    }

    /**
     * The Account's current balance, representing the sum of all posted Transactions on the Account.
     */
    public function withCurrentBalance(int $currentBalance): self
    {
        $self = clone $this;
        $self['currentBalance'] = $currentBalance;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `balance_lookup`.
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

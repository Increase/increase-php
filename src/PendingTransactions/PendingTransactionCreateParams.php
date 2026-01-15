<?php

declare(strict_types=1);

namespace Increase\PendingTransactions;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Creates a pending transaction on an account. This can be useful to hold funds for an external payment or known future transaction outside of Increase (only negative amounts are supported). The resulting Pending Transaction will have a `category` of `user_initiated_hold` and can be released via the API to unlock the held funds.
 *
 * @see Increase\Services\PendingTransactionsService::create()
 *
 * @phpstan-type PendingTransactionCreateParamsShape = array{
 *   accountID: string, amount: int, description?: string|null
 * }
 */
final class PendingTransactionCreateParams implements BaseModel
{
    /** @use SdkModel<PendingTransactionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The Account to place the hold on.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The amount to hold in the minor unit of the account's currency. For dollars, for example, this is cents. This should be a negative amount - to hold $1.00 from the account, you would pass -100.
     */
    #[Required]
    public int $amount;

    /**
     * The description you choose to give the hold.
     */
    #[Optional]
    public ?string $description;

    /**
     * `new PendingTransactionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PendingTransactionCreateParams::with(accountID: ..., amount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PendingTransactionCreateParams)->withAccountID(...)->withAmount(...)
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
        string $accountID,
        int $amount,
        ?string $description = null
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['amount'] = $amount;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * The Account to place the hold on.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The amount to hold in the minor unit of the account's currency. For dollars, for example, this is cents. This should be a negative amount - to hold $1.00 from the account, you would pass -100.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The description you choose to give the hold.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}

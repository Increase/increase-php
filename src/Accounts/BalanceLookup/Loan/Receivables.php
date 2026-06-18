<?php

declare(strict_types=1);

namespace Increase\Accounts\BalanceLookup\Loan;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The receivables balances for the loan.
 *
 * @phpstan-type ReceivablesShape = array{
 *   purchasableBalance: int, purchasedBalance: int
 * }
 */
final class Receivables implements BaseModel
{
    /** @use SdkModel<ReceivablesShape> */
    use SdkModel;

    /**
     * The balance of seasoned receivables available to be purchased.
     */
    #[Required('purchasable_balance')]
    public int $purchasableBalance;

    /**
     * The balance of receivables that have been purchased.
     */
    #[Required('purchased_balance')]
    public int $purchasedBalance;

    /**
     * `new Receivables()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Receivables::with(purchasableBalance: ..., purchasedBalance: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Receivables)->withPurchasableBalance(...)->withPurchasedBalance(...)
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
        int $purchasableBalance,
        int $purchasedBalance
    ): self {
        $self = new self;

        $self['purchasableBalance'] = $purchasableBalance;
        $self['purchasedBalance'] = $purchasedBalance;

        return $self;
    }

    /**
     * The balance of seasoned receivables available to be purchased.
     */
    public function withPurchasableBalance(int $purchasableBalance): self
    {
        $self = clone $this;
        $self['purchasableBalance'] = $purchasableBalance;

        return $self;
    }

    /**
     * The balance of receivables that have been purchased.
     */
    public function withPurchasedBalance(int $purchasedBalance): self
    {
        $self = clone $this;
        $self['purchasedBalance'] = $purchasedBalance;

        return $self;
    }
}

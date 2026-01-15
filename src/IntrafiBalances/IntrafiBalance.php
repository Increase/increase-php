<?php

declare(strict_types=1);

namespace Increase\IntrafiBalances;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\IntrafiBalances\IntrafiBalance\Balance;
use Increase\IntrafiBalances\IntrafiBalance\Currency;
use Increase\IntrafiBalances\IntrafiBalance\Type;

/**
 * When using IntraFi, each account's balance over the standard FDIC insurance amount is swept to various other institutions. Funds are rebalanced across banks as needed once per business day.
 *
 * @phpstan-import-type BalanceShape from \Increase\IntrafiBalances\IntrafiBalance\Balance
 *
 * @phpstan-type IntrafiBalanceShape = array{
 *   id: string,
 *   balances: list<Balance|BalanceShape>,
 *   currency: Currency|value-of<Currency>,
 *   effectiveDate: string,
 *   totalBalance: int,
 *   type: Type|value-of<Type>,
 * }
 */
final class IntrafiBalance implements BaseModel
{
    /** @use SdkModel<IntrafiBalanceShape> */
    use SdkModel;

    /**
     * The identifier of this balance.
     */
    #[Required]
    public string $id;

    /**
     * Each entry represents a balance held at a different bank. IntraFi separates the total balance across many participating banks in the network.
     *
     * @var list<Balance> $balances
     */
    #[Required(list: Balance::class)]
    public array $balances;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the account currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The date this balance reflects.
     */
    #[Required('effective_date')]
    public string $effectiveDate;

    /**
     * The total balance, in minor units of `currency`. Increase reports this balance to IntraFi daily.
     */
    #[Required('total_balance')]
    public int $totalBalance;

    /**
     * A constant representing the object's type. For this resource it will always be `intrafi_balance`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new IntrafiBalance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IntrafiBalance::with(
     *   id: ...,
     *   balances: ...,
     *   currency: ...,
     *   effectiveDate: ...,
     *   totalBalance: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IntrafiBalance)
     *   ->withID(...)
     *   ->withBalances(...)
     *   ->withCurrency(...)
     *   ->withEffectiveDate(...)
     *   ->withTotalBalance(...)
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
     * @param list<Balance|BalanceShape> $balances
     * @param Currency|value-of<Currency> $currency
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        array $balances,
        Currency|string $currency,
        string $effectiveDate,
        int $totalBalance,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['balances'] = $balances;
        $self['currency'] = $currency;
        $self['effectiveDate'] = $effectiveDate;
        $self['totalBalance'] = $totalBalance;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The identifier of this balance.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Each entry represents a balance held at a different bank. IntraFi separates the total balance across many participating banks in the network.
     *
     * @param list<Balance|BalanceShape> $balances
     */
    public function withBalances(array $balances): self
    {
        $self = clone $this;
        $self['balances'] = $balances;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the account currency.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The date this balance reflects.
     */
    public function withEffectiveDate(string $effectiveDate): self
    {
        $self = clone $this;
        $self['effectiveDate'] = $effectiveDate;

        return $self;
    }

    /**
     * The total balance, in minor units of `currency`. Increase reports this balance to IntraFi daily.
     */
    public function withTotalBalance(int $totalBalance): self
    {
        $self = clone $this;
        $self['totalBalance'] = $totalBalance;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `intrafi_balance`.
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

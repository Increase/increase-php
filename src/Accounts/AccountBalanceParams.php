<?php

declare(strict_types=1);

namespace Increase\Accounts;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Retrieve the current and available balances for an account in minor units of the account's currency. Learn more about [account balances](/documentation/balance).
 *
 * @see Increase\Services\AccountsService::balance()
 *
 * @phpstan-type AccountBalanceParamsShape = array{
 *   atTime?: \DateTimeInterface|null
 * }
 */
final class AccountBalanceParams implements BaseModel
{
    /** @use SdkModel<AccountBalanceParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The moment to query the balance at. If not set, returns the current balances.
     */
    #[Optional]
    public ?\DateTimeInterface $atTime;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?\DateTimeInterface $atTime = null): self
    {
        $self = new self;

        null !== $atTime && $self['atTime'] = $atTime;

        return $self;
    }

    /**
     * The moment to query the balance at. If not set, returns the current balances.
     */
    public function withAtTime(\DateTimeInterface $atTime): self
    {
        $self = clone $this;
        $self['atTime'] = $atTime;

        return $self;
    }
}

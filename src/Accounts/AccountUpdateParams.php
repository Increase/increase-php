<?php

declare(strict_types=1);

namespace Increase\Accounts;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Update an Account.
 *
 * @see Increase\Services\AccountsService::update()
 *
 * @phpstan-type AccountUpdateParamsShape = array{
 *   creditLimit?: int|null, name?: string|null
 * }
 */
final class AccountUpdateParams implements BaseModel
{
    /** @use SdkModel<AccountUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The new credit limit of the Account, if and only if the Account is a loan account.
     */
    #[Optional('credit_limit')]
    public ?int $creditLimit;

    /**
     * The new name of the Account.
     */
    #[Optional]
    public ?string $name;

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
        ?int $creditLimit = null,
        ?string $name = null
    ): self {
        $self = new self;

        null !== $creditLimit && $self['creditLimit'] = $creditLimit;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * The new credit limit of the Account, if and only if the Account is a loan account.
     */
    public function withCreditLimit(int $creditLimit): self
    {
        $self = clone $this;
        $self['creditLimit'] = $creditLimit;

        return $self;
    }

    /**
     * The new name of the Account.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}

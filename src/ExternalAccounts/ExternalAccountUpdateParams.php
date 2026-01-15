<?php

declare(strict_types=1);

namespace Increase\ExternalAccounts;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\ExternalAccounts\ExternalAccountUpdateParams\AccountHolder;
use Increase\ExternalAccounts\ExternalAccountUpdateParams\Funding;
use Increase\ExternalAccounts\ExternalAccountUpdateParams\Status;

/**
 * Update an External Account.
 *
 * @see Increase\Services\ExternalAccountsService::update()
 *
 * @phpstan-type ExternalAccountUpdateParamsShape = array{
 *   accountHolder?: null|AccountHolder|value-of<AccountHolder>,
 *   description?: string|null,
 *   funding?: null|Funding|value-of<Funding>,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class ExternalAccountUpdateParams implements BaseModel
{
    /** @use SdkModel<ExternalAccountUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The type of entity that owns the External Account.
     *
     * @var value-of<AccountHolder>|null $accountHolder
     */
    #[Optional('account_holder', enum: AccountHolder::class)]
    public ?string $accountHolder;

    /**
     * The description you choose to give the external account.
     */
    #[Optional]
    public ?string $description;

    /**
     * The funding type of the External Account.
     *
     * @var value-of<Funding>|null $funding
     */
    #[Optional(enum: Funding::class)]
    public ?string $funding;

    /**
     * The status of the External Account.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AccountHolder|value-of<AccountHolder>|null $accountHolder
     * @param Funding|value-of<Funding>|null $funding
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        AccountHolder|string|null $accountHolder = null,
        ?string $description = null,
        Funding|string|null $funding = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $accountHolder && $self['accountHolder'] = $accountHolder;
        null !== $description && $self['description'] = $description;
        null !== $funding && $self['funding'] = $funding;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * The type of entity that owns the External Account.
     *
     * @param AccountHolder|value-of<AccountHolder> $accountHolder
     */
    public function withAccountHolder(AccountHolder|string $accountHolder): self
    {
        $self = clone $this;
        $self['accountHolder'] = $accountHolder;

        return $self;
    }

    /**
     * The description you choose to give the external account.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The funding type of the External Account.
     *
     * @param Funding|value-of<Funding> $funding
     */
    public function withFunding(Funding|string $funding): self
    {
        $self = clone $this;
        $self['funding'] = $funding;

        return $self;
    }

    /**
     * The status of the External Account.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}

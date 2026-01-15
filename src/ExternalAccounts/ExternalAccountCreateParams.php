<?php

declare(strict_types=1);

namespace Increase\ExternalAccounts;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\ExternalAccounts\ExternalAccountCreateParams\AccountHolder;
use Increase\ExternalAccounts\ExternalAccountCreateParams\Funding;

/**
 * Create an External Account.
 *
 * @see Increase\Services\ExternalAccountsService::create()
 *
 * @phpstan-type ExternalAccountCreateParamsShape = array{
 *   accountNumber: string,
 *   description: string,
 *   routingNumber: string,
 *   accountHolder?: null|AccountHolder|value-of<AccountHolder>,
 *   funding?: null|Funding|value-of<Funding>,
 * }
 */
final class ExternalAccountCreateParams implements BaseModel
{
    /** @use SdkModel<ExternalAccountCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The account number for the destination account.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * The name you choose for the Account.
     */
    #[Required]
    public string $description;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account.
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * The type of entity that owns the External Account.
     *
     * @var value-of<AccountHolder>|null $accountHolder
     */
    #[Optional('account_holder', enum: AccountHolder::class)]
    public ?string $accountHolder;

    /**
     * The type of the destination account. Defaults to `checking`.
     *
     * @var value-of<Funding>|null $funding
     */
    #[Optional(enum: Funding::class)]
    public ?string $funding;

    /**
     * `new ExternalAccountCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExternalAccountCreateParams::with(
     *   accountNumber: ..., description: ..., routingNumber: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExternalAccountCreateParams)
     *   ->withAccountNumber(...)
     *   ->withDescription(...)
     *   ->withRoutingNumber(...)
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
     * @param AccountHolder|value-of<AccountHolder>|null $accountHolder
     * @param Funding|value-of<Funding>|null $funding
     */
    public static function with(
        string $accountNumber,
        string $description,
        string $routingNumber,
        AccountHolder|string|null $accountHolder = null,
        Funding|string|null $funding = null,
    ): self {
        $self = new self;

        $self['accountNumber'] = $accountNumber;
        $self['description'] = $description;
        $self['routingNumber'] = $routingNumber;

        null !== $accountHolder && $self['accountHolder'] = $accountHolder;
        null !== $funding && $self['funding'] = $funding;

        return $self;
    }

    /**
     * The account number for the destination account.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * The name you choose for the Account.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

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
     * The type of the destination account. Defaults to `checking`.
     *
     * @param Funding|value-of<Funding> $funding
     */
    public function withFunding(Funding|string $funding): self
    {
        $self = clone $this;
        $self['funding'] = $funding;

        return $self;
    }
}

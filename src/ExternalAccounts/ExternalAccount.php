<?php

declare(strict_types=1);

namespace Increase\ExternalAccounts;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\ExternalAccounts\ExternalAccount\AccountHolder;
use Increase\ExternalAccounts\ExternalAccount\Funding;
use Increase\ExternalAccounts\ExternalAccount\Status;
use Increase\ExternalAccounts\ExternalAccount\Type;

/**
 * External Accounts represent accounts at financial institutions other than Increase. You can use this API to store their details for reuse.
 *
 * @phpstan-type ExternalAccountShape = array{
 *   id: string,
 *   accountHolder: AccountHolder|value-of<AccountHolder>,
 *   accountNumber: string,
 *   createdAt: \DateTimeInterface,
 *   description: string,
 *   funding: Funding|value-of<Funding>,
 *   idempotencyKey: string|null,
 *   routingNumber: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class ExternalAccount implements BaseModel
{
    /** @use SdkModel<ExternalAccountShape> */
    use SdkModel;

    /**
     * The External Account's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The type of entity that owns the External Account.
     *
     * @var value-of<AccountHolder> $accountHolder
     */
    #[Required('account_holder', enum: AccountHolder::class)]
    public string $accountHolder;

    /**
     * The destination account number.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the External Account was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The External Account's description for display purposes.
     */
    #[Required]
    public string $description;

    /**
     * The type of the account to which the transfer will be sent.
     *
     * @var value-of<Funding> $funding
     */
    #[Required(enum: Funding::class)]
    public string $funding;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * The External Account's status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `external_account`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new ExternalAccount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExternalAccount::with(
     *   id: ...,
     *   accountHolder: ...,
     *   accountNumber: ...,
     *   createdAt: ...,
     *   description: ...,
     *   funding: ...,
     *   idempotencyKey: ...,
     *   routingNumber: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExternalAccount)
     *   ->withID(...)
     *   ->withAccountHolder(...)
     *   ->withAccountNumber(...)
     *   ->withCreatedAt(...)
     *   ->withDescription(...)
     *   ->withFunding(...)
     *   ->withIdempotencyKey(...)
     *   ->withRoutingNumber(...)
     *   ->withStatus(...)
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
     * @param AccountHolder|value-of<AccountHolder> $accountHolder
     * @param Funding|value-of<Funding> $funding
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        AccountHolder|string $accountHolder,
        string $accountNumber,
        \DateTimeInterface $createdAt,
        string $description,
        Funding|string $funding,
        ?string $idempotencyKey,
        string $routingNumber,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountHolder'] = $accountHolder;
        $self['accountNumber'] = $accountNumber;
        $self['createdAt'] = $createdAt;
        $self['description'] = $description;
        $self['funding'] = $funding;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['routingNumber'] = $routingNumber;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The External Account's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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
     * The destination account number.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the External Account was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The External Account's description for display purposes.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The type of the account to which the transfer will be sent.
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
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * The External Account's status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `external_account`.
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

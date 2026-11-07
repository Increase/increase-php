<?php

declare(strict_types=1);

namespace Increase\AccountNumbers;

use Increase\AccountNumbers\AccountNumber\InboundACHDebits;
use Increase\AccountNumbers\AccountNumber\Status;
use Increase\AccountNumbers\AccountNumber\Type;
use Increase\AccountNumbers\AccountNumber\UnregisteredInboundChecks;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Each account can have multiple account and routing numbers. We recommend that you use a set per vendor. This is similar to how you use different passwords for different websites. Account numbers can also be used to seamlessly reconcile inbound payments. Generating a unique account number per vendor ensures you always know the originator of an incoming payment.
 *
 * @phpstan-type AccountNumberShape = array{
 *   id: string,
 *   accountID: string,
 *   accountNumber: string,
 *   createdAt: \DateTimeInterface,
 *   idempotencyKey: string|null,
 *   inboundACHDebits: InboundACHDebits|value-of<InboundACHDebits>,
 *   name: string,
 *   routingNumber: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 *   unregisteredInboundChecks: UnregisteredInboundChecks|value-of<UnregisteredInboundChecks>,
 * }
 */
final class AccountNumber implements BaseModel
{
    /** @use SdkModel<AccountNumberShape> */
    use SdkModel;

    /**
     * The Account Number identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the account this Account Number belongs to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The account number.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Account Number was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * Whether inbound ACH debits are allowed against this Account Number. Note that they will still be declined if this is `allowed` but the Account Number is not active.
     *
     * @var value-of<InboundACHDebits> $inboundACHDebits
     */
    #[Required('inbound_ach_debits', enum: InboundACHDebits::class)]
    public string $inboundACHDebits;

    /**
     * The name you choose for the Account Number.
     */
    #[Required]
    public string $name;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * This indicates if payments can be made to the Account Number.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `account_number`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Whether unregistered inbound checks for this Account Number can be deposited.
     *
     * @var value-of<UnregisteredInboundChecks> $unregisteredInboundChecks
     */
    #[Required(
        'unregistered_inbound_checks',
        enum: UnregisteredInboundChecks::class
    )]
    public string $unregisteredInboundChecks;

    /**
     * `new AccountNumber()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountNumber::with(
     *   id: ...,
     *   accountID: ...,
     *   accountNumber: ...,
     *   createdAt: ...,
     *   idempotencyKey: ...,
     *   inboundACHDebits: ...,
     *   name: ...,
     *   routingNumber: ...,
     *   status: ...,
     *   type: ...,
     *   unregisteredInboundChecks: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountNumber)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAccountNumber(...)
     *   ->withCreatedAt(...)
     *   ->withIdempotencyKey(...)
     *   ->withInboundACHDebits(...)
     *   ->withName(...)
     *   ->withRoutingNumber(...)
     *   ->withStatus(...)
     *   ->withType(...)
     *   ->withUnregisteredInboundChecks(...)
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
     * @param InboundACHDebits|value-of<InboundACHDebits> $inboundACHDebits
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     * @param UnregisteredInboundChecks|value-of<UnregisteredInboundChecks> $unregisteredInboundChecks
     */
    public static function with(
        string $id,
        string $accountID,
        string $accountNumber,
        \DateTimeInterface $createdAt,
        ?string $idempotencyKey,
        InboundACHDebits|string $inboundACHDebits,
        string $name,
        string $routingNumber,
        Status|string $status,
        Type|string $type,
        UnregisteredInboundChecks|string $unregisteredInboundChecks,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['accountNumber'] = $accountNumber;
        $self['createdAt'] = $createdAt;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['inboundACHDebits'] = $inboundACHDebits;
        $self['name'] = $name;
        $self['routingNumber'] = $routingNumber;
        $self['status'] = $status;
        $self['type'] = $type;
        $self['unregisteredInboundChecks'] = $unregisteredInboundChecks;

        return $self;
    }

    /**
     * The Account Number identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the account this Account Number belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The account number.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Account Number was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
     * Whether inbound ACH debits are allowed against this Account Number. Note that they will still be declined if this is `allowed` but the Account Number is not active.
     *
     * @param InboundACHDebits|value-of<InboundACHDebits> $inboundACHDebits
     */
    public function withInboundACHDebits(
        InboundACHDebits|string $inboundACHDebits
    ): self {
        $self = clone $this;
        $self['inboundACHDebits'] = $inboundACHDebits;

        return $self;
    }

    /**
     * The name you choose for the Account Number.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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
     * This indicates if payments can be made to the Account Number.
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
     * A constant representing the object's type. For this resource it will always be `account_number`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Whether unregistered inbound checks for this Account Number can be deposited.
     *
     * @param UnregisteredInboundChecks|value-of<UnregisteredInboundChecks> $unregisteredInboundChecks
     */
    public function withUnregisteredInboundChecks(
        UnregisteredInboundChecks|string $unregisteredInboundChecks
    ): self {
        $self = clone $this;
        $self['unregisteredInboundChecks'] = $unregisteredInboundChecks;

        return $self;
    }
}

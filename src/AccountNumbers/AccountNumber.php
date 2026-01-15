<?php

declare(strict_types=1);

namespace Increase\AccountNumbers;

use Increase\AccountNumbers\AccountNumber\InboundACH;
use Increase\AccountNumbers\AccountNumber\InboundChecks;
use Increase\AccountNumbers\AccountNumber\Status;
use Increase\AccountNumbers\AccountNumber\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Each account can have multiple account and routing numbers. We recommend that you use a set per vendor. This is similar to how you use different passwords for different websites. Account numbers can also be used to seamlessly reconcile inbound payments. Generating a unique account number per vendor ensures you always know the originator of an incoming payment.
 *
 * @phpstan-import-type InboundACHShape from \Increase\AccountNumbers\AccountNumber\InboundACH
 * @phpstan-import-type InboundChecksShape from \Increase\AccountNumbers\AccountNumber\InboundChecks
 *
 * @phpstan-type AccountNumberShape = array{
 *   id: string,
 *   accountID: string,
 *   accountNumber: string,
 *   createdAt: \DateTimeInterface,
 *   idempotencyKey: string|null,
 *   inboundACH: InboundACH|InboundACHShape,
 *   inboundChecks: InboundChecks|InboundChecksShape,
 *   name: string,
 *   routingNumber: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
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
     * Properties related to how this Account Number handles inbound ACH transfers.
     */
    #[Required('inbound_ach')]
    public InboundACH $inboundACH;

    /**
     * Properties related to how this Account Number should handle inbound check withdrawals.
     */
    #[Required('inbound_checks')]
    public InboundChecks $inboundChecks;

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
     *   inboundACH: ...,
     *   inboundChecks: ...,
     *   name: ...,
     *   routingNumber: ...,
     *   status: ...,
     *   type: ...,
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
     *   ->withInboundACH(...)
     *   ->withInboundChecks(...)
     *   ->withName(...)
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
     * @param InboundACH|InboundACHShape $inboundACH
     * @param InboundChecks|InboundChecksShape $inboundChecks
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $accountNumber,
        \DateTimeInterface $createdAt,
        ?string $idempotencyKey,
        InboundACH|array $inboundACH,
        InboundChecks|array $inboundChecks,
        string $name,
        string $routingNumber,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['accountNumber'] = $accountNumber;
        $self['createdAt'] = $createdAt;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['inboundACH'] = $inboundACH;
        $self['inboundChecks'] = $inboundChecks;
        $self['name'] = $name;
        $self['routingNumber'] = $routingNumber;
        $self['status'] = $status;
        $self['type'] = $type;

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
     * Properties related to how this Account Number handles inbound ACH transfers.
     *
     * @param InboundACH|InboundACHShape $inboundACH
     */
    public function withInboundACH(InboundACH|array $inboundACH): self
    {
        $self = clone $this;
        $self['inboundACH'] = $inboundACH;

        return $self;
    }

    /**
     * Properties related to how this Account Number should handle inbound check withdrawals.
     *
     * @param InboundChecks|InboundChecksShape $inboundChecks
     */
    public function withInboundChecks(InboundChecks|array $inboundChecks): self
    {
        $self = clone $this;
        $self['inboundChecks'] = $inboundChecks;

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
}

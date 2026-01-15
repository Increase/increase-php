<?php

declare(strict_types=1);

namespace Increase\Lockboxes;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Lockboxes\Lockbox\Address;
use Increase\Lockboxes\Lockbox\CheckDepositBehavior;
use Increase\Lockboxes\Lockbox\Type;

/**
 * Lockboxes are physical locations that can receive mail containing paper checks. Increase will automatically create a Check Deposit for checks received this way.
 *
 * @phpstan-import-type AddressShape from \Increase\Lockboxes\Lockbox\Address
 *
 * @phpstan-type LockboxShape = array{
 *   id: string,
 *   accountID: string,
 *   address: Address|AddressShape,
 *   checkDepositBehavior: CheckDepositBehavior|value-of<CheckDepositBehavior>,
 *   createdAt: \DateTimeInterface,
 *   description: string|null,
 *   idempotencyKey: string|null,
 *   recipientName: string|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class Lockbox implements BaseModel
{
    /** @use SdkModel<LockboxShape> */
    use SdkModel;

    /**
     * The Lockbox identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the Account checks sent to this lockbox will be deposited into.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The mailing address for the Lockbox.
     */
    #[Required]
    public Address $address;

    /**
     * Indicates if checks mailed to this lockbox will be deposited.
     *
     * @var value-of<CheckDepositBehavior> $checkDepositBehavior
     */
    #[Required('check_deposit_behavior', enum: CheckDepositBehavior::class)]
    public string $checkDepositBehavior;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Lockbox was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The description you choose for the Lockbox.
     */
    #[Required]
    public ?string $description;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The recipient name you choose for the Lockbox.
     */
    #[Required('recipient_name')]
    public ?string $recipientName;

    /**
     * A constant representing the object's type. For this resource it will always be `lockbox`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Lockbox()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Lockbox::with(
     *   id: ...,
     *   accountID: ...,
     *   address: ...,
     *   checkDepositBehavior: ...,
     *   createdAt: ...,
     *   description: ...,
     *   idempotencyKey: ...,
     *   recipientName: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Lockbox)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAddress(...)
     *   ->withCheckDepositBehavior(...)
     *   ->withCreatedAt(...)
     *   ->withDescription(...)
     *   ->withIdempotencyKey(...)
     *   ->withRecipientName(...)
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
     * @param Address|AddressShape $address
     * @param CheckDepositBehavior|value-of<CheckDepositBehavior> $checkDepositBehavior
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        Address|array $address,
        CheckDepositBehavior|string $checkDepositBehavior,
        \DateTimeInterface $createdAt,
        ?string $description,
        ?string $idempotencyKey,
        ?string $recipientName,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['address'] = $address;
        $self['checkDepositBehavior'] = $checkDepositBehavior;
        $self['createdAt'] = $createdAt;
        $self['description'] = $description;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['recipientName'] = $recipientName;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Lockbox identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the Account checks sent to this lockbox will be deposited into.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The mailing address for the Lockbox.
     *
     * @param Address|AddressShape $address
     */
    public function withAddress(Address|array $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * Indicates if checks mailed to this lockbox will be deposited.
     *
     * @param CheckDepositBehavior|value-of<CheckDepositBehavior> $checkDepositBehavior
     */
    public function withCheckDepositBehavior(
        CheckDepositBehavior|string $checkDepositBehavior
    ): self {
        $self = clone $this;
        $self['checkDepositBehavior'] = $checkDepositBehavior;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Lockbox was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The description you choose for the Lockbox.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

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
     * The recipient name you choose for the Lockbox.
     */
    public function withRecipientName(?string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `lockbox`.
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

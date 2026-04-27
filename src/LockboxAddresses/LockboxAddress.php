<?php

declare(strict_types=1);

namespace Increase\LockboxAddresses;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\LockboxAddresses\LockboxAddress\Address;
use Increase\LockboxAddresses\LockboxAddress\Status;
use Increase\LockboxAddresses\LockboxAddress\Type;

/**
 * Lockbox Addresses are physical locations that can receive mail containing paper checks.
 *
 * @phpstan-import-type AddressShape from \Increase\LockboxAddresses\LockboxAddress\Address
 *
 * @phpstan-type LockboxAddressShape = array{
 *   id: string,
 *   address: null|Address|AddressShape,
 *   createdAt: \DateTimeInterface,
 *   description: string|null,
 *   idempotencyKey: string|null,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class LockboxAddress implements BaseModel
{
    /** @use SdkModel<LockboxAddressShape> */
    use SdkModel;

    /**
     * The Lockbox Address identifier.
     */
    #[Required]
    public string $id;

    /**
     * The mailing address for the Lockbox Address. It will be present after Increase generates it.
     */
    #[Required]
    public ?Address $address;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Lockbox Address was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The description you choose for the Lockbox Address.
     */
    #[Required]
    public ?string $description;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The status of the Lockbox Address.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `lockbox_address`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new LockboxAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LockboxAddress::with(
     *   id: ...,
     *   address: ...,
     *   createdAt: ...,
     *   description: ...,
     *   idempotencyKey: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LockboxAddress)
     *   ->withID(...)
     *   ->withAddress(...)
     *   ->withCreatedAt(...)
     *   ->withDescription(...)
     *   ->withIdempotencyKey(...)
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
     * @param Address|AddressShape|null $address
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Address|array|null $address,
        \DateTimeInterface $createdAt,
        ?string $description,
        ?string $idempotencyKey,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['address'] = $address;
        $self['createdAt'] = $createdAt;
        $self['description'] = $description;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Lockbox Address identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The mailing address for the Lockbox Address. It will be present after Increase generates it.
     *
     * @param Address|AddressShape|null $address
     */
    public function withAddress(Address|array|null $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Lockbox Address was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The description you choose for the Lockbox Address.
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
     * The status of the Lockbox Address.
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
     * A constant representing the object's type. For this resource it will always be `lockbox_address`.
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

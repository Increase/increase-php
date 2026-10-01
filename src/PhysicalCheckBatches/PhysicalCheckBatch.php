<?php

declare(strict_types=1);

namespace Increase\PhysicalCheckBatches;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCheckBatches\PhysicalCheckBatch\MailingAddress;
use Increase\PhysicalCheckBatches\PhysicalCheckBatch\ReturnAddress;
use Increase\PhysicalCheckBatches\PhysicalCheckBatch\ShippingMethod;
use Increase\PhysicalCheckBatches\PhysicalCheckBatch\Status;
use Increase\PhysicalCheckBatches\PhysicalCheckBatch\Type;

/**
 * Physical Check Batches are groups of checks that are mailed in the same parcel. Tracking updates are propagated to every related Check Transfer.
 *
 * @phpstan-import-type MailingAddressShape from \Increase\PhysicalCheckBatches\PhysicalCheckBatch\MailingAddress
 * @phpstan-import-type ReturnAddressShape from \Increase\PhysicalCheckBatches\PhysicalCheckBatch\ReturnAddress
 *
 * @phpstan-type PhysicalCheckBatchShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   idempotencyKey: string|null,
 *   mailingAddress: MailingAddress|MailingAddressShape,
 *   returnAddress: ReturnAddress|ReturnAddressShape,
 *   shippingMethod: ShippingMethod|value-of<ShippingMethod>,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class PhysicalCheckBatch implements BaseModel
{
    /** @use SdkModel<PhysicalCheckBatchShape> */
    use SdkModel;

    /**
     * The Physical Check Batch's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Physical Check Batch was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The mailing address of the parcel.
     */
    #[Required('mailing_address')]
    public MailingAddress $mailingAddress;

    /**
     * The return address of the parcel.
     */
    #[Required('return_address')]
    public ReturnAddress $returnAddress;

    /**
     * The shipping method for the parcel.
     *
     * @var value-of<ShippingMethod> $shippingMethod
     */
    #[Required('shipping_method', enum: ShippingMethod::class)]
    public string $shippingMethod;

    /**
     * The lifecycle status of the Physical Check Batch.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `physical_check_batch`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new PhysicalCheckBatch()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PhysicalCheckBatch::with(
     *   id: ...,
     *   createdAt: ...,
     *   idempotencyKey: ...,
     *   mailingAddress: ...,
     *   returnAddress: ...,
     *   shippingMethod: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PhysicalCheckBatch)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withIdempotencyKey(...)
     *   ->withMailingAddress(...)
     *   ->withReturnAddress(...)
     *   ->withShippingMethod(...)
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
     * @param MailingAddress|MailingAddressShape $mailingAddress
     * @param ReturnAddress|ReturnAddressShape $returnAddress
     * @param ShippingMethod|value-of<ShippingMethod> $shippingMethod
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        ?string $idempotencyKey,
        MailingAddress|array $mailingAddress,
        ReturnAddress|array $returnAddress,
        ShippingMethod|string $shippingMethod,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['mailingAddress'] = $mailingAddress;
        $self['returnAddress'] = $returnAddress;
        $self['shippingMethod'] = $shippingMethod;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Physical Check Batch's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Physical Check Batch was created.
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
     * The mailing address of the parcel.
     *
     * @param MailingAddress|MailingAddressShape $mailingAddress
     */
    public function withMailingAddress(
        MailingAddress|array $mailingAddress
    ): self {
        $self = clone $this;
        $self['mailingAddress'] = $mailingAddress;

        return $self;
    }

    /**
     * The return address of the parcel.
     *
     * @param ReturnAddress|ReturnAddressShape $returnAddress
     */
    public function withReturnAddress(ReturnAddress|array $returnAddress): self
    {
        $self = clone $this;
        $self['returnAddress'] = $returnAddress;

        return $self;
    }

    /**
     * The shipping method for the parcel.
     *
     * @param ShippingMethod|value-of<ShippingMethod> $shippingMethod
     */
    public function withShippingMethod(
        ShippingMethod|string $shippingMethod
    ): self {
        $self = clone $this;
        $self['shippingMethod'] = $shippingMethod;

        return $self;
    }

    /**
     * The lifecycle status of the Physical Check Batch.
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
     * A constant representing the object's type. For this resource it will always be `physical_check_batch`.
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

<?php

declare(strict_types=1);

namespace Increase\PhysicalCards;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCards\PhysicalCard\Cardholder;
use Increase\PhysicalCards\PhysicalCard\Shipment;
use Increase\PhysicalCards\PhysicalCard\Status;
use Increase\PhysicalCards\PhysicalCard\Type;

/**
 * Custom physical Visa cards that are shipped to your customers. The artwork is configurable by a connected [Card Profile](/documentation/api#card-profiles). The same Card can be used for multiple Physical Cards. Printing cards incurs a fee. Please contact [support@increase.com](mailto:support@increase.com) for pricing!
 *
 * @phpstan-import-type CardholderShape from \Increase\PhysicalCards\PhysicalCard\Cardholder
 * @phpstan-import-type ShipmentShape from \Increase\PhysicalCards\PhysicalCard\Shipment
 *
 * @phpstan-type PhysicalCardShape = array{
 *   id: string,
 *   cardID: string,
 *   cardholder: Cardholder|CardholderShape,
 *   createdAt: \DateTimeInterface,
 *   idempotencyKey: string|null,
 *   physicalCardProfileID: string|null,
 *   shipment: Shipment|ShipmentShape,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class PhysicalCard implements BaseModel
{
    /** @use SdkModel<PhysicalCardShape> */
    use SdkModel;

    /**
     * The physical card identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the Card this Physical Card represents.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * Details about the cardholder, as it appears on the printed card.
     */
    #[Required]
    public Cardholder $cardholder;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Physical Card was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The Physical Card Profile used for this Physical Card.
     */
    #[Required('physical_card_profile_id')]
    public ?string $physicalCardProfileID;

    /**
     * The details used to ship this physical card.
     */
    #[Required]
    public Shipment $shipment;

    /**
     * The status of the Physical Card.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `physical_card`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new PhysicalCard()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PhysicalCard::with(
     *   id: ...,
     *   cardID: ...,
     *   cardholder: ...,
     *   createdAt: ...,
     *   idempotencyKey: ...,
     *   physicalCardProfileID: ...,
     *   shipment: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PhysicalCard)
     *   ->withID(...)
     *   ->withCardID(...)
     *   ->withCardholder(...)
     *   ->withCreatedAt(...)
     *   ->withIdempotencyKey(...)
     *   ->withPhysicalCardProfileID(...)
     *   ->withShipment(...)
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
     * @param Cardholder|CardholderShape $cardholder
     * @param Shipment|ShipmentShape $shipment
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $cardID,
        Cardholder|array $cardholder,
        \DateTimeInterface $createdAt,
        ?string $idempotencyKey,
        ?string $physicalCardProfileID,
        Shipment|array $shipment,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['cardID'] = $cardID;
        $self['cardholder'] = $cardholder;
        $self['createdAt'] = $createdAt;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['physicalCardProfileID'] = $physicalCardProfileID;
        $self['shipment'] = $shipment;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The physical card identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the Card this Physical Card represents.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * Details about the cardholder, as it appears on the printed card.
     *
     * @param Cardholder|CardholderShape $cardholder
     */
    public function withCardholder(Cardholder|array $cardholder): self
    {
        $self = clone $this;
        $self['cardholder'] = $cardholder;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Physical Card was created.
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
     * The Physical Card Profile used for this Physical Card.
     */
    public function withPhysicalCardProfileID(
        ?string $physicalCardProfileID
    ): self {
        $self = clone $this;
        $self['physicalCardProfileID'] = $physicalCardProfileID;

        return $self;
    }

    /**
     * The details used to ship this physical card.
     *
     * @param Shipment|ShipmentShape $shipment
     */
    public function withShipment(Shipment|array $shipment): self
    {
        $self = clone $this;
        $self['shipment'] = $shipment;

        return $self;
    }

    /**
     * The status of the Physical Card.
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
     * A constant representing the object's type. For this resource it will always be `physical_card`.
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

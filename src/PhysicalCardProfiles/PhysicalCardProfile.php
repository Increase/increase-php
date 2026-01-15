<?php

declare(strict_types=1);

namespace Increase\PhysicalCardProfiles;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCardProfiles\PhysicalCardProfile\Creator;
use Increase\PhysicalCardProfiles\PhysicalCardProfile\Status;
use Increase\PhysicalCardProfiles\PhysicalCardProfile\Type;

/**
 * This contains artwork and metadata relating to a Physical Card's appearance. For more information, see our guide on [physical card artwork](https://increase.com/documentation/card-art-physical-cards).
 *
 * @phpstan-type PhysicalCardProfileShape = array{
 *   id: string,
 *   backImageFileID: string|null,
 *   carrierImageFileID: string|null,
 *   contactPhone: string|null,
 *   createdAt: \DateTimeInterface,
 *   creator: Creator|value-of<Creator>,
 *   description: string,
 *   frontImageFileID: string|null,
 *   idempotencyKey: string|null,
 *   isDefault: bool,
 *   programID: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class PhysicalCardProfile implements BaseModel
{
    /** @use SdkModel<PhysicalCardProfileShape> */
    use SdkModel;

    /**
     * The Card Profile identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier of the File containing the physical card's back image. This will be missing until the image has been post-processed.
     */
    #[Required('back_image_file_id')]
    public ?string $backImageFileID;

    /**
     * The identifier of the File containing the physical card's carrier image. This will be missing until the image has been post-processed.
     */
    #[Required('carrier_image_file_id')]
    public ?string $carrierImageFileID;

    /**
     * A phone number the user can contact to receive support for their card.
     */
    #[Required('contact_phone')]
    public ?string $contactPhone;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The creator of this Physical Card Profile.
     *
     * @var value-of<Creator> $creator
     */
    #[Required(enum: Creator::class)]
    public string $creator;

    /**
     * A description you can use to identify the Physical Card Profile.
     */
    #[Required]
    public string $description;

    /**
     * The identifier of the File containing the physical card's front image. This will be missing until the image has been post-processed.
     */
    #[Required('front_image_file_id')]
    public ?string $frontImageFileID;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * Whether this Physical Card Profile is the default for all cards in its Increase group.
     */
    #[Required('is_default')]
    public bool $isDefault;

    /**
     * The identifier for the Program this Physical Card Profile belongs to.
     */
    #[Required('program_id')]
    public string $programID;

    /**
     * The status of the Physical Card Profile.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `physical_card_profile`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new PhysicalCardProfile()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PhysicalCardProfile::with(
     *   id: ...,
     *   backImageFileID: ...,
     *   carrierImageFileID: ...,
     *   contactPhone: ...,
     *   createdAt: ...,
     *   creator: ...,
     *   description: ...,
     *   frontImageFileID: ...,
     *   idempotencyKey: ...,
     *   isDefault: ...,
     *   programID: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PhysicalCardProfile)
     *   ->withID(...)
     *   ->withBackImageFileID(...)
     *   ->withCarrierImageFileID(...)
     *   ->withContactPhone(...)
     *   ->withCreatedAt(...)
     *   ->withCreator(...)
     *   ->withDescription(...)
     *   ->withFrontImageFileID(...)
     *   ->withIdempotencyKey(...)
     *   ->withIsDefault(...)
     *   ->withProgramID(...)
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
     * @param Creator|value-of<Creator> $creator
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        ?string $backImageFileID,
        ?string $carrierImageFileID,
        ?string $contactPhone,
        \DateTimeInterface $createdAt,
        Creator|string $creator,
        string $description,
        ?string $frontImageFileID,
        ?string $idempotencyKey,
        bool $isDefault,
        string $programID,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['backImageFileID'] = $backImageFileID;
        $self['carrierImageFileID'] = $carrierImageFileID;
        $self['contactPhone'] = $contactPhone;
        $self['createdAt'] = $createdAt;
        $self['creator'] = $creator;
        $self['description'] = $description;
        $self['frontImageFileID'] = $frontImageFileID;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['isDefault'] = $isDefault;
        $self['programID'] = $programID;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Card Profile identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier of the File containing the physical card's back image. This will be missing until the image has been post-processed.
     */
    public function withBackImageFileID(?string $backImageFileID): self
    {
        $self = clone $this;
        $self['backImageFileID'] = $backImageFileID;

        return $self;
    }

    /**
     * The identifier of the File containing the physical card's carrier image. This will be missing until the image has been post-processed.
     */
    public function withCarrierImageFileID(?string $carrierImageFileID): self
    {
        $self = clone $this;
        $self['carrierImageFileID'] = $carrierImageFileID;

        return $self;
    }

    /**
     * A phone number the user can contact to receive support for their card.
     */
    public function withContactPhone(?string $contactPhone): self
    {
        $self = clone $this;
        $self['contactPhone'] = $contactPhone;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The creator of this Physical Card Profile.
     *
     * @param Creator|value-of<Creator> $creator
     */
    public function withCreator(Creator|string $creator): self
    {
        $self = clone $this;
        $self['creator'] = $creator;

        return $self;
    }

    /**
     * A description you can use to identify the Physical Card Profile.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The identifier of the File containing the physical card's front image. This will be missing until the image has been post-processed.
     */
    public function withFrontImageFileID(?string $frontImageFileID): self
    {
        $self = clone $this;
        $self['frontImageFileID'] = $frontImageFileID;

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
     * Whether this Physical Card Profile is the default for all cards in its Increase group.
     */
    public function withIsDefault(bool $isDefault): self
    {
        $self = clone $this;
        $self['isDefault'] = $isDefault;

        return $self;
    }

    /**
     * The identifier for the Program this Physical Card Profile belongs to.
     */
    public function withProgramID(string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

        return $self;
    }

    /**
     * The status of the Physical Card Profile.
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
     * A constant representing the object's type. For this resource it will always be `physical_card_profile`.
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

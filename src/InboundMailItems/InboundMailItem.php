<?php

declare(strict_types=1);

namespace Increase\InboundMailItems;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundMailItems\InboundMailItem\Check;
use Increase\InboundMailItems\InboundMailItem\RejectionReason;
use Increase\InboundMailItems\InboundMailItem\Status;
use Increase\InboundMailItems\InboundMailItem\Type;

/**
 * Inbound Mail Items represent pieces of physical mail delivered to a Lockbox.
 *
 * @phpstan-import-type CheckShape from \Increase\InboundMailItems\InboundMailItem\Check
 *
 * @phpstan-type InboundMailItemShape = array{
 *   id: string,
 *   checks: list<Check|CheckShape>,
 *   createdAt: \DateTimeInterface,
 *   fileID: string,
 *   lockboxID: string|null,
 *   recipientName: string|null,
 *   rejectionReason: null|RejectionReason|value-of<RejectionReason>,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class InboundMailItem implements BaseModel
{
    /** @use SdkModel<InboundMailItemShape> */
    use SdkModel;

    /**
     * The Inbound Mail Item identifier.
     */
    #[Required]
    public string $id;

    /**
     * The checks in the mail item.
     *
     * @var list<Check> $checks
     */
    #[Required(list: Check::class)]
    public array $checks;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Inbound Mail Item was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The identifier for the File containing the scanned contents of the mail item.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * The identifier for the Lockbox that received this mail item. For mail items that could not be processed due to an invalid address, this will be null.
     */
    #[Required('lockbox_id')]
    public ?string $lockboxID;

    /**
     * The recipient name as written on the mail item.
     */
    #[Required('recipient_name')]
    public ?string $recipientName;

    /**
     * If the mail item has been rejected, why it was rejected.
     *
     * @var value-of<RejectionReason>|null $rejectionReason
     */
    #[Required('rejection_reason', enum: RejectionReason::class)]
    public ?string $rejectionReason;

    /**
     * If the mail item has been processed.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_mail_item`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new InboundMailItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundMailItem::with(
     *   id: ...,
     *   checks: ...,
     *   createdAt: ...,
     *   fileID: ...,
     *   lockboxID: ...,
     *   recipientName: ...,
     *   rejectionReason: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundMailItem)
     *   ->withID(...)
     *   ->withChecks(...)
     *   ->withCreatedAt(...)
     *   ->withFileID(...)
     *   ->withLockboxID(...)
     *   ->withRecipientName(...)
     *   ->withRejectionReason(...)
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
     * @param list<Check|CheckShape> $checks
     * @param RejectionReason|value-of<RejectionReason>|null $rejectionReason
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        array $checks,
        \DateTimeInterface $createdAt,
        string $fileID,
        ?string $lockboxID,
        ?string $recipientName,
        RejectionReason|string|null $rejectionReason,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['checks'] = $checks;
        $self['createdAt'] = $createdAt;
        $self['fileID'] = $fileID;
        $self['lockboxID'] = $lockboxID;
        $self['recipientName'] = $recipientName;
        $self['rejectionReason'] = $rejectionReason;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Inbound Mail Item identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The checks in the mail item.
     *
     * @param list<Check|CheckShape> $checks
     */
    public function withChecks(array $checks): self
    {
        $self = clone $this;
        $self['checks'] = $checks;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Inbound Mail Item was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The identifier for the File containing the scanned contents of the mail item.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * The identifier for the Lockbox that received this mail item. For mail items that could not be processed due to an invalid address, this will be null.
     */
    public function withLockboxID(?string $lockboxID): self
    {
        $self = clone $this;
        $self['lockboxID'] = $lockboxID;

        return $self;
    }

    /**
     * The recipient name as written on the mail item.
     */
    public function withRecipientName(?string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * If the mail item has been rejected, why it was rejected.
     *
     * @param RejectionReason|value-of<RejectionReason>|null $rejectionReason
     */
    public function withRejectionReason(
        RejectionReason|string|null $rejectionReason
    ): self {
        $self = clone $this;
        $self['rejectionReason'] = $rejectionReason;

        return $self;
    }

    /**
     * If the mail item has been processed.
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
     * A constant representing the object's type. For this resource it will always be `inbound_mail_item`.
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

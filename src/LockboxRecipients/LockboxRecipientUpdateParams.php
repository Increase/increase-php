<?php

declare(strict_types=1);

namespace Increase\LockboxRecipients;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\LockboxRecipients\LockboxRecipientUpdateParams\Status;

/**
 * Update a Lockbox Recipient.
 *
 * @see Increase\Services\LockboxRecipientsService::update()
 *
 * @phpstan-type LockboxRecipientUpdateParamsShape = array{
 *   description?: string|null,
 *   recipientName?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class LockboxRecipientUpdateParams implements BaseModel
{
    /** @use SdkModel<LockboxRecipientUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The description you choose for the Lockbox Recipient.
     */
    #[Optional]
    public ?string $description;

    /**
     * The name of the Lockbox Recipient.
     */
    #[Optional('recipient_name')]
    public ?string $recipientName;

    /**
     * The status of the Lockbox Recipient.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $description = null,
        ?string $recipientName = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $recipientName && $self['recipientName'] = $recipientName;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * The description you choose for the Lockbox Recipient.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The name of the Lockbox Recipient.
     */
    public function withRecipientName(string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * The status of the Lockbox Recipient.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}

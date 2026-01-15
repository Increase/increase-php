<?php

declare(strict_types=1);

namespace Increase\EventSubscriptions;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\EventSubscriptions\EventSubscriptionUpdateParams\Status;

/**
 * Update an Event Subscription.
 *
 * @see Increase\Services\EventSubscriptionsService::update()
 *
 * @phpstan-type EventSubscriptionUpdateParamsShape = array{
 *   status?: null|Status|value-of<Status>
 * }
 */
final class EventSubscriptionUpdateParams implements BaseModel
{
    /** @use SdkModel<EventSubscriptionUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The status to update the Event Subscription with.
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
    public static function with(Status|string|null $status = null): self
    {
        $self = new self;

        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * The status to update the Event Subscription with.
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

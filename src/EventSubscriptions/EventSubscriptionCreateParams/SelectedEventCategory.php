<?php

declare(strict_types=1);

namespace Increase\EventSubscriptions\EventSubscriptionCreateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\EventSubscriptions\EventSubscriptionCreateParams\SelectedEventCategory\EventCategory;

/**
 * @phpstan-type SelectedEventCategoryShape = array{
 *   eventCategory: EventCategory|value-of<EventCategory>
 * }
 */
final class SelectedEventCategory implements BaseModel
{
    /** @use SdkModel<SelectedEventCategoryShape> */
    use SdkModel;

    /**
     * The category of the Event to subscribe to.
     *
     * @var value-of<EventCategory> $eventCategory
     */
    #[Required('event_category', enum: EventCategory::class)]
    public string $eventCategory;

    /**
     * `new SelectedEventCategory()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SelectedEventCategory::with(eventCategory: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SelectedEventCategory)->withEventCategory(...)
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
     * @param EventCategory|value-of<EventCategory> $eventCategory
     */
    public static function with(EventCategory|string $eventCategory): self
    {
        $self = new self;

        $self['eventCategory'] = $eventCategory;

        return $self;
    }

    /**
     * The category of the Event to subscribe to.
     *
     * @param EventCategory|value-of<EventCategory> $eventCategory
     */
    public function withEventCategory(EventCategory|string $eventCategory): self
    {
        $self = clone $this;
        $self['eventCategory'] = $eventCategory;

        return $self;
    }
}

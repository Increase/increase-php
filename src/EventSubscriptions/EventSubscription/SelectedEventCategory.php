<?php

declare(strict_types=1);

namespace Increase\EventSubscriptions\EventSubscription;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\EventSubscriptions\EventSubscription\SelectedEventCategory\EventCategory;

/**
 * @phpstan-type SelectedEventCategoryShape = array{
 *   eventCategory: null|EventCategory|value-of<EventCategory>
 * }
 */
final class SelectedEventCategory implements BaseModel
{
    /** @use SdkModel<SelectedEventCategoryShape> */
    use SdkModel;

    /**
     * The category of the Event.
     *
     * @var value-of<EventCategory>|null $eventCategory
     */
    #[Required('event_category', enum: EventCategory::class)]
    public ?string $eventCategory;

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
     * @param EventCategory|value-of<EventCategory>|null $eventCategory
     */
    public static function with(EventCategory|string|null $eventCategory): self
    {
        $self = new self;

        $self['eventCategory'] = $eventCategory;

        return $self;
    }

    /**
     * The category of the Event.
     *
     * @param EventCategory|value-of<EventCategory>|null $eventCategory
     */
    public function withEventCategory(
        EventCategory|string|null $eventCategory
    ): self {
        $self = clone $this;
        $self['eventCategory'] = $eventCategory;

        return $self;
    }
}

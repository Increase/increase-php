<?php

declare(strict_types=1);

namespace Increase\EventSubscriptions\EventSubscription;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\EventSubscriptions\EventSubscription\SelectedEventCategory1\EventCategory;

/**
 * @phpstan-type SelectedEventCategory1Shape = array{
 *   eventCategory: null|EventCategory|value-of<EventCategory>
 * }
 */
final class SelectedEventCategory1 implements BaseModel
{
    /** @use SdkModel<SelectedEventCategory1Shape> */
    use SdkModel;

    /**
     * The category of the Event.
     *
     * @var value-of<EventCategory>|null $eventCategory
     */
    #[Required('event_category', enum: EventCategory::class)]
    public ?string $eventCategory;

    /**
     * `new SelectedEventCategory1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SelectedEventCategory1::with(eventCategory: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SelectedEventCategory1)->withEventCategory(...)
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

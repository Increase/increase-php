<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardDisputeFinancial;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardDisputeFinancial\Visa\EventType;

/**
 * Information for events related to card dispute for card payments processed over Visa's network. This field will be present in the JSON response if and only if `network` is equal to `visa`.
 *
 * @phpstan-type VisaShape = array{eventType: EventType|value-of<EventType>}
 */
final class Visa implements BaseModel
{
    /** @use SdkModel<VisaShape> */
    use SdkModel;

    /**
     * The type of card dispute financial event.
     *
     * @var value-of<EventType> $eventType
     */
    #[Required('event_type', enum: EventType::class)]
    public string $eventType;

    /**
     * `new Visa()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Visa::with(eventType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Visa)->withEventType(...)
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
     * @param EventType|value-of<EventType> $eventType
     */
    public static function with(EventType|string $eventType): self
    {
        $self = new self;

        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * The type of card dispute financial event.
     *
     * @param EventType|value-of<EventType> $eventType
     */
    public function withEventType(EventType|string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }
}

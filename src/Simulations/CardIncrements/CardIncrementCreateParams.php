<?php

declare(strict_types=1);

namespace Increase\Simulations\CardIncrements;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates the increment of an authorization by a card acquirer. An authorization can be incremented multiple times.
 *
 * @see Increase\Services\Simulations\CardIncrementsService::create()
 *
 * @phpstan-type CardIncrementCreateParamsShape = array{
 *   amount: int, cardPaymentID: string, eventSubscriptionID?: string|null
 * }
 */
final class CardIncrementCreateParams implements BaseModel
{
    /** @use SdkModel<CardIncrementCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The amount of the increment in minor units in the card authorization's currency.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the Card Payment to create an increment on.
     */
    #[Required('card_payment_id')]
    public string $cardPaymentID;

    /**
     * The identifier of the Event Subscription to use. If provided, will override the default real time event subscription. Because you can only create one real time decision event subscription, you can use this field to route events to any specified event subscription for testing purposes.
     */
    #[Optional('event_subscription_id')]
    public ?string $eventSubscriptionID;

    /**
     * `new CardIncrementCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardIncrementCreateParams::with(amount: ..., cardPaymentID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardIncrementCreateParams)->withAmount(...)->withCardPaymentID(...)
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
     */
    public static function with(
        int $amount,
        string $cardPaymentID,
        ?string $eventSubscriptionID = null
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['cardPaymentID'] = $cardPaymentID;

        null !== $eventSubscriptionID && $self['eventSubscriptionID'] = $eventSubscriptionID;

        return $self;
    }

    /**
     * The amount of the increment in minor units in the card authorization's currency.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Card Payment to create an increment on.
     */
    public function withCardPaymentID(string $cardPaymentID): self
    {
        $self = clone $this;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }

    /**
     * The identifier of the Event Subscription to use. If provided, will override the default real time event subscription. Because you can only create one real time decision event subscription, you can use this field to route events to any specified event subscription for testing purposes.
     */
    public function withEventSubscriptionID(string $eventSubscriptionID): self
    {
        $self = clone $this;
        $self['eventSubscriptionID'] = $eventSubscriptionID;

        return $self;
    }
}

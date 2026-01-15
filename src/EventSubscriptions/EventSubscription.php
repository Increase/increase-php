<?php

declare(strict_types=1);

namespace Increase\EventSubscriptions;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\EventSubscriptions\EventSubscription\SelectedEventCategory;
use Increase\EventSubscriptions\EventSubscription\Status;
use Increase\EventSubscriptions\EventSubscription\Type;

/**
 * Webhooks are event notifications we send to you by HTTPS POST requests. Event Subscriptions are how you configure your application to listen for them. You can create an Event Subscription through your [developer dashboard](https://dashboard.increase.com/developers/webhooks) or the API. For more information, see our [webhooks guide](https://increase.com/documentation/webhooks).
 *
 * @phpstan-type EventSubscriptionShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   idempotencyKey: string|null,
 *   oauthConnectionID: string|null,
 *   selectedEventCategory: null|SelectedEventCategory|value-of<SelectedEventCategory>,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 *   url: string,
 * }
 */
final class EventSubscription implements BaseModel
{
    /** @use SdkModel<EventSubscriptionShape> */
    use SdkModel;

    /**
     * The event subscription identifier.
     */
    #[Required]
    public string $id;

    /**
     * The time the event subscription was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * If specified, this subscription will only receive webhooks for Events associated with this OAuth Connection.
     */
    #[Required('oauth_connection_id')]
    public ?string $oauthConnectionID;

    /**
     * If specified, this subscription will only receive webhooks for Events with the specified `category`.
     *
     * @var value-of<SelectedEventCategory>|null $selectedEventCategory
     */
    #[Required('selected_event_category', enum: SelectedEventCategory::class)]
    public ?string $selectedEventCategory;

    /**
     * This indicates if we'll send notifications to this subscription.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `event_subscription`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The webhook url where we'll send notifications.
     */
    #[Required]
    public string $url;

    /**
     * `new EventSubscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EventSubscription::with(
     *   id: ...,
     *   createdAt: ...,
     *   idempotencyKey: ...,
     *   oauthConnectionID: ...,
     *   selectedEventCategory: ...,
     *   status: ...,
     *   type: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EventSubscription)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withIdempotencyKey(...)
     *   ->withOAuthConnectionID(...)
     *   ->withSelectedEventCategory(...)
     *   ->withStatus(...)
     *   ->withType(...)
     *   ->withURL(...)
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
     * @param SelectedEventCategory|value-of<SelectedEventCategory>|null $selectedEventCategory
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        ?string $idempotencyKey,
        ?string $oauthConnectionID,
        SelectedEventCategory|string|null $selectedEventCategory,
        Status|string $status,
        Type|string $type,
        string $url,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['oauthConnectionID'] = $oauthConnectionID;
        $self['selectedEventCategory'] = $selectedEventCategory;
        $self['status'] = $status;
        $self['type'] = $type;
        $self['url'] = $url;

        return $self;
    }

    /**
     * The event subscription identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The time the event subscription was created.
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
     * If specified, this subscription will only receive webhooks for Events associated with this OAuth Connection.
     */
    public function withOAuthConnectionID(?string $oauthConnectionID): self
    {
        $self = clone $this;
        $self['oauthConnectionID'] = $oauthConnectionID;

        return $self;
    }

    /**
     * If specified, this subscription will only receive webhooks for Events with the specified `category`.
     *
     * @param SelectedEventCategory|value-of<SelectedEventCategory>|null $selectedEventCategory
     */
    public function withSelectedEventCategory(
        SelectedEventCategory|string|null $selectedEventCategory
    ): self {
        $self = clone $this;
        $self['selectedEventCategory'] = $selectedEventCategory;

        return $self;
    }

    /**
     * This indicates if we'll send notifications to this subscription.
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
     * A constant representing the object's type. For this resource it will always be `event_subscription`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The webhook url where we'll send notifications.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\EventSubscriptions;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\EventSubscriptions\EventSubscriptionCreateParams\SelectedEventCategory;
use Increase\EventSubscriptions\EventSubscriptionCreateParams\Status;

/**
 * Create an Event Subscription.
 *
 * @see Increase\Services\EventSubscriptionsService::create()
 *
 * @phpstan-type EventSubscriptionCreateParamsShape = array{
 *   url: string,
 *   oauthConnectionID?: string|null,
 *   selectedEventCategory?: null|SelectedEventCategory|value-of<SelectedEventCategory>,
 *   sharedSecret?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class EventSubscriptionCreateParams implements BaseModel
{
    /** @use SdkModel<EventSubscriptionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The URL you'd like us to send webhooks to.
     */
    #[Required]
    public string $url;

    /**
     * If specified, this subscription will only receive webhooks for Events associated with the specified OAuth Connection.
     */
    #[Optional('oauth_connection_id')]
    public ?string $oauthConnectionID;

    /**
     * If specified, this subscription will only receive webhooks for Events with the specified `category`.
     *
     * @var value-of<SelectedEventCategory>|null $selectedEventCategory
     */
    #[Optional('selected_event_category', enum: SelectedEventCategory::class)]
    public ?string $selectedEventCategory;

    /**
     * The key that will be used to sign webhooks. If no value is passed, a random string will be used as default.
     */
    #[Optional('shared_secret')]
    public ?string $sharedSecret;

    /**
     * The status of the event subscription. Defaults to `active` if not specified.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * `new EventSubscriptionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EventSubscriptionCreateParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EventSubscriptionCreateParams)->withURL(...)
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
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        string $url,
        ?string $oauthConnectionID = null,
        SelectedEventCategory|string|null $selectedEventCategory = null,
        ?string $sharedSecret = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $oauthConnectionID && $self['oauthConnectionID'] = $oauthConnectionID;
        null !== $selectedEventCategory && $self['selectedEventCategory'] = $selectedEventCategory;
        null !== $sharedSecret && $self['sharedSecret'] = $sharedSecret;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * The URL you'd like us to send webhooks to.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * If specified, this subscription will only receive webhooks for Events associated with the specified OAuth Connection.
     */
    public function withOAuthConnectionID(string $oauthConnectionID): self
    {
        $self = clone $this;
        $self['oauthConnectionID'] = $oauthConnectionID;

        return $self;
    }

    /**
     * If specified, this subscription will only receive webhooks for Events with the specified `category`.
     *
     * @param SelectedEventCategory|value-of<SelectedEventCategory> $selectedEventCategory
     */
    public function withSelectedEventCategory(
        SelectedEventCategory|string $selectedEventCategory
    ): self {
        $self = clone $this;
        $self['selectedEventCategory'] = $selectedEventCategory;

        return $self;
    }

    /**
     * The key that will be used to sign webhooks. If no value is passed, a random string will be used as default.
     */
    public function withSharedSecret(string $sharedSecret): self
    {
        $self = clone $this;
        $self['sharedSecret'] = $sharedSecret;

        return $self;
    }

    /**
     * The status of the event subscription. Defaults to `active` if not specified.
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

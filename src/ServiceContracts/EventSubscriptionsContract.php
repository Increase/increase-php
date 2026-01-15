<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\EventSubscriptions\EventSubscription;
use Increase\EventSubscriptions\EventSubscriptionCreateParams\SelectedEventCategory;
use Increase\EventSubscriptions\EventSubscriptionCreateParams\Status;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface EventSubscriptionsContract
{
    /**
     * @api
     *
     * @param string $url the URL you'd like us to send webhooks to
     * @param string $oauthConnectionID if specified, this subscription will only receive webhooks for Events associated with the specified OAuth Connection
     * @param SelectedEventCategory|value-of<SelectedEventCategory> $selectedEventCategory if specified, this subscription will only receive webhooks for Events with the specified `category`
     * @param string $sharedSecret The key that will be used to sign webhooks. If no value is passed, a random string will be used as default.
     * @param Status|value-of<Status> $status The status of the event subscription. Defaults to `active` if not specified.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $url,
        ?string $oauthConnectionID = null,
        SelectedEventCategory|string|null $selectedEventCategory = null,
        ?string $sharedSecret = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): EventSubscription;

    /**
     * @api
     *
     * @param string $eventSubscriptionID the identifier of the Event Subscription
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventSubscriptionID,
        RequestOptions|array|null $requestOptions = null,
    ): EventSubscription;

    /**
     * @api
     *
     * @param string $eventSubscriptionID the identifier of the Event Subscription
     * @param \Increase\EventSubscriptions\EventSubscriptionUpdateParams\Status|value-of<\Increase\EventSubscriptions\EventSubscriptionUpdateParams\Status> $status the status to update the Event Subscription with
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $eventSubscriptionID,
        \Increase\EventSubscriptions\EventSubscriptionUpdateParams\Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): EventSubscription;

    /**
     * @api
     *
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<EventSubscription>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}

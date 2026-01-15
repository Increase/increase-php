<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\EventSubscriptions\EventSubscription;
use Increase\EventSubscriptions\EventSubscriptionCreateParams;
use Increase\EventSubscriptions\EventSubscriptionCreateParams\SelectedEventCategory;
use Increase\EventSubscriptions\EventSubscriptionCreateParams\Status;
use Increase\EventSubscriptions\EventSubscriptionListParams;
use Increase\EventSubscriptions\EventSubscriptionUpdateParams;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\EventSubscriptionsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class EventSubscriptionsRawService implements EventSubscriptionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an Event Subscription
     *
     * @param array{
     *   url: string,
     *   oauthConnectionID?: string,
     *   selectedEventCategory?: value-of<SelectedEventCategory>,
     *   sharedSecret?: string,
     *   status?: Status|value-of<Status>,
     * }|EventSubscriptionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EventSubscription>
     *
     * @throws APIException
     */
    public function create(
        array|EventSubscriptionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EventSubscriptionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'event_subscriptions',
            body: (object) $parsed,
            options: $options,
            convert: EventSubscription::class,
        );
    }

    /**
     * @api
     *
     * Retrieve an Event Subscription
     *
     * @param string $eventSubscriptionID the identifier of the Event Subscription
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EventSubscription>
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventSubscriptionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['event_subscriptions/%1$s', $eventSubscriptionID],
            options: $requestOptions,
            convert: EventSubscription::class,
        );
    }

    /**
     * @api
     *
     * Update an Event Subscription
     *
     * @param string $eventSubscriptionID the identifier of the Event Subscription
     * @param array{
     *   status?: EventSubscriptionUpdateParams\Status|value-of<EventSubscriptionUpdateParams\Status>,
     * }|EventSubscriptionUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EventSubscription>
     *
     * @throws APIException
     */
    public function update(
        string $eventSubscriptionID,
        array|EventSubscriptionUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EventSubscriptionUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['event_subscriptions/%1$s', $eventSubscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: EventSubscription::class,
        );
    }

    /**
     * @api
     *
     * List Event Subscriptions
     *
     * @param array{
     *   cursor?: string, idempotencyKey?: string, limit?: int
     * }|EventSubscriptionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<EventSubscription>>
     *
     * @throws APIException
     */
    public function list(
        array|EventSubscriptionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EventSubscriptionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'event_subscriptions',
            query: Util::array_transform_keys(
                $parsed,
                ['idempotencyKey' => 'idempotency_key']
            ),
            options: $options,
            convert: EventSubscription::class,
            page: Page::class,
        );
    }
}

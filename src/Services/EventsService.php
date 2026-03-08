<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Conversion;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Exceptions\WebhookException;
use Increase\Core\Util;
use Increase\Events\Event;
use Increase\Events\EventListParams\Category;
use Increase\Events\EventListParams\CreatedAt;
use Increase\Events\UnwrapWebhookEvent;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\EventsContract;
use StandardWebhooks\Exception\WebhookVerificationException;
use StandardWebhooks\Webhook;

/**
 * @phpstan-import-type CategoryShape from \Increase\Events\EventListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\Events\EventListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class EventsService implements EventsContract
{
    /**
     * @api
     */
    public EventsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EventsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an Event
     *
     * @param string $eventID the identifier of the Event
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        RequestOptions|array|null $requestOptions = null
    ): Event {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($eventID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Events
     *
     * @param string $associatedObjectID filter Events to those belonging to the object with the provided identifier
     * @param Category|CategoryShape $category
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<Event>
     *
     * @throws APIException
     */
    public function list(
        ?string $associatedObjectID = null,
        Category|array|null $category = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'associatedObjectID' => $associatedObjectID,
                'category' => $category,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Unwraps a webhook event from its JSON representation.
     *
     * @param array<string,string|list<string>>|null $headers
     *
     * @throws WebhookException
     */
    public function unwrap(
        string $body,
        ?array $headers = null,
        ?string $secret = null
    ): UnwrapWebhookEvent {
        if (null !== $headers) {
            $secret = $secret ?? ($this->client->webhookSecret ?: null);
            if (null === $secret) {
                throw new WebhookException('Webhook key must not be null in order to unwrap');
            }

            try {
                $flatHeaders = array_map(fn (string|array $v): string => is_array($v) ? $v[0] : $v, $headers);
                $webhook = new Webhook('whsec_'.base64_encode($secret));
                $webhook->verify($body, $flatHeaders);
            } catch (WebhookVerificationException $e) {
                throw new WebhookException('Could not verify webhook event signature', previous: $e);
            }
        }

        try {
            $decoded = Util::decodeJson($body);

            // @phpstan-ignore return.type
            return Conversion::coerce(UnwrapWebhookEvent::class, value: $decoded);
        } catch (\Throwable $e) {
            throw new WebhookException('Error parsing webhook body', previous: $e);
        }
    }
}

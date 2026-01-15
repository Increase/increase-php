<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Events\Event;
use Increase\Events\EventListParams;
use Increase\Events\EventListParams\Category;
use Increase\Events\EventListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\EventsRawContract;

/**
 * @phpstan-import-type CategoryShape from \Increase\Events\EventListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\Events\EventListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class EventsRawService implements EventsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an Event
     *
     * @param string $eventID the identifier of the Event
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Event>
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['events/%1$s', $eventID],
            options: $requestOptions,
            convert: Event::class,
        );
    }

    /**
     * @api
     *
     * List Events
     *
     * @param array{
     *   associatedObjectID?: string,
     *   category?: Category|CategoryShape,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     * }|EventListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Event>>
     *
     * @throws APIException
     */
    public function list(
        array|EventListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EventListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'events',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'associatedObjectID' => 'associated_object_id',
                    'createdAt' => 'created_at',
                ],
            ),
            options: $options,
            convert: Event::class,
            page: Page::class,
        );
    }
}

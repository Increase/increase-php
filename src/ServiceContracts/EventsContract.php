<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\Events\Event;
use Increase\Events\EventListParams\Category;
use Increase\Events\EventListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CategoryShape from \Increase\Events\EventListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\Events\EventListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface EventsContract
{
    /**
     * @api
     *
     * @param string $eventID the identifier of the Event
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        RequestOptions|array|null $requestOptions = null
    ): Event;

    /**
     * @api
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
    ): Page;
}

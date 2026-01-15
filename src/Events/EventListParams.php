<?php

declare(strict_types=1);

namespace Increase\Events;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Events\EventListParams\Category;
use Increase\Events\EventListParams\CreatedAt;

/**
 * List Events.
 *
 * @see Increase\Services\EventsService::list()
 *
 * @phpstan-import-type CategoryShape from \Increase\Events\EventListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\Events\EventListParams\CreatedAt
 *
 * @phpstan-type EventListParamsShape = array{
 *   associatedObjectID?: string|null,
 *   category?: null|Category|CategoryShape,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   limit?: int|null,
 * }
 */
final class EventListParams implements BaseModel
{
    /** @use SdkModel<EventListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Events to those belonging to the object with the provided identifier.
     */
    #[Optional]
    public ?string $associatedObjectID;

    #[Optional]
    public ?Category $category;

    #[Optional]
    public ?CreatedAt $createdAt;

    /**
     * Return the page of entries after this one.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    #[Optional]
    public ?int $limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Category|CategoryShape|null $category
     * @param CreatedAt|CreatedAtShape|null $createdAt
     */
    public static function with(
        ?string $associatedObjectID = null,
        Category|array|null $category = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
    ): self {
        $self = new self;

        null !== $associatedObjectID && $self['associatedObjectID'] = $associatedObjectID;
        null !== $category && $self['category'] = $category;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter Events to those belonging to the object with the provided identifier.
     */
    public function withAssociatedObjectID(string $associatedObjectID): self
    {
        $self = clone $this;
        $self['associatedObjectID'] = $associatedObjectID;

        return $self;
    }

    /**
     * @param Category|CategoryShape $category
     */
    public function withCategory(Category|array $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * @param CreatedAt|CreatedAtShape $createdAt
     */
    public function withCreatedAt(CreatedAt|array $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Return the page of entries after this one.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}

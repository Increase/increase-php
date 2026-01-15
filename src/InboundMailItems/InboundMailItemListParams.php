<?php

declare(strict_types=1);

namespace Increase\InboundMailItems;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundMailItems\InboundMailItemListParams\CreatedAt;

/**
 * List Inbound Mail Items.
 *
 * @see Increase\Services\InboundMailItemsService::list()
 *
 * @phpstan-import-type CreatedAtShape from \Increase\InboundMailItems\InboundMailItemListParams\CreatedAt
 *
 * @phpstan-type InboundMailItemListParamsShape = array{
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   lockboxID?: string|null,
 * }
 */
final class InboundMailItemListParams implements BaseModel
{
    /** @use SdkModel<InboundMailItemListParamsShape> */
    use SdkModel;
    use SdkParams;

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

    /**
     * Filter Inbound Mail Items to ones sent to the provided Lockbox.
     */
    #[Optional]
    public ?string $lockboxID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CreatedAt|CreatedAtShape|null $createdAt
     */
    public static function with(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        ?string $lockboxID = null,
    ): self {
        $self = new self;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $lockboxID && $self['lockboxID'] = $lockboxID;

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

    /**
     * Filter Inbound Mail Items to ones sent to the provided Lockbox.
     */
    public function withLockboxID(string $lockboxID): self
    {
        $self = clone $this;
        $self['lockboxID'] = $lockboxID;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\InboundWireDrawdownRequests;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * List Inbound Wire Drawdown Requests.
 *
 * @see Increase\Services\InboundWireDrawdownRequestsService::list()
 *
 * @phpstan-type InboundWireDrawdownRequestListParamsShape = array{
 *   cursor?: string|null, limit?: int|null
 * }
 */
final class InboundWireDrawdownRequestListParams implements BaseModel
{
    /** @use SdkModel<InboundWireDrawdownRequestListParamsShape> */
    use SdkModel;
    use SdkParams;

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
     */
    public static function with(?string $cursor = null, ?int $limit = null): self
    {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

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

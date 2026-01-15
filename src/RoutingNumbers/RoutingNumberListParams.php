<?php

declare(strict_types=1);

namespace Increase\RoutingNumbers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * You can use this API to confirm if a routing number is valid, such as when a user is providing you with bank account details. Since routing numbers uniquely identify a bank, this will always return 0 or 1 entry. In Sandbox, the only valid routing number for this method is 110000000.
 *
 * @see Increase\Services\RoutingNumbersService::list()
 *
 * @phpstan-type RoutingNumberListParamsShape = array{
 *   routingNumber: string, cursor?: string|null, limit?: int|null
 * }
 */
final class RoutingNumberListParams implements BaseModel
{
    /** @use SdkModel<RoutingNumberListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter financial institutions by routing number.
     */
    #[Required]
    public string $routingNumber;

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
     * `new RoutingNumberListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingNumberListParams::with(routingNumber: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingNumberListParams)->withRoutingNumber(...)
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
     */
    public static function with(
        string $routingNumber,
        ?string $cursor = null,
        ?int $limit = null
    ): self {
        $self = new self;

        $self['routingNumber'] = $routingNumber;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter financial institutions by routing number.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

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

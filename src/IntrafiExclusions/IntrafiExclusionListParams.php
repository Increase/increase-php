<?php

declare(strict_types=1);

namespace Increase\IntrafiExclusions;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * List IntraFi Exclusions.
 *
 * @see Increase\Services\IntrafiExclusionsService::list()
 *
 * @phpstan-type IntrafiExclusionListParamsShape = array{
 *   cursor?: string|null,
 *   entityID?: string|null,
 *   idempotencyKey?: string|null,
 *   limit?: int|null,
 * }
 */
final class IntrafiExclusionListParams implements BaseModel
{
    /** @use SdkModel<IntrafiExclusionListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Return the page of entries after this one.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Filter IntraFi Exclusions for those belonging to the specified Entity.
     */
    #[Optional]
    public ?string $entityID;

    /**
     * Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Optional]
    public ?string $idempotencyKey;

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
    public static function with(
        ?string $cursor = null,
        ?string $entityID = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $entityID && $self['entityID'] = $entityID;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
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
     * Filter IntraFi Exclusions for those belonging to the specified Entity.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

        return $self;
    }

    /**
     * Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

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

<?php

declare(strict_types=1);

namespace Increase\Exports\Export\FeeCsv;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Filter fees by their created date. The time range must not include any fees that are part of an open fee statement.
 *
 * @phpstan-type CreatedAtShape = array{
 *   after: \DateTimeInterface|null, before: \DateTimeInterface|null
 * }
 */
final class CreatedAt implements BaseModel
{
    /** @use SdkModel<CreatedAtShape> */
    use SdkModel;

    /**
     * Filter fees created after this time.
     */
    #[Required]
    public ?\DateTimeInterface $after;

    /**
     * Filter fees created before this time.
     */
    #[Required]
    public ?\DateTimeInterface $before;

    /**
     * `new CreatedAt()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreatedAt::with(after: ..., before: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreatedAt)->withAfter(...)->withBefore(...)
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
        ?\DateTimeInterface $after,
        ?\DateTimeInterface $before
    ): self {
        $self = new self;

        $self['after'] = $after;
        $self['before'] = $before;

        return $self;
    }

    /**
     * Filter fees created after this time.
     */
    public function withAfter(?\DateTimeInterface $after): self
    {
        $self = clone $this;
        $self['after'] = $after;

        return $self;
    }

    /**
     * Filter fees created before this time.
     */
    public function withBefore(?\DateTimeInterface $before): self
    {
        $self = clone $this;
        $self['before'] = $before;

        return $self;
    }
}

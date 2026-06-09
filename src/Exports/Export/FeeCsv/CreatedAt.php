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
 *   after: \DateTimeInterface|null,
 *   before: \DateTimeInterface|null,
 *   onOrAfter: \DateTimeInterface|null,
 *   onOrBefore: \DateTimeInterface|null,
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
     * Filter fees created on or after this time.
     */
    #[Required('on_or_after')]
    public ?\DateTimeInterface $onOrAfter;

    /**
     * Filter fees created on or before this time.
     */
    #[Required('on_or_before')]
    public ?\DateTimeInterface $onOrBefore;

    /**
     * `new CreatedAt()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreatedAt::with(after: ..., before: ..., onOrAfter: ..., onOrBefore: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreatedAt)
     *   ->withAfter(...)
     *   ->withBefore(...)
     *   ->withOnOrAfter(...)
     *   ->withOnOrBefore(...)
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
        ?\DateTimeInterface $before,
        ?\DateTimeInterface $onOrAfter,
        ?\DateTimeInterface $onOrBefore,
    ): self {
        $self = new self;

        $self['after'] = $after;
        $self['before'] = $before;
        $self['onOrAfter'] = $onOrAfter;
        $self['onOrBefore'] = $onOrBefore;

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

    /**
     * Filter fees created on or after this time.
     */
    public function withOnOrAfter(?\DateTimeInterface $onOrAfter): self
    {
        $self = clone $this;
        $self['onOrAfter'] = $onOrAfter;

        return $self;
    }

    /**
     * Filter fees created on or before this time.
     */
    public function withOnOrBefore(?\DateTimeInterface $onOrBefore): self
    {
        $self = clone $this;
        $self['onOrBefore'] = $onOrBefore;

        return $self;
    }
}

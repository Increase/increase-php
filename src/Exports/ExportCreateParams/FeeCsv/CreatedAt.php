<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams\FeeCsv;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Filter exported Fees by the time they were created. This suits historical exports across many fee statements. To get all of the Fees for a given fee statement period, we recommend using `fee_statement_period_start` instead. The time range must not include any Fees on an open fee statement.
 *
 * @phpstan-type CreatedAtShape = array{
 *   after?: \DateTimeInterface|null,
 *   before?: \DateTimeInterface|null,
 *   onOrAfter?: \DateTimeInterface|null,
 *   onOrBefore?: \DateTimeInterface|null,
 * }
 */
final class CreatedAt implements BaseModel
{
    /** @use SdkModel<CreatedAtShape> */
    use SdkModel;

    /**
     * Return results after this [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $after;

    /**
     * Return results before this [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $before;

    /**
     * Return results on or after this [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp.
     */
    #[Optional('on_or_after')]
    public ?\DateTimeInterface $onOrAfter;

    /**
     * Return results on or before this [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp.
     */
    #[Optional('on_or_before')]
    public ?\DateTimeInterface $onOrBefore;

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
        ?\DateTimeInterface $after = null,
        ?\DateTimeInterface $before = null,
        ?\DateTimeInterface $onOrAfter = null,
        ?\DateTimeInterface $onOrBefore = null,
    ): self {
        $self = new self;

        null !== $after && $self['after'] = $after;
        null !== $before && $self['before'] = $before;
        null !== $onOrAfter && $self['onOrAfter'] = $onOrAfter;
        null !== $onOrBefore && $self['onOrBefore'] = $onOrBefore;

        return $self;
    }

    /**
     * Return results after this [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp.
     */
    public function withAfter(\DateTimeInterface $after): self
    {
        $self = clone $this;
        $self['after'] = $after;

        return $self;
    }

    /**
     * Return results before this [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp.
     */
    public function withBefore(\DateTimeInterface $before): self
    {
        $self = clone $this;
        $self['before'] = $before;

        return $self;
    }

    /**
     * Return results on or after this [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp.
     */
    public function withOnOrAfter(\DateTimeInterface $onOrAfter): self
    {
        $self = clone $this;
        $self['onOrAfter'] = $onOrAfter;

        return $self;
    }

    /**
     * Return results on or before this [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) timestamp.
     */
    public function withOnOrBefore(\DateTimeInterface $onOrBefore): self
    {
        $self = clone $this;
        $self['onOrBefore'] = $onOrBefore;

        return $self;
    }
}

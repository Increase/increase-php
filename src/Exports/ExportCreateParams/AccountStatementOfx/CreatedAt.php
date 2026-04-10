<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams\AccountStatementOfx;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Filter transactions by their created date.
 *
 * @phpstan-type CreatedAtShape = array{
 *   before?: \DateTimeInterface|null, onOrAfter?: \DateTimeInterface|null
 * }
 */
final class CreatedAt implements BaseModel
{
    /** @use SdkModel<CreatedAtShape> */
    use SdkModel;

    /**
     * Filter results to transactions created before this time.
     */
    #[Optional]
    public ?\DateTimeInterface $before;

    /**
     * Filter results to transactions created on or after this time.
     */
    #[Optional('on_or_after')]
    public ?\DateTimeInterface $onOrAfter;

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
        ?\DateTimeInterface $before = null,
        ?\DateTimeInterface $onOrAfter = null
    ): self {
        $self = new self;

        null !== $before && $self['before'] = $before;
        null !== $onOrAfter && $self['onOrAfter'] = $onOrAfter;

        return $self;
    }

    /**
     * Filter results to transactions created before this time.
     */
    public function withBefore(\DateTimeInterface $before): self
    {
        $self = clone $this;
        $self['before'] = $before;

        return $self;
    }

    /**
     * Filter results to transactions created on or after this time.
     */
    public function withOnOrAfter(\DateTimeInterface $onOrAfter): self
    {
        $self = clone $this;
        $self['onOrAfter'] = $onOrAfter;

        return $self;
    }
}

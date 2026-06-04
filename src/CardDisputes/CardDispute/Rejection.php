<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the Card Dispute has been rejected, this will contain details of the rejection.
 *
 * @phpstan-type RejectionShape = array{
 *   explanation: string, rejectedAt: \DateTimeInterface
 * }
 */
final class Rejection implements BaseModel
{
    /** @use SdkModel<RejectionShape> */
    use SdkModel;

    /**
     * Why the Card Dispute was rejected.
     */
    #[Required]
    public string $explanation;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was rejected.
     */
    #[Required('rejected_at')]
    public \DateTimeInterface $rejectedAt;

    /**
     * `new Rejection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Rejection::with(explanation: ..., rejectedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Rejection)->withExplanation(...)->withRejectedAt(...)
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
        string $explanation,
        \DateTimeInterface $rejectedAt
    ): self {
        $self = new self;

        $self['explanation'] = $explanation;
        $self['rejectedAt'] = $rejectedAt;

        return $self;
    }

    /**
     * Why the Card Dispute was rejected.
     */
    public function withExplanation(string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was rejected.
     */
    public function withRejectedAt(\DateTimeInterface $rejectedAt): self
    {
        $self = clone $this;
        $self['rejectedAt'] = $rejectedAt;

        return $self;
    }
}

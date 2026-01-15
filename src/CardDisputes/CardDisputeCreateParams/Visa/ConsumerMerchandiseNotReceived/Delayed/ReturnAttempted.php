<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerMerchandiseNotReceived\Delayed;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Return attempted. Required if and only if `return_outcome` is `return_attempted`.
 *
 * @phpstan-type ReturnAttemptedShape = array{attemptedAt: string}
 */
final class ReturnAttempted implements BaseModel
{
    /** @use SdkModel<ReturnAttemptedShape> */
    use SdkModel;

    /**
     * Attempted at.
     */
    #[Required('attempted_at')]
    public string $attemptedAt;

    /**
     * `new ReturnAttempted()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReturnAttempted::with(attemptedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReturnAttempted)->withAttemptedAt(...)
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
    public static function with(string $attemptedAt): self
    {
        $self = new self;

        $self['attemptedAt'] = $attemptedAt;

        return $self;
    }

    /**
     * Attempted at.
     */
    public function withAttemptedAt(string $attemptedAt): self
    {
        $self = clone $this;
        $self['attemptedAt'] = $attemptedAt;

        return $self;
    }
}

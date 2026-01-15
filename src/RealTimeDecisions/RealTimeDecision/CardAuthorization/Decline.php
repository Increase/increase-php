<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\Decline\Reason;

/**
 * Present if and only if `decision` is `decline`. Contains information related to the reason the authorization was declined.
 *
 * @phpstan-type DeclineShape = array{reason: Reason|value-of<Reason>}
 */
final class Decline implements BaseModel
{
    /** @use SdkModel<DeclineShape> */
    use SdkModel;

    /**
     * The reason the authorization was declined.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new Decline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Decline::with(reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Decline)->withReason(...)
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
     *
     * @param Reason|value-of<Reason> $reason
     */
    public static function with(Reason|string $reason): self
    {
        $self = new self;

        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The reason the authorization was declined.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthentication\Decision;

/**
 * If the Real-Time Decision relates to a 3DS card authentication attempt, this object contains your response to the authentication.
 *
 * @phpstan-type CardAuthenticationShape = array{
 *   decision: Decision|value-of<Decision>
 * }
 */
final class CardAuthentication implements BaseModel
{
    /** @use SdkModel<CardAuthenticationShape> */
    use SdkModel;

    /**
     * Whether the card authentication attempt should be approved or declined.
     *
     * @var value-of<Decision> $decision
     */
    #[Required(enum: Decision::class)]
    public string $decision;

    /**
     * `new CardAuthentication()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthentication::with(decision: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthentication)->withDecision(...)
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
     * @param Decision|value-of<Decision> $decision
     */
    public static function with(Decision|string $decision): self
    {
        $self = new self;

        $self['decision'] = $decision;

        return $self;
    }

    /**
     * Whether the card authentication attempt should be approved or declined.
     *
     * @param Decision|value-of<Decision> $decision
     */
    public function withDecision(Decision|string $decision): self
    {
        $self = clone $this;
        $self['decision'] = $decision;

        return $self;
    }
}

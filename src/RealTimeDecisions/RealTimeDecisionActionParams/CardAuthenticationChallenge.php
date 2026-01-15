<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge\Result;

/**
 * If the Real-Time Decision relates to 3DS card authentication challenge delivery, this object contains your response.
 *
 * @phpstan-type CardAuthenticationChallengeShape = array{
 *   result: Result|value-of<Result>
 * }
 */
final class CardAuthenticationChallenge implements BaseModel
{
    /** @use SdkModel<CardAuthenticationChallengeShape> */
    use SdkModel;

    /**
     * Whether the card authentication challenge was successfully delivered to the cardholder.
     *
     * @var value-of<Result> $result
     */
    #[Required(enum: Result::class)]
    public string $result;

    /**
     * `new CardAuthenticationChallenge()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthenticationChallenge::with(result: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthenticationChallenge)->withResult(...)
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
     * @param Result|value-of<Result> $result
     */
    public static function with(Result|string $result): self
    {
        $self = new self;

        $self['result'] = $result;

        return $self;
    }

    /**
     * Whether the card authentication challenge was successfully delivered to the cardholder.
     *
     * @param Result|value-of<Result> $result
     */
    public function withResult(Result|string $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge\Result;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge\Success;

/**
 * If the Real-Time Decision relates to 3DS card authentication challenge delivery, this object contains your response.
 *
 * @phpstan-import-type SuccessShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge\Success
 *
 * @phpstan-type CardAuthenticationChallengeShape = array{
 *   result: Result|value-of<Result>, success?: null|Success|SuccessShape
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
     * If your application was able to deliver the one-time code, this contains metadata about the delivery.
     */
    #[Optional]
    public ?Success $success;

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
     * @param Success|SuccessShape|null $success
     */
    public static function with(
        Result|string $result,
        Success|array|null $success = null
    ): self {
        $self = new self;

        $self['result'] = $result;

        null !== $success && $self['success'] = $success;

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

    /**
     * If your application was able to deliver the one-time code, this contains metadata about the delivery.
     *
     * @param Success|SuccessShape $success
     */
    public function withSuccess(Success|array $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}

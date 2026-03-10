<?php

declare(strict_types=1);

namespace Increase\Simulations\CardTokens\CardTokenCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CardTokens\CardTokenCreateParams\Outcome\Decline;
use Increase\Simulations\CardTokens\CardTokenCreateParams\Outcome\Result;

/**
 * The outcome to simulate for card push transfers using this token.
 *
 * @phpstan-import-type DeclineShape from \Increase\Simulations\CardTokens\CardTokenCreateParams\Outcome\Decline
 *
 * @phpstan-type OutcomeShape = array{
 *   result: Result|value-of<Result>, decline?: null|Decline|DeclineShape
 * }
 */
final class Outcome implements BaseModel
{
    /** @use SdkModel<OutcomeShape> */
    use SdkModel;

    /**
     * Whether card push transfers or validations will be approved or declined.
     *
     * @var value-of<Result> $result
     */
    #[Required(enum: Result::class)]
    public string $result;

    /**
     * If the result is declined, the details of the decline.
     */
    #[Optional]
    public ?Decline $decline;

    /**
     * `new Outcome()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Outcome::with(result: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Outcome)->withResult(...)
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
     * @param Decline|DeclineShape|null $decline
     */
    public static function with(
        Result|string $result,
        Decline|array|null $decline = null
    ): self {
        $self = new self;

        $self['result'] = $result;

        null !== $decline && $self['decline'] = $decline;

        return $self;
    }

    /**
     * Whether card push transfers or validations will be approved or declined.
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
     * If the result is declined, the details of the decline.
     *
     * @param Decline|DeclineShape $decline
     */
    public function withDecline(Decline|array $decline): self
    {
        $self = clone $this;
        $self['decline'] = $decline;

        return $self;
    }
}

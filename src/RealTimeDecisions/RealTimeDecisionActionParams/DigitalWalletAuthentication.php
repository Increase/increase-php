<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletAuthentication\Result;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletAuthentication\Success;

/**
 * If the Real-Time Decision relates to a digital wallet authentication attempt, this object contains your response to the authentication.
 *
 * @phpstan-import-type SuccessShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletAuthentication\Success
 *
 * @phpstan-type DigitalWalletAuthenticationShape = array{
 *   result: Result|value-of<Result>, success?: null|Success|SuccessShape
 * }
 */
final class DigitalWalletAuthentication implements BaseModel
{
    /** @use SdkModel<DigitalWalletAuthenticationShape> */
    use SdkModel;

    /**
     * Whether your application was able to deliver the one-time passcode.
     *
     * @var value-of<Result> $result
     */
    #[Required(enum: Result::class)]
    public string $result;

    /**
     * If your application was able to deliver the one-time passcode, this contains metadata about the delivery. Exactly one of `phone` or `email` must be provided.
     */
    #[Optional]
    public ?Success $success;

    /**
     * `new DigitalWalletAuthentication()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalWalletAuthentication::with(result: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalWalletAuthentication)->withResult(...)
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
     * Whether your application was able to deliver the one-time passcode.
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
     * If your application was able to deliver the one-time passcode, this contains metadata about the delivery. Exactly one of `phone` or `email` must be provided.
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

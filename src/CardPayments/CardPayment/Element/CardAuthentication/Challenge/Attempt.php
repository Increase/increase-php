<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication\Challenge;

use Increase\CardPayments\CardPayment\Element\CardAuthentication\Challenge\Attempt\Outcome;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type AttemptShape = array{
 *   createdAt: \DateTimeInterface, outcome: Outcome|value-of<Outcome>
 * }
 */
final class Attempt implements BaseModel
{
    /** @use SdkModel<AttemptShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time of the Card Authentication Challenge Attempt.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The outcome of the Card Authentication Challenge Attempt.
     *
     * @var value-of<Outcome> $outcome
     */
    #[Required(enum: Outcome::class)]
    public string $outcome;

    /**
     * `new Attempt()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Attempt::with(createdAt: ..., outcome: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Attempt)->withCreatedAt(...)->withOutcome(...)
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
     * @param Outcome|value-of<Outcome> $outcome
     */
    public static function with(
        \DateTimeInterface $createdAt,
        Outcome|string $outcome
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['outcome'] = $outcome;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time of the Card Authentication Challenge Attempt.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The outcome of the Card Authentication Challenge Attempt.
     *
     * @param Outcome|value-of<Outcome> $outcome
     */
    public function withOutcome(Outcome|string $outcome): self
    {
        $self = clone $this;
        $self['outcome'] = $outcome;

        return $self;
    }
}

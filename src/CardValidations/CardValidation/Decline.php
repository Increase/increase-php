<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation;

use Increase\CardValidations\CardValidation\Decline\Reason;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the validation is rejected by the card network or the destination financial institution, this will contain supplemental details.
 *
 * @phpstan-type DeclineShape = array{
 *   declinedAt: \DateTimeInterface,
 *   networkTransactionIdentifier: string|null,
 *   reason: Reason|value-of<Reason>,
 * }
 */
final class Decline implements BaseModel
{
    /** @use SdkModel<DeclineShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the validation was declined.
     */
    #[Required('declined_at')]
    public \DateTimeInterface $declinedAt;

    /**
     * A unique identifier for the transaction on the card network.
     */
    #[Required('network_transaction_identifier')]
    public ?string $networkTransactionIdentifier;

    /**
     * The reason why the validation was declined.
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
     * Decline::with(declinedAt: ..., networkTransactionIdentifier: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Decline)
     *   ->withDeclinedAt(...)
     *   ->withNetworkTransactionIdentifier(...)
     *   ->withReason(...)
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
    public static function with(
        \DateTimeInterface $declinedAt,
        ?string $networkTransactionIdentifier,
        Reason|string $reason,
    ): self {
        $self = new self;

        $self['declinedAt'] = $declinedAt;
        $self['networkTransactionIdentifier'] = $networkTransactionIdentifier;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the validation was declined.
     */
    public function withDeclinedAt(\DateTimeInterface $declinedAt): self
    {
        $self = clone $this;
        $self['declinedAt'] = $declinedAt;

        return $self;
    }

    /**
     * A unique identifier for the transaction on the card network.
     */
    public function withNetworkTransactionIdentifier(
        ?string $networkTransactionIdentifier
    ): self {
        $self = clone $this;
        $self['networkTransactionIdentifier'] = $networkTransactionIdentifier;

        return $self;
    }

    /**
     * The reason why the validation was declined.
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

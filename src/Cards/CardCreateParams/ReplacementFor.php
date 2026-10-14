<?php

declare(strict_types=1);

namespace Increase\Cards\CardCreateParams;

use Increase\Cards\CardCreateParams\ReplacementFor\Reason;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details about the Card this Card replaces. Supply this when issuing a new Card to take over from an existing one. The replaced Card is not affected.
 *
 * @phpstan-type ReplacementForShape = array{
 *   cardID: string, reason: Reason|value-of<Reason>
 * }
 */
final class ReplacementFor implements BaseModel
{
    /** @use SdkModel<ReplacementForShape> */
    use SdkModel;

    /**
     * The identifier of the Card being replaced.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * Why the Card is being replaced. Only `expiring` notifies merchants that have the replaced Card on file of the new Card.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new ReplacementFor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReplacementFor::with(cardID: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReplacementFor)->withCardID(...)->withReason(...)
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
    public static function with(string $cardID, Reason|string $reason): self
    {
        $self = new self;

        $self['cardID'] = $cardID;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The identifier of the Card being replaced.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * Why the Card is being replaced. Only `expiring` notifies merchants that have the replaced Card on file of the new Card.
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

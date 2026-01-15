<?php

declare(strict_types=1);

namespace Increase\InboundFednowTransfers\InboundFednowTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundFednowTransfers\InboundFednowTransfer\Decline\Reason;

/**
 * If your transfer is declined, this will contain details of the decline.
 *
 * @phpstan-type DeclineShape = array{
 *   reason: Reason|value-of<Reason>, transferID: string
 * }
 */
final class Decline implements BaseModel
{
    /** @use SdkModel<DeclineShape> */
    use SdkModel;

    /**
     * Why the transfer was declined.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * The identifier of the FedNow Transfer that led to this declined transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new Decline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Decline::with(reason: ..., transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Decline)->withReason(...)->withTransferID(...)
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
    public static function with(Reason|string $reason, string $transferID): self
    {
        $self = new self;

        $self['reason'] = $reason;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * Why the transfer was declined.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The identifier of the FedNow Transfer that led to this declined transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

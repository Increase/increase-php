<?php

declare(strict_types=1);

namespace Increase\InboundWireTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundWireTransfers\InboundWireTransferReverseParams\Reason;

/**
 * Reverse an Inbound Wire Transfer.
 *
 * @see Increase\Services\InboundWireTransfersService::reverse()
 *
 * @phpstan-type InboundWireTransferReverseParamsShape = array{
 *   reason: Reason|value-of<Reason>, amount?: int|null
 * }
 */
final class InboundWireTransferReverseParams implements BaseModel
{
    /** @use SdkModel<InboundWireTransferReverseParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Reason for the reversal.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * The amount to return, in USD cents. Defaults to the full amount of the Inbound Wire Transfer. A transfer can only be reversed once, so any amount you don't return now stays with the recipient.
     */
    #[Optional]
    public ?int $amount;

    /**
     * `new InboundWireTransferReverseParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundWireTransferReverseParams::with(reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundWireTransferReverseParams)->withReason(...)
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
    public static function with(Reason|string $reason, ?int $amount = null): self
    {
        $self = new self;

        $self['reason'] = $reason;

        null !== $amount && $self['amount'] = $amount;

        return $self;
    }

    /**
     * Reason for the reversal.
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
     * The amount to return, in USD cents. Defaults to the full amount of the Inbound Wire Transfer. A transfer can only be reversed once, so any amount you don't return now stays with the recipient.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }
}

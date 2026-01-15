<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundACHTransfers\InboundACHTransferDeclineParams\Reason;

/**
 * Decline an Inbound ACH Transfer.
 *
 * @see Increase\Services\InboundACHTransfersService::decline()
 *
 * @phpstan-type InboundACHTransferDeclineParamsShape = array{
 *   reason?: null|Reason|value-of<Reason>
 * }
 */
final class InboundACHTransferDeclineParams implements BaseModel
{
    /** @use SdkModel<InboundACHTransferDeclineParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The reason why this transfer will be returned. If this parameter is unset, the return codes will be `payment_stopped` for debits and `credit_entry_refused_by_receiver` for credits.
     *
     * @var value-of<Reason>|null $reason
     */
    #[Optional(enum: Reason::class)]
    public ?string $reason;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Reason|value-of<Reason>|null $reason
     */
    public static function with(Reason|string|null $reason = null): self
    {
        $self = new self;

        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * The reason why this transfer will be returned. If this parameter is unset, the return codes will be `payment_stopped` for debits and `credit_entry_refused_by_receiver` for credits.
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

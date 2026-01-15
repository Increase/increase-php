<?php

declare(strict_types=1);

namespace Increase\Simulations\ACHTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\ACHTransfers\ACHTransferSettleParams\InboundFundsHoldBehavior;

/**
 * Simulates the settlement of an [ACH Transfer](#ach-transfers) by the Federal Reserve. This transfer must first have a `status` of `pending_submission` or `submitted`. For convenience, if the transfer is in `status`: `pending_submission`, the simulation will also submit the transfer. Without this simulation the transfer will eventually settle on its own following the same Federal Reserve timeline as in production. Additionally, you can specify the behavior of the inbound funds hold that is created when the ACH Transfer is settled. If no behavior is specified, the inbound funds hold will be released immediately in order for the funds to be available for use.
 *
 * @see Increase\Services\Simulations\ACHTransfersService::settle()
 *
 * @phpstan-type ACHTransferSettleParamsShape = array{
 *   inboundFundsHoldBehavior?: null|InboundFundsHoldBehavior|value-of<InboundFundsHoldBehavior>,
 * }
 */
final class ACHTransferSettleParams implements BaseModel
{
    /** @use SdkModel<ACHTransferSettleParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The behavior of the inbound funds hold that is created when the ACH Transfer is settled. If no behavior is specified, the inbound funds hold will be released immediately in order for the funds to be available for use.
     *
     * @var value-of<InboundFundsHoldBehavior>|null $inboundFundsHoldBehavior
     */
    #[Optional(
        'inbound_funds_hold_behavior',
        enum: InboundFundsHoldBehavior::class
    )]
    public ?string $inboundFundsHoldBehavior;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param InboundFundsHoldBehavior|value-of<InboundFundsHoldBehavior>|null $inboundFundsHoldBehavior
     */
    public static function with(
        InboundFundsHoldBehavior|string|null $inboundFundsHoldBehavior = null
    ): self {
        $self = new self;

        null !== $inboundFundsHoldBehavior && $self['inboundFundsHoldBehavior'] = $inboundFundsHoldBehavior;

        return $self;
    }

    /**
     * The behavior of the inbound funds hold that is created when the ACH Transfer is settled. If no behavior is specified, the inbound funds hold will be released immediately in order for the funds to be available for use.
     *
     * @param InboundFundsHoldBehavior|value-of<InboundFundsHoldBehavior> $inboundFundsHoldBehavior
     */
    public function withInboundFundsHoldBehavior(
        InboundFundsHoldBehavior|string $inboundFundsHoldBehavior
    ): self {
        $self = clone $this;
        $self['inboundFundsHoldBehavior'] = $inboundFundsHoldBehavior;

        return $self;
    }
}

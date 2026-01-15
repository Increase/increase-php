<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundACHTransfers\InboundACHTransferTransferReturnParams\Reason;

/**
 * Return an Inbound ACH Transfer.
 *
 * @see Increase\Services\InboundACHTransfersService::transferReturn()
 *
 * @phpstan-type InboundACHTransferTransferReturnParamsShape = array{
 *   reason: Reason|value-of<Reason>
 * }
 */
final class InboundACHTransferTransferReturnParams implements BaseModel
{
    /** @use SdkModel<InboundACHTransferTransferReturnParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The reason why this transfer will be returned. The most usual return codes are `payment_stopped` for debits and `credit_entry_refused_by_receiver` for credits.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new InboundACHTransferTransferReturnParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundACHTransferTransferReturnParams::with(reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundACHTransferTransferReturnParams)->withReason(...)
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
    public static function with(Reason|string $reason): self
    {
        $self = new self;

        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The reason why this transfer will be returned. The most usual return codes are `payment_stopped` for debits and `credit_entry_refused_by_receiver` for credits.
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

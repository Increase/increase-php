<?php

declare(strict_types=1);

namespace Increase\InboundCheckDeposits;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundCheckDeposits\InboundCheckDepositReturnParams\Reason;

/**
 * Return an Inbound Check Deposit.
 *
 * @see Increase\Services\InboundCheckDepositsService::return()
 *
 * @phpstan-type InboundCheckDepositReturnParamsShape = array{
 *   reason: Reason|value-of<Reason>
 * }
 */
final class InboundCheckDepositReturnParams implements BaseModel
{
    /** @use SdkModel<InboundCheckDepositReturnParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The reason to return the Inbound Check Deposit.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new InboundCheckDepositReturnParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundCheckDepositReturnParams::with(reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundCheckDepositReturnParams)->withReason(...)
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
     * The reason to return the Inbound Check Deposit.
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

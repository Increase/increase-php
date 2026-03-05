<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundCheckDeposits;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\InboundCheckDeposits\InboundCheckDepositAdjustmentParams\Reason;

/**
 * Simulates an adjustment on an Inbound Check Deposit. The Inbound Check Deposit must have a `status` of `accepted`.
 *
 * @see Increase\Services\Simulations\InboundCheckDepositsService::adjustment()
 *
 * @phpstan-type InboundCheckDepositAdjustmentParamsShape = array{
 *   amount?: int|null, reason?: null|Reason|value-of<Reason>
 * }
 */
final class InboundCheckDepositAdjustmentParams implements BaseModel
{
    /** @use SdkModel<InboundCheckDepositAdjustmentParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The adjustment amount in cents. Defaults to the amount of the Inbound Check Deposit.
     */
    #[Optional]
    public ?int $amount;

    /**
     * The reason for the adjustment. Defaults to `wrong_payee_credit`.
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
    public static function with(
        ?int $amount = null,
        Reason|string|null $reason = null
    ): self {
        $self = new self;

        null !== $amount && $self['amount'] = $amount;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * The adjustment amount in cents. Defaults to the amount of the Inbound Check Deposit.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The reason for the adjustment. Defaults to `wrong_payee_credit`.
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

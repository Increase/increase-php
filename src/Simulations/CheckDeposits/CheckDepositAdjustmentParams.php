<?php

declare(strict_types=1);

namespace Increase\Simulations\CheckDeposits;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CheckDeposits\CheckDepositAdjustmentParams\Reason;

/**
 * Simulates the creation of a [Check Deposit Adjustment](#check-deposit-adjustments) on a [Check Deposit](#check-deposits). This Check Deposit must first have a `status` of `submitted`.
 *
 * @see Increase\Services\Simulations\CheckDepositsService::adjustment()
 *
 * @phpstan-type CheckDepositAdjustmentParamsShape = array{
 *   amount?: int|null, reason?: null|Reason|value-of<Reason>
 * }
 */
final class CheckDepositAdjustmentParams implements BaseModel
{
    /** @use SdkModel<CheckDepositAdjustmentParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The adjustment amount in the minor unit of the Check Deposit's currency (e.g., cents). A negative amount means that the funds are being clawed back by the other bank and is a debit to your account. Defaults to the negative of the Check Deposit amount.
     */
    #[Optional]
    public ?int $amount;

    /**
     * The reason for the adjustment. Defaults to `non_conforming_item`, which is often used for a low quality image that the recipient wasn't able to handle.
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
     * The adjustment amount in the minor unit of the Check Deposit's currency (e.g., cents). A negative amount means that the funds are being clawed back by the other bank and is a debit to your account. Defaults to the negative of the Check Deposit amount.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The reason for the adjustment. Defaults to `non_conforming_item`, which is often used for a low quality image that the recipient wasn't able to handle.
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

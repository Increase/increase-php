<?php

declare(strict_types=1);

namespace Increase\CheckTransfers;

use Increase\CheckTransfers\CheckTransferStopPaymentParams\Reason;
use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Stop payment on a Check Transfer.
 *
 * @see Increase\Services\CheckTransfersService::stopPayment()
 *
 * @phpstan-type CheckTransferStopPaymentParamsShape = array{
 *   reason?: null|Reason|value-of<Reason>
 * }
 */
final class CheckTransferStopPaymentParams implements BaseModel
{
    /** @use SdkModel<CheckTransferStopPaymentParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The reason why this transfer should be stopped.
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
     * The reason why this transfer should be stopped.
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

<?php

declare(strict_types=1);

namespace Increase\InboundRealTimePaymentsTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Return an Inbound Real-Time Payments Transfer.
 *
 * @see Increase\Services\InboundRealTimePaymentsTransfersService::return()
 *
 * @phpstan-type InboundRealTimePaymentsTransferReturnParamsShape = array{
 *   amount?: int|null
 * }
 */
final class InboundRealTimePaymentsTransferReturnParams implements BaseModel
{
    /** @use SdkModel<InboundRealTimePaymentsTransferReturnParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The amount to return, in USD cents. Defaults to the full amount of the Inbound Real-Time Payments Transfer, and can't be higher than it.
     */
    #[Optional]
    public ?int $amount;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $amount = null): self
    {
        $self = new self;

        null !== $amount && $self['amount'] = $amount;

        return $self;
    }

    /**
     * The amount to return, in USD cents. Defaults to the full amount of the Inbound Real-Time Payments Transfer, and can't be higher than it.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }
}

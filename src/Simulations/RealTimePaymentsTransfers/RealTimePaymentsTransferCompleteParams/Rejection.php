<?php

declare(strict_types=1);

namespace Increase\Simulations\RealTimePaymentsTransfers\RealTimePaymentsTransferCompleteParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\RealTimePaymentsTransfers\RealTimePaymentsTransferCompleteParams\Rejection\RejectReasonCode;

/**
 * If set, the simulation will reject the transfer.
 *
 * @phpstan-type RejectionShape = array{
 *   rejectReasonCode: RejectReasonCode|value-of<RejectReasonCode>
 * }
 */
final class Rejection implements BaseModel
{
    /** @use SdkModel<RejectionShape> */
    use SdkModel;

    /**
     * The reason code that the simulated rejection will have.
     *
     * @var value-of<RejectReasonCode> $rejectReasonCode
     */
    #[Required('reject_reason_code', enum: RejectReasonCode::class)]
    public string $rejectReasonCode;

    /**
     * `new Rejection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Rejection::with(rejectReasonCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Rejection)->withRejectReasonCode(...)
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
     * @param RejectReasonCode|value-of<RejectReasonCode> $rejectReasonCode
     */
    public static function with(RejectReasonCode|string $rejectReasonCode): self
    {
        $self = new self;

        $self['rejectReasonCode'] = $rejectReasonCode;

        return $self;
    }

    /**
     * The reason code that the simulated rejection will have.
     *
     * @param RejectReasonCode|value-of<RejectReasonCode> $rejectReasonCode
     */
    public function withRejectReasonCode(
        RejectReasonCode|string $rejectReasonCode
    ): self {
        $self = clone $this;
        $self['rejectReasonCode'] = $rejectReasonCode;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Real-Time Payments Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `real_time_payments_transfer_instruction`.
 *
 * @phpstan-type RealTimePaymentsTransferInstructionShape = array{
 *   amount: int, transferID: string
 * }
 */
final class RealTimePaymentsTransferInstruction implements BaseModel
{
    /** @use SdkModel<RealTimePaymentsTransferInstructionShape> */
    use SdkModel;

    /**
     * The transfer amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the Real-Time Payments Transfer that led to this Pending Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new RealTimePaymentsTransferInstruction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RealTimePaymentsTransferInstruction::with(amount: ..., transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RealTimePaymentsTransferInstruction)->withAmount(...)->withTransferID(...)
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
     */
    public static function with(int $amount, string $transferID): self
    {
        $self = new self;

        $self['amount'] = $amount;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The transfer amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Real-Time Payments Transfer that led to this Pending Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

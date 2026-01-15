<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\InboundCheckAdjustment\Reason;

/**
 * An Inbound Check Adjustment object. This field will be present in the JSON response if and only if `category` is equal to `inbound_check_adjustment`. An Inbound Check Adjustment is created when Increase receives an adjustment for a check or return deposited through Check21.
 *
 * @phpstan-type InboundCheckAdjustmentShape = array{
 *   adjustedTransactionID: string, amount: int, reason: Reason|value-of<Reason>
 * }
 */
final class InboundCheckAdjustment implements BaseModel
{
    /** @use SdkModel<InboundCheckAdjustmentShape> */
    use SdkModel;

    /**
     * The ID of the transaction that was adjusted.
     */
    #[Required('adjusted_transaction_id')]
    public string $adjustedTransactionID;

    /**
     * The amount of the check adjustment.
     */
    #[Required]
    public int $amount;

    /**
     * The reason for the adjustment.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new InboundCheckAdjustment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundCheckAdjustment::with(
     *   adjustedTransactionID: ..., amount: ..., reason: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundCheckAdjustment)
     *   ->withAdjustedTransactionID(...)
     *   ->withAmount(...)
     *   ->withReason(...)
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
    public static function with(
        string $adjustedTransactionID,
        int $amount,
        Reason|string $reason
    ): self {
        $self = new self;

        $self['adjustedTransactionID'] = $adjustedTransactionID;
        $self['amount'] = $amount;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The ID of the transaction that was adjusted.
     */
    public function withAdjustedTransactionID(
        string $adjustedTransactionID
    ): self {
        $self = clone $this;
        $self['adjustedTransactionID'] = $adjustedTransactionID;

        return $self;
    }

    /**
     * The amount of the check adjustment.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The reason for the adjustment.
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

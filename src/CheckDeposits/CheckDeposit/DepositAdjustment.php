<?php

declare(strict_types=1);

namespace Increase\CheckDeposits\CheckDeposit;

use Increase\CheckDeposits\CheckDeposit\DepositAdjustment\Reason;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type DepositAdjustmentShape = array{
 *   adjustedAt: \DateTimeInterface,
 *   amount: int,
 *   reason: Reason|value-of<Reason>,
 *   transactionID: string,
 * }
 */
final class DepositAdjustment implements BaseModel
{
    /** @use SdkModel<DepositAdjustmentShape> */
    use SdkModel;

    /**
     * The time at which the adjustment was received.
     */
    #[Required('adjusted_at')]
    public \DateTimeInterface $adjustedAt;

    /**
     * The amount of the adjustment.
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
     * The id of the transaction for the adjustment.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * `new DepositAdjustment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DepositAdjustment::with(
     *   adjustedAt: ..., amount: ..., reason: ..., transactionID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DepositAdjustment)
     *   ->withAdjustedAt(...)
     *   ->withAmount(...)
     *   ->withReason(...)
     *   ->withTransactionID(...)
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
        \DateTimeInterface $adjustedAt,
        int $amount,
        Reason|string $reason,
        string $transactionID,
    ): self {
        $self = new self;

        $self['adjustedAt'] = $adjustedAt;
        $self['amount'] = $amount;
        $self['reason'] = $reason;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * The time at which the adjustment was received.
     */
    public function withAdjustedAt(\DateTimeInterface $adjustedAt): self
    {
        $self = clone $this;
        $self['adjustedAt'] = $adjustedAt;

        return $self;
    }

    /**
     * The amount of the adjustment.
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

    /**
     * The id of the transaction for the adjustment.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}

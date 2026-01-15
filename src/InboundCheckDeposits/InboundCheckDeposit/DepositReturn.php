<?php

declare(strict_types=1);

namespace Increase\InboundCheckDeposits\InboundCheckDeposit;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundCheckDeposits\InboundCheckDeposit\DepositReturn\Reason;

/**
 * If you requested a return of this deposit, this will contain details of the return.
 *
 * @phpstan-type DepositReturnShape = array{
 *   reason: Reason|value-of<Reason>,
 *   returnedAt: \DateTimeInterface,
 *   transactionID: string,
 * }
 */
final class DepositReturn implements BaseModel
{
    /** @use SdkModel<DepositReturnShape> */
    use SdkModel;

    /**
     * The reason the deposit was returned.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * The time at which the deposit was returned.
     */
    #[Required('returned_at')]
    public \DateTimeInterface $returnedAt;

    /**
     * The id of the transaction for the returned deposit.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * `new DepositReturn()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DepositReturn::with(reason: ..., returnedAt: ..., transactionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DepositReturn)
     *   ->withReason(...)
     *   ->withReturnedAt(...)
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
        Reason|string $reason,
        \DateTimeInterface $returnedAt,
        string $transactionID
    ): self {
        $self = new self;

        $self['reason'] = $reason;
        $self['returnedAt'] = $returnedAt;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * The reason the deposit was returned.
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
     * The time at which the deposit was returned.
     */
    public function withReturnedAt(\DateTimeInterface $returnedAt): self
    {
        $self = clone $this;
        $self['returnedAt'] = $returnedAt;

        return $self;
    }

    /**
     * The id of the transaction for the returned deposit.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}

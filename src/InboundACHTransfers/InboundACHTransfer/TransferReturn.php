<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundACHTransfers\InboundACHTransfer\TransferReturn\Reason;

/**
 * If your transfer is returned, this will contain details of the return.
 *
 * @phpstan-type TransferReturnShape = array{
 *   reason: Reason|value-of<Reason>,
 *   returnedAt: \DateTimeInterface,
 *   transactionID: string,
 * }
 */
final class TransferReturn implements BaseModel
{
    /** @use SdkModel<TransferReturnShape> */
    use SdkModel;

    /**
     * The reason for the transfer return.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * The time at which the transfer was returned.
     */
    #[Required('returned_at')]
    public \DateTimeInterface $returnedAt;

    /**
     * The id of the transaction for the returned transfer.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * `new TransferReturn()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransferReturn::with(reason: ..., returnedAt: ..., transactionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransferReturn)
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
     * The reason for the transfer return.
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
     * The time at which the transfer was returned.
     */
    public function withReturnedAt(\DateTimeInterface $returnedAt): self
    {
        $self = clone $this;
        $self['returnedAt'] = $returnedAt;

        return $self;
    }

    /**
     * The id of the transaction for the returned transfer.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}

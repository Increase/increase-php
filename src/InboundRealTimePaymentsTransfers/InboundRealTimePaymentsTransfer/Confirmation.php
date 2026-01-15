<?php

declare(strict_types=1);

namespace Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your transfer is confirmed, this will contain details of the confirmation.
 *
 * @phpstan-type ConfirmationShape = array{
 *   confirmedAt: \DateTimeInterface, transactionID: string
 * }
 */
final class Confirmation implements BaseModel
{
    /** @use SdkModel<ConfirmationShape> */
    use SdkModel;

    /**
     * The time at which the transfer was confirmed.
     */
    #[Required('confirmed_at')]
    public \DateTimeInterface $confirmedAt;

    /**
     * The id of the transaction for the confirmed transfer.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * `new Confirmation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Confirmation::with(confirmedAt: ..., transactionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Confirmation)->withConfirmedAt(...)->withTransactionID(...)
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
    public static function with(
        \DateTimeInterface $confirmedAt,
        string $transactionID
    ): self {
        $self = new self;

        $self['confirmedAt'] = $confirmedAt;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * The time at which the transfer was confirmed.
     */
    public function withConfirmedAt(\DateTimeInterface $confirmedAt): self
    {
        $self = clone $this;
        $self['confirmedAt'] = $confirmedAt;

        return $self;
    }

    /**
     * The id of the transaction for the confirmed transfer.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}

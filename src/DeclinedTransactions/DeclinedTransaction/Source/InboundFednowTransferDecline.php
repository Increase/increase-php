<?php

declare(strict_types=1);

namespace Increase\DeclinedTransactions\DeclinedTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DeclinedTransactions\DeclinedTransaction\Source\InboundFednowTransferDecline\Reason;

/**
 * An Inbound FedNow Transfer Decline object. This field will be present in the JSON response if and only if `category` is equal to `inbound_fednow_transfer_decline`.
 *
 * @phpstan-type InboundFednowTransferDeclineShape = array{
 *   reason: Reason|value-of<Reason>, transferID: string
 * }
 */
final class InboundFednowTransferDecline implements BaseModel
{
    /** @use SdkModel<InboundFednowTransferDeclineShape> */
    use SdkModel;

    /**
     * Why the transfer was declined.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * The identifier of the FedNow Transfer that led to this declined transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new InboundFednowTransferDecline()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundFednowTransferDecline::with(reason: ..., transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundFednowTransferDecline)->withReason(...)->withTransferID(...)
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
    public static function with(Reason|string $reason, string $transferID): self
    {
        $self = new self;

        $self['reason'] = $reason;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * Why the transfer was declined.
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
     * The identifier of the FedNow Transfer that led to this declined transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

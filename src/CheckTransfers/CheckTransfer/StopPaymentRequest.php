<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer;

use Increase\CheckTransfers\CheckTransfer\StopPaymentRequest\Reason;
use Increase\CheckTransfers\CheckTransfer\StopPaymentRequest\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * After a stop-payment is requested on the check, this will contain supplemental details.
 *
 * @phpstan-type StopPaymentRequestShape = array{
 *   reason: Reason|value-of<Reason>,
 *   requestedAt: \DateTimeInterface,
 *   transferID: string,
 *   type: \Increase\CheckTransfers\CheckTransfer\StopPaymentRequest\Type|value-of<\Increase\CheckTransfers\CheckTransfer\StopPaymentRequest\Type>,
 * }
 */
final class StopPaymentRequest implements BaseModel
{
    /** @use SdkModel<StopPaymentRequestShape> */
    use SdkModel;

    /**
     * The reason why this transfer was stopped.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * The time the stop-payment was requested.
     */
    #[Required('requested_at')]
    public \DateTimeInterface $requestedAt;

    /**
     * The ID of the check transfer that was stopped.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * A constant representing the object's type. For this resource it will always be `check_transfer_stop_payment_request`.
     *
     * @var value-of<Type> $type
     */
    #[Required(
        enum: Type::class
    )]
    public string $type;

    /**
     * `new StopPaymentRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StopPaymentRequest::with(
     *   reason: ..., requestedAt: ..., transferID: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StopPaymentRequest)
     *   ->withReason(...)
     *   ->withRequestedAt(...)
     *   ->withTransferID(...)
     *   ->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        Reason|string $reason,
        \DateTimeInterface $requestedAt,
        string $transferID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['reason'] = $reason;
        $self['requestedAt'] = $requestedAt;
        $self['transferID'] = $transferID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The reason why this transfer was stopped.
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
     * The time the stop-payment was requested.
     */
    public function withRequestedAt(\DateTimeInterface $requestedAt): self
    {
        $self = clone $this;
        $self['requestedAt'] = $requestedAt;

        return $self;
    }

    /**
     * The ID of the check transfer that was stopped.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `check_transfer_stop_payment_request`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(
        Type|string $type
    ): self {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}

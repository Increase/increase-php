<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If your transfer is accepted, this will contain details of the acceptance.
 *
 * @phpstan-type AcceptanceShape = array{
 *   acceptedAt: \DateTimeInterface, transactionID: string
 * }
 */
final class Acceptance implements BaseModel
{
    /** @use SdkModel<AcceptanceShape> */
    use SdkModel;

    /**
     * The time at which the transfer was accepted.
     */
    #[Required('accepted_at')]
    public \DateTimeInterface $acceptedAt;

    /**
     * The id of the transaction for the accepted transfer.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * `new Acceptance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Acceptance::with(acceptedAt: ..., transactionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Acceptance)->withAcceptedAt(...)->withTransactionID(...)
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
        \DateTimeInterface $acceptedAt,
        string $transactionID
    ): self {
        $self = new self;

        $self['acceptedAt'] = $acceptedAt;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * The time at which the transfer was accepted.
     */
    public function withAcceptedAt(\DateTimeInterface $acceptedAt): self
    {
        $self = clone $this;
        $self['acceptedAt'] = $acceptedAt;

        return $self;
    }

    /**
     * The id of the transaction for the accepted transfer.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Legacy Card Dispute Acceptance object. This field will be present in the JSON response if and only if `category` is equal to `card_dispute_acceptance`. Contains the details of a successful Card Dispute.
 *
 * @phpstan-type CardDisputeAcceptanceShape = array{
 *   acceptedAt: \DateTimeInterface, transactionID: string
 * }
 */
final class CardDisputeAcceptance implements BaseModel
{
    /** @use SdkModel<CardDisputeAcceptanceShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was accepted.
     */
    #[Required('accepted_at')]
    public \DateTimeInterface $acceptedAt;

    /**
     * The identifier of the Transaction that was created to return the disputed funds to your account.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * `new CardDisputeAcceptance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardDisputeAcceptance::with(acceptedAt: ..., transactionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardDisputeAcceptance)->withAcceptedAt(...)->withTransactionID(...)
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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was accepted.
     */
    public function withAcceptedAt(\DateTimeInterface $acceptedAt): self
    {
        $self = clone $this;
        $self['acceptedAt'] = $acceptedAt;

        return $self;
    }

    /**
     * The identifier of the Transaction that was created to return the disputed funds to your account.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}

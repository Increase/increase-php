<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Legacy Card Dispute Loss object. This field will be present in the JSON response if and only if `category` is equal to `card_dispute_loss`. Contains the details of a lost Card Dispute.
 *
 * @phpstan-type CardDisputeLossShape = array{
 *   explanation: string, lostAt: \DateTimeInterface, transactionID: string
 * }
 */
final class CardDisputeLoss implements BaseModel
{
    /** @use SdkModel<CardDisputeLossShape> */
    use SdkModel;

    /**
     * Why the Card Dispute was lost.
     */
    #[Required]
    public string $explanation;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was lost.
     */
    #[Required('lost_at')]
    public \DateTimeInterface $lostAt;

    /**
     * The identifier of the Transaction that was created to debit the disputed funds from your account.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * `new CardDisputeLoss()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardDisputeLoss::with(explanation: ..., lostAt: ..., transactionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardDisputeLoss)
     *   ->withExplanation(...)
     *   ->withLostAt(...)
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
     */
    public static function with(
        string $explanation,
        \DateTimeInterface $lostAt,
        string $transactionID
    ): self {
        $self = new self;

        $self['explanation'] = $explanation;
        $self['lostAt'] = $lostAt;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * Why the Card Dispute was lost.
     */
    public function withExplanation(string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Card Dispute was lost.
     */
    public function withLostAt(\DateTimeInterface $lostAt): self
    {
        $self = clone $this;
        $self['lostAt'] = $lostAt;

        return $self;
    }

    /**
     * The identifier of the Transaction that was created to debit the disputed funds from your account.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}

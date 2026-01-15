<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa;

use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerOriginalCreditTransactionNotAccepted\Reason;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Original Credit Transaction (OCT) not accepted. Required if and only if `category` is `consumer_original_credit_transaction_not_accepted`.
 *
 * @phpstan-type ConsumerOriginalCreditTransactionNotAcceptedShape = array{
 *   explanation: string, reason: Reason|value-of<Reason>
 * }
 */
final class ConsumerOriginalCreditTransactionNotAccepted implements BaseModel
{
    /** @use SdkModel<ConsumerOriginalCreditTransactionNotAcceptedShape> */
    use SdkModel;

    /**
     * Explanation.
     */
    #[Required]
    public string $explanation;

    /**
     * Reason.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new ConsumerOriginalCreditTransactionNotAccepted()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerOriginalCreditTransactionNotAccepted::with(
     *   explanation: ..., reason: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerOriginalCreditTransactionNotAccepted)
     *   ->withExplanation(...)
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
        string $explanation,
        Reason|string $reason
    ): self {
        $self = new self;

        $self['explanation'] = $explanation;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Explanation.
     */
    public function withExplanation(string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * Reason.
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

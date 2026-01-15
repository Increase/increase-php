<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived;

use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\Delayed\NotReturned;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\Delayed\ReturnAttempted;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\Delayed\Returned;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\Delayed\ReturnOutcome;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Delayed. Required if and only if `delivery_issue` is `delayed`.
 *
 * @phpstan-import-type NotReturnedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\Delayed\NotReturned
 * @phpstan-import-type ReturnAttemptedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\Delayed\ReturnAttempted
 * @phpstan-import-type ReturnedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\Delayed\Returned
 *
 * @phpstan-type DelayedShape = array{
 *   explanation: string,
 *   returnOutcome: ReturnOutcome|value-of<ReturnOutcome>,
 *   notReturned?: null|NotReturned|NotReturnedShape,
 *   returnAttempted?: null|ReturnAttempted|ReturnAttemptedShape,
 *   returned?: null|Returned|ReturnedShape,
 * }
 */
final class Delayed implements BaseModel
{
    /** @use SdkModel<DelayedShape> */
    use SdkModel;

    /**
     * Explanation.
     */
    #[Required]
    public string $explanation;

    /**
     * Return outcome.
     *
     * @var value-of<ReturnOutcome> $returnOutcome
     */
    #[Required('return_outcome', enum: ReturnOutcome::class)]
    public string $returnOutcome;

    /**
     * Not returned. Required if and only if `return_outcome` is `not_returned`.
     */
    #[Optional('not_returned')]
    public ?NotReturned $notReturned;

    /**
     * Return attempted. Required if and only if `return_outcome` is `return_attempted`.
     */
    #[Optional('return_attempted')]
    public ?ReturnAttempted $returnAttempted;

    /**
     * Returned. Required if and only if `return_outcome` is `returned`.
     */
    #[Optional]
    public ?Returned $returned;

    /**
     * `new Delayed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Delayed::with(explanation: ..., returnOutcome: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Delayed)->withExplanation(...)->withReturnOutcome(...)
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
     * @param ReturnOutcome|value-of<ReturnOutcome> $returnOutcome
     * @param NotReturned|NotReturnedShape|null $notReturned
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     * @param Returned|ReturnedShape|null $returned
     */
    public static function with(
        string $explanation,
        ReturnOutcome|string $returnOutcome,
        NotReturned|array|null $notReturned = null,
        ReturnAttempted|array|null $returnAttempted = null,
        Returned|array|null $returned = null,
    ): self {
        $self = new self;

        $self['explanation'] = $explanation;
        $self['returnOutcome'] = $returnOutcome;

        null !== $notReturned && $self['notReturned'] = $notReturned;
        null !== $returnAttempted && $self['returnAttempted'] = $returnAttempted;
        null !== $returned && $self['returned'] = $returned;

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
     * Return outcome.
     *
     * @param ReturnOutcome|value-of<ReturnOutcome> $returnOutcome
     */
    public function withReturnOutcome(ReturnOutcome|string $returnOutcome): self
    {
        $self = clone $this;
        $self['returnOutcome'] = $returnOutcome;

        return $self;
    }

    /**
     * Not returned. Required if and only if `return_outcome` is `not_returned`.
     *
     * @param NotReturned|NotReturnedShape $notReturned
     */
    public function withNotReturned(NotReturned|array $notReturned): self
    {
        $self = clone $this;
        $self['notReturned'] = $notReturned;

        return $self;
    }

    /**
     * Return attempted. Required if and only if `return_outcome` is `return_attempted`.
     *
     * @param ReturnAttempted|ReturnAttemptedShape $returnAttempted
     */
    public function withReturnAttempted(
        ReturnAttempted|array $returnAttempted
    ): self {
        $self = clone $this;
        $self['returnAttempted'] = $returnAttempted;

        return $self;
    }

    /**
     * Returned. Required if and only if `return_outcome` is `returned`.
     *
     * @param Returned|ReturnedShape $returned
     */
    public function withReturned(Returned|array $returned): self
    {
        $self = clone $this;
        $self['returned'] = $returned;

        return $self;
    }
}

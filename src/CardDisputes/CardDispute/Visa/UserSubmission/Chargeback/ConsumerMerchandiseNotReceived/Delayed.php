<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\Delayed\NotReturned;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\Delayed\ReturnAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\Delayed\Returned;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\Delayed\ReturnOutcome;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Delayed. Present if and only if `delivery_issue` is `delayed`.
 *
 * @phpstan-import-type NotReturnedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\Delayed\NotReturned
 * @phpstan-import-type ReturnAttemptedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\Delayed\ReturnAttempted
 * @phpstan-import-type ReturnedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\Delayed\Returned
 *
 * @phpstan-type DelayedShape = array{
 *   explanation: string,
 *   notReturned: null|NotReturned|NotReturnedShape,
 *   returnAttempted: null|ReturnAttempted|ReturnAttemptedShape,
 *   returnOutcome: ReturnOutcome|value-of<ReturnOutcome>,
 *   returned: null|Returned|ReturnedShape,
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
     * Not returned. Present if and only if `return_outcome` is `not_returned`.
     */
    #[Required('not_returned')]
    public ?NotReturned $notReturned;

    /**
     * Return attempted. Present if and only if `return_outcome` is `return_attempted`.
     */
    #[Required('return_attempted')]
    public ?ReturnAttempted $returnAttempted;

    /**
     * Return outcome.
     *
     * @var value-of<ReturnOutcome> $returnOutcome
     */
    #[Required('return_outcome', enum: ReturnOutcome::class)]
    public string $returnOutcome;

    /**
     * Returned. Present if and only if `return_outcome` is `returned`.
     */
    #[Required]
    public ?Returned $returned;

    /**
     * `new Delayed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Delayed::with(
     *   explanation: ...,
     *   notReturned: ...,
     *   returnAttempted: ...,
     *   returnOutcome: ...,
     *   returned: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Delayed)
     *   ->withExplanation(...)
     *   ->withNotReturned(...)
     *   ->withReturnAttempted(...)
     *   ->withReturnOutcome(...)
     *   ->withReturned(...)
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
     * @param NotReturned|NotReturnedShape|null $notReturned
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     * @param ReturnOutcome|value-of<ReturnOutcome> $returnOutcome
     * @param Returned|ReturnedShape|null $returned
     */
    public static function with(
        string $explanation,
        NotReturned|array|null $notReturned,
        ReturnAttempted|array|null $returnAttempted,
        ReturnOutcome|string $returnOutcome,
        Returned|array|null $returned,
    ): self {
        $self = new self;

        $self['explanation'] = $explanation;
        $self['notReturned'] = $notReturned;
        $self['returnAttempted'] = $returnAttempted;
        $self['returnOutcome'] = $returnOutcome;
        $self['returned'] = $returned;

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
     * Not returned. Present if and only if `return_outcome` is `not_returned`.
     *
     * @param NotReturned|NotReturnedShape|null $notReturned
     */
    public function withNotReturned(NotReturned|array|null $notReturned): self
    {
        $self = clone $this;
        $self['notReturned'] = $notReturned;

        return $self;
    }

    /**
     * Return attempted. Present if and only if `return_outcome` is `return_attempted`.
     *
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     */
    public function withReturnAttempted(
        ReturnAttempted|array|null $returnAttempted
    ): self {
        $self = clone $this;
        $self['returnAttempted'] = $returnAttempted;

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
     * Returned. Present if and only if `return_outcome` is `returned`.
     *
     * @param Returned|ReturnedShape|null $returned
     */
    public function withReturned(Returned|array|null $returned): self
    {
        $self = clone $this;
        $self['returned'] = $returned;

        return $self;
    }
}

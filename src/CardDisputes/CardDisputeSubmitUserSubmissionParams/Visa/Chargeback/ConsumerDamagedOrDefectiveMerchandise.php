<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback;

use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerDamagedOrDefectiveMerchandise\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerDamagedOrDefectiveMerchandise\NotReturned;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerDamagedOrDefectiveMerchandise\ReturnAttempted;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerDamagedOrDefectiveMerchandise\Returned;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerDamagedOrDefectiveMerchandise\ReturnOutcome;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Damaged or defective merchandise. Required if and only if `category` is `consumer_damaged_or_defective_merchandise`.
 *
 * @phpstan-import-type NotReturnedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerDamagedOrDefectiveMerchandise\NotReturned
 * @phpstan-import-type ReturnAttemptedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerDamagedOrDefectiveMerchandise\ReturnAttempted
 * @phpstan-import-type ReturnedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerDamagedOrDefectiveMerchandise\Returned
 *
 * @phpstan-type ConsumerDamagedOrDefectiveMerchandiseShape = array{
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   orderAndIssueExplanation: string,
 *   receivedAt: string,
 *   returnOutcome: ReturnOutcome|value-of<ReturnOutcome>,
 *   notReturned?: null|NotReturned|NotReturnedShape,
 *   returnAttempted?: null|ReturnAttempted|ReturnAttemptedShape,
 *   returned?: null|Returned|ReturnedShape,
 * }
 */
final class ConsumerDamagedOrDefectiveMerchandise implements BaseModel
{
    /** @use SdkModel<ConsumerDamagedOrDefectiveMerchandiseShape> */
    use SdkModel;

    /**
     * Merchant resolution attempted.
     *
     * @var value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     */
    #[Required(
        'merchant_resolution_attempted',
        enum: MerchantResolutionAttempted::class
    )]
    public string $merchantResolutionAttempted;

    /**
     * Order and issue explanation.
     */
    #[Required('order_and_issue_explanation')]
    public string $orderAndIssueExplanation;

    /**
     * Received at.
     */
    #[Required('received_at')]
    public string $receivedAt;

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
     * `new ConsumerDamagedOrDefectiveMerchandise()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerDamagedOrDefectiveMerchandise::with(
     *   merchantResolutionAttempted: ...,
     *   orderAndIssueExplanation: ...,
     *   receivedAt: ...,
     *   returnOutcome: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerDamagedOrDefectiveMerchandise)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withOrderAndIssueExplanation(...)
     *   ->withReceivedAt(...)
     *   ->withReturnOutcome(...)
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
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     * @param ReturnOutcome|value-of<ReturnOutcome> $returnOutcome
     * @param NotReturned|NotReturnedShape|null $notReturned
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     * @param Returned|ReturnedShape|null $returned
     */
    public static function with(
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        string $orderAndIssueExplanation,
        string $receivedAt,
        ReturnOutcome|string $returnOutcome,
        NotReturned|array|null $notReturned = null,
        ReturnAttempted|array|null $returnAttempted = null,
        Returned|array|null $returned = null,
    ): self {
        $self = new self;

        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['orderAndIssueExplanation'] = $orderAndIssueExplanation;
        $self['receivedAt'] = $receivedAt;
        $self['returnOutcome'] = $returnOutcome;

        null !== $notReturned && $self['notReturned'] = $notReturned;
        null !== $returnAttempted && $self['returnAttempted'] = $returnAttempted;
        null !== $returned && $self['returned'] = $returned;

        return $self;
    }

    /**
     * Merchant resolution attempted.
     *
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     */
    public function withMerchantResolutionAttempted(
        MerchantResolutionAttempted|string $merchantResolutionAttempted
    ): self {
        $self = clone $this;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;

        return $self;
    }

    /**
     * Order and issue explanation.
     */
    public function withOrderAndIssueExplanation(
        string $orderAndIssueExplanation
    ): self {
        $self = clone $this;
        $self['orderAndIssueExplanation'] = $orderAndIssueExplanation;

        return $self;
    }

    /**
     * Received at.
     */
    public function withReceivedAt(string $receivedAt): self
    {
        $self = clone $this;
        $self['receivedAt'] = $receivedAt;

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

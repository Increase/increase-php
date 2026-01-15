<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback;

use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotAsDescribed\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotAsDescribed\ReturnAttempted;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotAsDescribed\Returned;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotAsDescribed\ReturnOutcome;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Merchandise not as described. Required if and only if `category` is `consumer_merchandise_not_as_described`.
 *
 * @phpstan-import-type ReturnAttemptedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotAsDescribed\ReturnAttempted
 * @phpstan-import-type ReturnedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotAsDescribed\Returned
 *
 * @phpstan-type ConsumerMerchandiseNotAsDescribedShape = array{
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   receivedAt: string,
 *   returnOutcome: ReturnOutcome|value-of<ReturnOutcome>,
 *   returnAttempted?: null|ReturnAttempted|ReturnAttemptedShape,
 *   returned?: null|Returned|ReturnedShape,
 * }
 */
final class ConsumerMerchandiseNotAsDescribed implements BaseModel
{
    /** @use SdkModel<ConsumerMerchandiseNotAsDescribedShape> */
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
     * `new ConsumerMerchandiseNotAsDescribed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerMerchandiseNotAsDescribed::with(
     *   merchantResolutionAttempted: ..., receivedAt: ..., returnOutcome: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerMerchandiseNotAsDescribed)
     *   ->withMerchantResolutionAttempted(...)
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
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     * @param Returned|ReturnedShape|null $returned
     */
    public static function with(
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        string $receivedAt,
        ReturnOutcome|string $returnOutcome,
        ReturnAttempted|array|null $returnAttempted = null,
        Returned|array|null $returned = null,
    ): self {
        $self = new self;

        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['receivedAt'] = $receivedAt;
        $self['returnOutcome'] = $returnOutcome;

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

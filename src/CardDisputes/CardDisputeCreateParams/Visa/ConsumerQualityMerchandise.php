<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa;

use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise\NotReturned;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise\OngoingNegotiations;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise\ReturnAttempted;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise\Returned;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise\ReturnOutcome;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Merchandise quality issue. Required if and only if `category` is `consumer_quality_merchandise`.
 *
 * @phpstan-import-type NotReturnedShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise\NotReturned
 * @phpstan-import-type OngoingNegotiationsShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise\OngoingNegotiations
 * @phpstan-import-type ReturnAttemptedShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise\ReturnAttempted
 * @phpstan-import-type ReturnedShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise\Returned
 *
 * @phpstan-type ConsumerQualityMerchandiseShape = array{
 *   expectedAt: string,
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   purchaseInfoAndQualityIssue: string,
 *   receivedAt: string,
 *   returnOutcome: ReturnOutcome|value-of<ReturnOutcome>,
 *   notReturned?: null|NotReturned|NotReturnedShape,
 *   ongoingNegotiations?: null|OngoingNegotiations|OngoingNegotiationsShape,
 *   returnAttempted?: null|ReturnAttempted|ReturnAttemptedShape,
 *   returned?: null|Returned|ReturnedShape,
 * }
 */
final class ConsumerQualityMerchandise implements BaseModel
{
    /** @use SdkModel<ConsumerQualityMerchandiseShape> */
    use SdkModel;

    /**
     * Expected at.
     */
    #[Required('expected_at')]
    public string $expectedAt;

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
     * Purchase information and quality issue.
     */
    #[Required('purchase_info_and_quality_issue')]
    public string $purchaseInfoAndQualityIssue;

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
     * Ongoing negotiations. Exclude if there is no evidence of ongoing negotiations.
     */
    #[Optional('ongoing_negotiations')]
    public ?OngoingNegotiations $ongoingNegotiations;

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
     * `new ConsumerQualityMerchandise()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerQualityMerchandise::with(
     *   expectedAt: ...,
     *   merchantResolutionAttempted: ...,
     *   purchaseInfoAndQualityIssue: ...,
     *   receivedAt: ...,
     *   returnOutcome: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerQualityMerchandise)
     *   ->withExpectedAt(...)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withPurchaseInfoAndQualityIssue(...)
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
     * @param OngoingNegotiations|OngoingNegotiationsShape|null $ongoingNegotiations
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     * @param Returned|ReturnedShape|null $returned
     */
    public static function with(
        string $expectedAt,
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        string $purchaseInfoAndQualityIssue,
        string $receivedAt,
        ReturnOutcome|string $returnOutcome,
        NotReturned|array|null $notReturned = null,
        OngoingNegotiations|array|null $ongoingNegotiations = null,
        ReturnAttempted|array|null $returnAttempted = null,
        Returned|array|null $returned = null,
    ): self {
        $self = new self;

        $self['expectedAt'] = $expectedAt;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['purchaseInfoAndQualityIssue'] = $purchaseInfoAndQualityIssue;
        $self['receivedAt'] = $receivedAt;
        $self['returnOutcome'] = $returnOutcome;

        null !== $notReturned && $self['notReturned'] = $notReturned;
        null !== $ongoingNegotiations && $self['ongoingNegotiations'] = $ongoingNegotiations;
        null !== $returnAttempted && $self['returnAttempted'] = $returnAttempted;
        null !== $returned && $self['returned'] = $returned;

        return $self;
    }

    /**
     * Expected at.
     */
    public function withExpectedAt(string $expectedAt): self
    {
        $self = clone $this;
        $self['expectedAt'] = $expectedAt;

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
     * Purchase information and quality issue.
     */
    public function withPurchaseInfoAndQualityIssue(
        string $purchaseInfoAndQualityIssue
    ): self {
        $self = clone $this;
        $self['purchaseInfoAndQualityIssue'] = $purchaseInfoAndQualityIssue;

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
     * Ongoing negotiations. Exclude if there is no evidence of ongoing negotiations.
     *
     * @param OngoingNegotiations|OngoingNegotiationsShape $ongoingNegotiations
     */
    public function withOngoingNegotiations(
        OngoingNegotiations|array $ongoingNegotiations
    ): self {
        $self = clone $this;
        $self['ongoingNegotiations'] = $ongoingNegotiations;

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

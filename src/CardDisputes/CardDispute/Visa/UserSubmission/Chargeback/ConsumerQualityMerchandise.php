<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise\NotReturned;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise\OngoingNegotiations;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise\ReturnAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise\Returned;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise\ReturnOutcome;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Merchandise quality issue. Present if and only if `category` is `consumer_quality_merchandise`.
 *
 * @phpstan-import-type NotReturnedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise\NotReturned
 * @phpstan-import-type OngoingNegotiationsShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise\OngoingNegotiations
 * @phpstan-import-type ReturnAttemptedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise\ReturnAttempted
 * @phpstan-import-type ReturnedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise\Returned
 *
 * @phpstan-type ConsumerQualityMerchandiseShape = array{
 *   expectedAt: string,
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   notReturned: null|NotReturned|NotReturnedShape,
 *   ongoingNegotiations: null|OngoingNegotiations|OngoingNegotiationsShape,
 *   purchaseInfoAndQualityIssue: string,
 *   receivedAt: string,
 *   returnAttempted: null|ReturnAttempted|ReturnAttemptedShape,
 *   returnOutcome: ReturnOutcome|value-of<ReturnOutcome>,
 *   returned: null|Returned|ReturnedShape,
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
     * Not returned. Present if and only if `return_outcome` is `not_returned`.
     */
    #[Required('not_returned')]
    public ?NotReturned $notReturned;

    /**
     * Ongoing negotiations. Exclude if there is no evidence of ongoing negotiations.
     */
    #[Required('ongoing_negotiations')]
    public ?OngoingNegotiations $ongoingNegotiations;

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
     * `new ConsumerQualityMerchandise()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerQualityMerchandise::with(
     *   expectedAt: ...,
     *   merchantResolutionAttempted: ...,
     *   notReturned: ...,
     *   ongoingNegotiations: ...,
     *   purchaseInfoAndQualityIssue: ...,
     *   receivedAt: ...,
     *   returnAttempted: ...,
     *   returnOutcome: ...,
     *   returned: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerQualityMerchandise)
     *   ->withExpectedAt(...)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withNotReturned(...)
     *   ->withOngoingNegotiations(...)
     *   ->withPurchaseInfoAndQualityIssue(...)
     *   ->withReceivedAt(...)
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
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     * @param NotReturned|NotReturnedShape|null $notReturned
     * @param OngoingNegotiations|OngoingNegotiationsShape|null $ongoingNegotiations
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     * @param ReturnOutcome|value-of<ReturnOutcome> $returnOutcome
     * @param Returned|ReturnedShape|null $returned
     */
    public static function with(
        string $expectedAt,
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        NotReturned|array|null $notReturned,
        OngoingNegotiations|array|null $ongoingNegotiations,
        string $purchaseInfoAndQualityIssue,
        string $receivedAt,
        ReturnAttempted|array|null $returnAttempted,
        ReturnOutcome|string $returnOutcome,
        Returned|array|null $returned,
    ): self {
        $self = new self;

        $self['expectedAt'] = $expectedAt;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['notReturned'] = $notReturned;
        $self['ongoingNegotiations'] = $ongoingNegotiations;
        $self['purchaseInfoAndQualityIssue'] = $purchaseInfoAndQualityIssue;
        $self['receivedAt'] = $receivedAt;
        $self['returnAttempted'] = $returnAttempted;
        $self['returnOutcome'] = $returnOutcome;
        $self['returned'] = $returned;

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
     * Ongoing negotiations. Exclude if there is no evidence of ongoing negotiations.
     *
     * @param OngoingNegotiations|OngoingNegotiationsShape|null $ongoingNegotiations
     */
    public function withOngoingNegotiations(
        OngoingNegotiations|array|null $ongoingNegotiations
    ): self {
        $self = clone $this;
        $self['ongoingNegotiations'] = $ongoingNegotiations;

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

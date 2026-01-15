<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation\NotReturned;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation\ReturnAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation\Returned;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation\ReturnOutcome;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Merchandise misrepresentation. Present if and only if `category` is `consumer_merchandise_misrepresentation`.
 *
 * @phpstan-import-type NotReturnedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation\NotReturned
 * @phpstan-import-type ReturnAttemptedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation\ReturnAttempted
 * @phpstan-import-type ReturnedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation\Returned
 *
 * @phpstan-type ConsumerMerchandiseMisrepresentationShape = array{
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   misrepresentationExplanation: string,
 *   notReturned: null|NotReturned|NotReturnedShape,
 *   purchaseExplanation: string,
 *   receivedAt: string,
 *   returnAttempted: null|ReturnAttempted|ReturnAttemptedShape,
 *   returnOutcome: ReturnOutcome|value-of<ReturnOutcome>,
 *   returned: null|Returned|ReturnedShape,
 * }
 */
final class ConsumerMerchandiseMisrepresentation implements BaseModel
{
    /** @use SdkModel<ConsumerMerchandiseMisrepresentationShape> */
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
     * Misrepresentation explanation.
     */
    #[Required('misrepresentation_explanation')]
    public string $misrepresentationExplanation;

    /**
     * Not returned. Present if and only if `return_outcome` is `not_returned`.
     */
    #[Required('not_returned')]
    public ?NotReturned $notReturned;

    /**
     * Purchase explanation.
     */
    #[Required('purchase_explanation')]
    public string $purchaseExplanation;

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
     * `new ConsumerMerchandiseMisrepresentation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerMerchandiseMisrepresentation::with(
     *   merchantResolutionAttempted: ...,
     *   misrepresentationExplanation: ...,
     *   notReturned: ...,
     *   purchaseExplanation: ...,
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
     * (new ConsumerMerchandiseMisrepresentation)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withMisrepresentationExplanation(...)
     *   ->withNotReturned(...)
     *   ->withPurchaseExplanation(...)
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
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     * @param ReturnOutcome|value-of<ReturnOutcome> $returnOutcome
     * @param Returned|ReturnedShape|null $returned
     */
    public static function with(
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        string $misrepresentationExplanation,
        NotReturned|array|null $notReturned,
        string $purchaseExplanation,
        string $receivedAt,
        ReturnAttempted|array|null $returnAttempted,
        ReturnOutcome|string $returnOutcome,
        Returned|array|null $returned,
    ): self {
        $self = new self;

        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['misrepresentationExplanation'] = $misrepresentationExplanation;
        $self['notReturned'] = $notReturned;
        $self['purchaseExplanation'] = $purchaseExplanation;
        $self['receivedAt'] = $receivedAt;
        $self['returnAttempted'] = $returnAttempted;
        $self['returnOutcome'] = $returnOutcome;
        $self['returned'] = $returned;

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
     * Misrepresentation explanation.
     */
    public function withMisrepresentationExplanation(
        string $misrepresentationExplanation
    ): self {
        $self = clone $this;
        $self['misrepresentationExplanation'] = $misrepresentationExplanation;

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
     * Purchase explanation.
     */
    public function withPurchaseExplanation(string $purchaseExplanation): self
    {
        $self = clone $this;
        $self['purchaseExplanation'] = $purchaseExplanation;

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

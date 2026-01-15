<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback;

use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\CardholderCancellation;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\NotReturned;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\ReturnAttempted;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\Returned;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\ReturnOutcome;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Canceled merchandise. Required if and only if `category` is `consumer_canceled_merchandise`.
 *
 * @phpstan-import-type CardholderCancellationShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\CardholderCancellation
 * @phpstan-import-type NotReturnedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\NotReturned
 * @phpstan-import-type ReturnAttemptedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\ReturnAttempted
 * @phpstan-import-type ReturnedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerCanceledMerchandise\Returned
 *
 * @phpstan-type ConsumerCanceledMerchandiseShape = array{
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   purchaseExplanation: string,
 *   receivedOrExpectedAt: string,
 *   returnOutcome: ReturnOutcome|value-of<ReturnOutcome>,
 *   cardholderCancellation?: null|CardholderCancellation|CardholderCancellationShape,
 *   notReturned?: null|NotReturned|NotReturnedShape,
 *   returnAttempted?: null|ReturnAttempted|ReturnAttemptedShape,
 *   returned?: null|Returned|ReturnedShape,
 * }
 */
final class ConsumerCanceledMerchandise implements BaseModel
{
    /** @use SdkModel<ConsumerCanceledMerchandiseShape> */
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
     * Purchase explanation.
     */
    #[Required('purchase_explanation')]
    public string $purchaseExplanation;

    /**
     * Received or expected at.
     */
    #[Required('received_or_expected_at')]
    public string $receivedOrExpectedAt;

    /**
     * Return outcome.
     *
     * @var value-of<ReturnOutcome> $returnOutcome
     */
    #[Required('return_outcome', enum: ReturnOutcome::class)]
    public string $returnOutcome;

    /**
     * Cardholder cancellation.
     */
    #[Optional('cardholder_cancellation')]
    public ?CardholderCancellation $cardholderCancellation;

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
     * `new ConsumerCanceledMerchandise()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerCanceledMerchandise::with(
     *   merchantResolutionAttempted: ...,
     *   purchaseExplanation: ...,
     *   receivedOrExpectedAt: ...,
     *   returnOutcome: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerCanceledMerchandise)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withPurchaseExplanation(...)
     *   ->withReceivedOrExpectedAt(...)
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
     * @param CardholderCancellation|CardholderCancellationShape|null $cardholderCancellation
     * @param NotReturned|NotReturnedShape|null $notReturned
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     * @param Returned|ReturnedShape|null $returned
     */
    public static function with(
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        string $purchaseExplanation,
        string $receivedOrExpectedAt,
        ReturnOutcome|string $returnOutcome,
        CardholderCancellation|array|null $cardholderCancellation = null,
        NotReturned|array|null $notReturned = null,
        ReturnAttempted|array|null $returnAttempted = null,
        Returned|array|null $returned = null,
    ): self {
        $self = new self;

        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['purchaseExplanation'] = $purchaseExplanation;
        $self['receivedOrExpectedAt'] = $receivedOrExpectedAt;
        $self['returnOutcome'] = $returnOutcome;

        null !== $cardholderCancellation && $self['cardholderCancellation'] = $cardholderCancellation;
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
     * Purchase explanation.
     */
    public function withPurchaseExplanation(string $purchaseExplanation): self
    {
        $self = clone $this;
        $self['purchaseExplanation'] = $purchaseExplanation;

        return $self;
    }

    /**
     * Received or expected at.
     */
    public function withReceivedOrExpectedAt(string $receivedOrExpectedAt): self
    {
        $self = clone $this;
        $self['receivedOrExpectedAt'] = $receivedOrExpectedAt;

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
     * Cardholder cancellation.
     *
     * @param CardholderCancellation|CardholderCancellationShape $cardholderCancellation
     */
    public function withCardholderCancellation(
        CardholderCancellation|array $cardholderCancellation
    ): self {
        $self = clone $this;
        $self['cardholderCancellation'] = $cardholderCancellation;

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

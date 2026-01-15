<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise\CardholderCancellation;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise\NotReturned;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise\ReturnAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise\Returned;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise\ReturnOutcome;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Canceled merchandise. Present if and only if `category` is `consumer_canceled_merchandise`.
 *
 * @phpstan-import-type CardholderCancellationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise\CardholderCancellation
 * @phpstan-import-type NotReturnedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise\NotReturned
 * @phpstan-import-type ReturnAttemptedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise\ReturnAttempted
 * @phpstan-import-type ReturnedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise\Returned
 *
 * @phpstan-type ConsumerCanceledMerchandiseShape = array{
 *   cardholderCancellation: null|CardholderCancellation|CardholderCancellationShape,
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   notReturned: null|NotReturned|NotReturnedShape,
 *   purchaseExplanation: string,
 *   receivedOrExpectedAt: string,
 *   returnAttempted: null|ReturnAttempted|ReturnAttemptedShape,
 *   returnOutcome: ReturnOutcome|value-of<ReturnOutcome>,
 *   returned: null|Returned|ReturnedShape,
 * }
 */
final class ConsumerCanceledMerchandise implements BaseModel
{
    /** @use SdkModel<ConsumerCanceledMerchandiseShape> */
    use SdkModel;

    /**
     * Cardholder cancellation.
     */
    #[Required('cardholder_cancellation')]
    public ?CardholderCancellation $cardholderCancellation;

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
     * `new ConsumerCanceledMerchandise()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerCanceledMerchandise::with(
     *   cardholderCancellation: ...,
     *   merchantResolutionAttempted: ...,
     *   notReturned: ...,
     *   purchaseExplanation: ...,
     *   receivedOrExpectedAt: ...,
     *   returnAttempted: ...,
     *   returnOutcome: ...,
     *   returned: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerCanceledMerchandise)
     *   ->withCardholderCancellation(...)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withNotReturned(...)
     *   ->withPurchaseExplanation(...)
     *   ->withReceivedOrExpectedAt(...)
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
     * @param CardholderCancellation|CardholderCancellationShape|null $cardholderCancellation
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     * @param NotReturned|NotReturnedShape|null $notReturned
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     * @param ReturnOutcome|value-of<ReturnOutcome> $returnOutcome
     * @param Returned|ReturnedShape|null $returned
     */
    public static function with(
        CardholderCancellation|array|null $cardholderCancellation,
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        NotReturned|array|null $notReturned,
        string $purchaseExplanation,
        string $receivedOrExpectedAt,
        ReturnAttempted|array|null $returnAttempted,
        ReturnOutcome|string $returnOutcome,
        Returned|array|null $returned,
    ): self {
        $self = new self;

        $self['cardholderCancellation'] = $cardholderCancellation;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['notReturned'] = $notReturned;
        $self['purchaseExplanation'] = $purchaseExplanation;
        $self['receivedOrExpectedAt'] = $receivedOrExpectedAt;
        $self['returnAttempted'] = $returnAttempted;
        $self['returnOutcome'] = $returnOutcome;
        $self['returned'] = $returned;

        return $self;
    }

    /**
     * Cardholder cancellation.
     *
     * @param CardholderCancellation|CardholderCancellationShape|null $cardholderCancellation
     */
    public function withCardholderCancellation(
        CardholderCancellation|array|null $cardholderCancellation
    ): self {
        $self = clone $this;
        $self['cardholderCancellation'] = $cardholderCancellation;

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

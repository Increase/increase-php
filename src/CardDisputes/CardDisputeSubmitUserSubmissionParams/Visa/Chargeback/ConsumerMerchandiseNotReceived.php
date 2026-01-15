<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback;

use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\CancellationOutcome;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\CardholderCancellationPriorToExpectedReceipt;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\Delayed;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\DeliveredToWrongLocation;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\DeliveryIssue;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\MerchantCancellation;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\NoCancellation;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Merchandise not received. Required if and only if `category` is `consumer_merchandise_not_received`.
 *
 * @phpstan-import-type CardholderCancellationPriorToExpectedReceiptShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\CardholderCancellationPriorToExpectedReceipt
 * @phpstan-import-type DelayedShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\Delayed
 * @phpstan-import-type DeliveredToWrongLocationShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\DeliveredToWrongLocation
 * @phpstan-import-type MerchantCancellationShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\MerchantCancellation
 * @phpstan-import-type NoCancellationShape from \Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\Chargeback\ConsumerMerchandiseNotReceived\NoCancellation
 *
 * @phpstan-type ConsumerMerchandiseNotReceivedShape = array{
 *   cancellationOutcome: CancellationOutcome|value-of<CancellationOutcome>,
 *   deliveryIssue: DeliveryIssue|value-of<DeliveryIssue>,
 *   lastExpectedReceiptAt: string,
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   purchaseInfoAndExplanation: string,
 *   cardholderCancellationPriorToExpectedReceipt?: null|CardholderCancellationPriorToExpectedReceipt|CardholderCancellationPriorToExpectedReceiptShape,
 *   delayed?: null|Delayed|DelayedShape,
 *   deliveredToWrongLocation?: null|DeliveredToWrongLocation|DeliveredToWrongLocationShape,
 *   merchantCancellation?: null|MerchantCancellation|MerchantCancellationShape,
 *   noCancellation?: null|NoCancellation|NoCancellationShape,
 * }
 */
final class ConsumerMerchandiseNotReceived implements BaseModel
{
    /** @use SdkModel<ConsumerMerchandiseNotReceivedShape> */
    use SdkModel;

    /**
     * Cancellation outcome.
     *
     * @var value-of<CancellationOutcome> $cancellationOutcome
     */
    #[Required('cancellation_outcome', enum: CancellationOutcome::class)]
    public string $cancellationOutcome;

    /**
     * Delivery issue.
     *
     * @var value-of<DeliveryIssue> $deliveryIssue
     */
    #[Required('delivery_issue', enum: DeliveryIssue::class)]
    public string $deliveryIssue;

    /**
     * Last expected receipt at.
     */
    #[Required('last_expected_receipt_at')]
    public string $lastExpectedReceiptAt;

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
     * Purchase information and explanation.
     */
    #[Required('purchase_info_and_explanation')]
    public string $purchaseInfoAndExplanation;

    /**
     * Cardholder cancellation prior to expected receipt. Required if and only if `cancellation_outcome` is `cardholder_cancellation_prior_to_expected_receipt`.
     */
    #[Optional('cardholder_cancellation_prior_to_expected_receipt')]
    public ?CardholderCancellationPriorToExpectedReceipt $cardholderCancellationPriorToExpectedReceipt;

    /**
     * Delayed. Required if and only if `delivery_issue` is `delayed`.
     */
    #[Optional]
    public ?Delayed $delayed;

    /**
     * Delivered to wrong location. Required if and only if `delivery_issue` is `delivered_to_wrong_location`.
     */
    #[Optional('delivered_to_wrong_location')]
    public ?DeliveredToWrongLocation $deliveredToWrongLocation;

    /**
     * Merchant cancellation. Required if and only if `cancellation_outcome` is `merchant_cancellation`.
     */
    #[Optional('merchant_cancellation')]
    public ?MerchantCancellation $merchantCancellation;

    /**
     * No cancellation. Required if and only if `cancellation_outcome` is `no_cancellation`.
     */
    #[Optional('no_cancellation')]
    public ?NoCancellation $noCancellation;

    /**
     * `new ConsumerMerchandiseNotReceived()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerMerchandiseNotReceived::with(
     *   cancellationOutcome: ...,
     *   deliveryIssue: ...,
     *   lastExpectedReceiptAt: ...,
     *   merchantResolutionAttempted: ...,
     *   purchaseInfoAndExplanation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerMerchandiseNotReceived)
     *   ->withCancellationOutcome(...)
     *   ->withDeliveryIssue(...)
     *   ->withLastExpectedReceiptAt(...)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withPurchaseInfoAndExplanation(...)
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
     * @param CancellationOutcome|value-of<CancellationOutcome> $cancellationOutcome
     * @param DeliveryIssue|value-of<DeliveryIssue> $deliveryIssue
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     * @param CardholderCancellationPriorToExpectedReceipt|CardholderCancellationPriorToExpectedReceiptShape|null $cardholderCancellationPriorToExpectedReceipt
     * @param Delayed|DelayedShape|null $delayed
     * @param DeliveredToWrongLocation|DeliveredToWrongLocationShape|null $deliveredToWrongLocation
     * @param MerchantCancellation|MerchantCancellationShape|null $merchantCancellation
     * @param NoCancellation|NoCancellationShape|null $noCancellation
     */
    public static function with(
        CancellationOutcome|string $cancellationOutcome,
        DeliveryIssue|string $deliveryIssue,
        string $lastExpectedReceiptAt,
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        string $purchaseInfoAndExplanation,
        CardholderCancellationPriorToExpectedReceipt|array|null $cardholderCancellationPriorToExpectedReceipt = null,
        Delayed|array|null $delayed = null,
        DeliveredToWrongLocation|array|null $deliveredToWrongLocation = null,
        MerchantCancellation|array|null $merchantCancellation = null,
        NoCancellation|array|null $noCancellation = null,
    ): self {
        $self = new self;

        $self['cancellationOutcome'] = $cancellationOutcome;
        $self['deliveryIssue'] = $deliveryIssue;
        $self['lastExpectedReceiptAt'] = $lastExpectedReceiptAt;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['purchaseInfoAndExplanation'] = $purchaseInfoAndExplanation;

        null !== $cardholderCancellationPriorToExpectedReceipt && $self['cardholderCancellationPriorToExpectedReceipt'] = $cardholderCancellationPriorToExpectedReceipt;
        null !== $delayed && $self['delayed'] = $delayed;
        null !== $deliveredToWrongLocation && $self['deliveredToWrongLocation'] = $deliveredToWrongLocation;
        null !== $merchantCancellation && $self['merchantCancellation'] = $merchantCancellation;
        null !== $noCancellation && $self['noCancellation'] = $noCancellation;

        return $self;
    }

    /**
     * Cancellation outcome.
     *
     * @param CancellationOutcome|value-of<CancellationOutcome> $cancellationOutcome
     */
    public function withCancellationOutcome(
        CancellationOutcome|string $cancellationOutcome
    ): self {
        $self = clone $this;
        $self['cancellationOutcome'] = $cancellationOutcome;

        return $self;
    }

    /**
     * Delivery issue.
     *
     * @param DeliveryIssue|value-of<DeliveryIssue> $deliveryIssue
     */
    public function withDeliveryIssue(DeliveryIssue|string $deliveryIssue): self
    {
        $self = clone $this;
        $self['deliveryIssue'] = $deliveryIssue;

        return $self;
    }

    /**
     * Last expected receipt at.
     */
    public function withLastExpectedReceiptAt(
        string $lastExpectedReceiptAt
    ): self {
        $self = clone $this;
        $self['lastExpectedReceiptAt'] = $lastExpectedReceiptAt;

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
     * Purchase information and explanation.
     */
    public function withPurchaseInfoAndExplanation(
        string $purchaseInfoAndExplanation
    ): self {
        $self = clone $this;
        $self['purchaseInfoAndExplanation'] = $purchaseInfoAndExplanation;

        return $self;
    }

    /**
     * Cardholder cancellation prior to expected receipt. Required if and only if `cancellation_outcome` is `cardholder_cancellation_prior_to_expected_receipt`.
     *
     * @param CardholderCancellationPriorToExpectedReceipt|CardholderCancellationPriorToExpectedReceiptShape $cardholderCancellationPriorToExpectedReceipt
     */
    public function withCardholderCancellationPriorToExpectedReceipt(
        CardholderCancellationPriorToExpectedReceipt|array $cardholderCancellationPriorToExpectedReceipt,
    ): self {
        $self = clone $this;
        $self['cardholderCancellationPriorToExpectedReceipt'] = $cardholderCancellationPriorToExpectedReceipt;

        return $self;
    }

    /**
     * Delayed. Required if and only if `delivery_issue` is `delayed`.
     *
     * @param Delayed|DelayedShape $delayed
     */
    public function withDelayed(Delayed|array $delayed): self
    {
        $self = clone $this;
        $self['delayed'] = $delayed;

        return $self;
    }

    /**
     * Delivered to wrong location. Required if and only if `delivery_issue` is `delivered_to_wrong_location`.
     *
     * @param DeliveredToWrongLocation|DeliveredToWrongLocationShape $deliveredToWrongLocation
     */
    public function withDeliveredToWrongLocation(
        DeliveredToWrongLocation|array $deliveredToWrongLocation
    ): self {
        $self = clone $this;
        $self['deliveredToWrongLocation'] = $deliveredToWrongLocation;

        return $self;
    }

    /**
     * Merchant cancellation. Required if and only if `cancellation_outcome` is `merchant_cancellation`.
     *
     * @param MerchantCancellation|MerchantCancellationShape $merchantCancellation
     */
    public function withMerchantCancellation(
        MerchantCancellation|array $merchantCancellation
    ): self {
        $self = clone $this;
        $self['merchantCancellation'] = $merchantCancellation;

        return $self;
    }

    /**
     * No cancellation. Required if and only if `cancellation_outcome` is `no_cancellation`.
     *
     * @param NoCancellation|NoCancellationShape $noCancellation
     */
    public function withNoCancellation(
        NoCancellation|array $noCancellation
    ): self {
        $self = clone $this;
        $self['noCancellation'] = $noCancellation;

        return $self;
    }
}

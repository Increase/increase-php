<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\CancellationOutcome;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\CardholderCancellationPriorToExpectedReceipt;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\Delayed;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\DeliveredToWrongLocation;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\DeliveryIssue;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\MerchantCancellation;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\NoCancellation;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Merchandise not received. Present if and only if `category` is `consumer_merchandise_not_received`.
 *
 * @phpstan-import-type CardholderCancellationPriorToExpectedReceiptShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\CardholderCancellationPriorToExpectedReceipt
 * @phpstan-import-type DelayedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\Delayed
 * @phpstan-import-type DeliveredToWrongLocationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\DeliveredToWrongLocation
 * @phpstan-import-type MerchantCancellationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\MerchantCancellation
 * @phpstan-import-type NoCancellationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\NoCancellation
 *
 * @phpstan-type ConsumerMerchandiseNotReceivedShape = array{
 *   cancellationOutcome: CancellationOutcome|value-of<CancellationOutcome>,
 *   cardholderCancellationPriorToExpectedReceipt: null|CardholderCancellationPriorToExpectedReceipt|CardholderCancellationPriorToExpectedReceiptShape,
 *   delayed: null|Delayed|DelayedShape,
 *   deliveredToWrongLocation: null|DeliveredToWrongLocation|DeliveredToWrongLocationShape,
 *   deliveryIssue: DeliveryIssue|value-of<DeliveryIssue>,
 *   lastExpectedReceiptAt: string,
 *   merchantCancellation: null|MerchantCancellation|MerchantCancellationShape,
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   noCancellation: null|NoCancellation|NoCancellationShape,
 *   purchaseInfoAndExplanation: string,
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
     * Cardholder cancellation prior to expected receipt. Present if and only if `cancellation_outcome` is `cardholder_cancellation_prior_to_expected_receipt`.
     */
    #[Required('cardholder_cancellation_prior_to_expected_receipt')]
    public ?CardholderCancellationPriorToExpectedReceipt $cardholderCancellationPriorToExpectedReceipt;

    /**
     * Delayed. Present if and only if `delivery_issue` is `delayed`.
     */
    #[Required]
    public ?Delayed $delayed;

    /**
     * Delivered to wrong location. Present if and only if `delivery_issue` is `delivered_to_wrong_location`.
     */
    #[Required('delivered_to_wrong_location')]
    public ?DeliveredToWrongLocation $deliveredToWrongLocation;

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
     * Merchant cancellation. Present if and only if `cancellation_outcome` is `merchant_cancellation`.
     */
    #[Required('merchant_cancellation')]
    public ?MerchantCancellation $merchantCancellation;

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
     * No cancellation. Present if and only if `cancellation_outcome` is `no_cancellation`.
     */
    #[Required('no_cancellation')]
    public ?NoCancellation $noCancellation;

    /**
     * Purchase information and explanation.
     */
    #[Required('purchase_info_and_explanation')]
    public string $purchaseInfoAndExplanation;

    /**
     * `new ConsumerMerchandiseNotReceived()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerMerchandiseNotReceived::with(
     *   cancellationOutcome: ...,
     *   cardholderCancellationPriorToExpectedReceipt: ...,
     *   delayed: ...,
     *   deliveredToWrongLocation: ...,
     *   deliveryIssue: ...,
     *   lastExpectedReceiptAt: ...,
     *   merchantCancellation: ...,
     *   merchantResolutionAttempted: ...,
     *   noCancellation: ...,
     *   purchaseInfoAndExplanation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerMerchandiseNotReceived)
     *   ->withCancellationOutcome(...)
     *   ->withCardholderCancellationPriorToExpectedReceipt(...)
     *   ->withDelayed(...)
     *   ->withDeliveredToWrongLocation(...)
     *   ->withDeliveryIssue(...)
     *   ->withLastExpectedReceiptAt(...)
     *   ->withMerchantCancellation(...)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withNoCancellation(...)
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
     * @param CardholderCancellationPriorToExpectedReceipt|CardholderCancellationPriorToExpectedReceiptShape|null $cardholderCancellationPriorToExpectedReceipt
     * @param Delayed|DelayedShape|null $delayed
     * @param DeliveredToWrongLocation|DeliveredToWrongLocationShape|null $deliveredToWrongLocation
     * @param DeliveryIssue|value-of<DeliveryIssue> $deliveryIssue
     * @param MerchantCancellation|MerchantCancellationShape|null $merchantCancellation
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     * @param NoCancellation|NoCancellationShape|null $noCancellation
     */
    public static function with(
        CancellationOutcome|string $cancellationOutcome,
        CardholderCancellationPriorToExpectedReceipt|array|null $cardholderCancellationPriorToExpectedReceipt,
        Delayed|array|null $delayed,
        DeliveredToWrongLocation|array|null $deliveredToWrongLocation,
        DeliveryIssue|string $deliveryIssue,
        string $lastExpectedReceiptAt,
        MerchantCancellation|array|null $merchantCancellation,
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        NoCancellation|array|null $noCancellation,
        string $purchaseInfoAndExplanation,
    ): self {
        $self = new self;

        $self['cancellationOutcome'] = $cancellationOutcome;
        $self['cardholderCancellationPriorToExpectedReceipt'] = $cardholderCancellationPriorToExpectedReceipt;
        $self['delayed'] = $delayed;
        $self['deliveredToWrongLocation'] = $deliveredToWrongLocation;
        $self['deliveryIssue'] = $deliveryIssue;
        $self['lastExpectedReceiptAt'] = $lastExpectedReceiptAt;
        $self['merchantCancellation'] = $merchantCancellation;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['noCancellation'] = $noCancellation;
        $self['purchaseInfoAndExplanation'] = $purchaseInfoAndExplanation;

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
     * Cardholder cancellation prior to expected receipt. Present if and only if `cancellation_outcome` is `cardholder_cancellation_prior_to_expected_receipt`.
     *
     * @param CardholderCancellationPriorToExpectedReceipt|CardholderCancellationPriorToExpectedReceiptShape|null $cardholderCancellationPriorToExpectedReceipt
     */
    public function withCardholderCancellationPriorToExpectedReceipt(
        CardholderCancellationPriorToExpectedReceipt|array|null $cardholderCancellationPriorToExpectedReceipt,
    ): self {
        $self = clone $this;
        $self['cardholderCancellationPriorToExpectedReceipt'] = $cardholderCancellationPriorToExpectedReceipt;

        return $self;
    }

    /**
     * Delayed. Present if and only if `delivery_issue` is `delayed`.
     *
     * @param Delayed|DelayedShape|null $delayed
     */
    public function withDelayed(Delayed|array|null $delayed): self
    {
        $self = clone $this;
        $self['delayed'] = $delayed;

        return $self;
    }

    /**
     * Delivered to wrong location. Present if and only if `delivery_issue` is `delivered_to_wrong_location`.
     *
     * @param DeliveredToWrongLocation|DeliveredToWrongLocationShape|null $deliveredToWrongLocation
     */
    public function withDeliveredToWrongLocation(
        DeliveredToWrongLocation|array|null $deliveredToWrongLocation
    ): self {
        $self = clone $this;
        $self['deliveredToWrongLocation'] = $deliveredToWrongLocation;

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
     * Merchant cancellation. Present if and only if `cancellation_outcome` is `merchant_cancellation`.
     *
     * @param MerchantCancellation|MerchantCancellationShape|null $merchantCancellation
     */
    public function withMerchantCancellation(
        MerchantCancellation|array|null $merchantCancellation
    ): self {
        $self = clone $this;
        $self['merchantCancellation'] = $merchantCancellation;

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
     * No cancellation. Present if and only if `cancellation_outcome` is `no_cancellation`.
     *
     * @param NoCancellation|NoCancellationShape|null $noCancellation
     */
    public function withNoCancellation(
        NoCancellation|array|null $noCancellation
    ): self {
        $self = clone $this;
        $self['noCancellation'] = $noCancellation;

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
}

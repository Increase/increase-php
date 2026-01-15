<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams;

use Increase\CardDisputes\CardDisputeCreateParams\Visa\Authorization;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\Category;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledMerchandise;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledRecurringTransaction;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCounterfeitMerchandise;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCreditNotProcessed;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerDamagedOrDefectiveMerchandise;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerMerchandiseMisrepresentation;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerMerchandiseNotAsDescribed;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerMerchandiseNotReceived;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerNonReceiptOfCash;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerOriginalCreditTransactionNotAccepted;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerServicesMisrepresentation;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerServicesNotAsDescribed;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerServicesNotReceived;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\Fraud;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ProcessingError;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The Visa-specific parameters for the dispute. Required if and only if `network` is `visa`.
 *
 * @phpstan-import-type AuthorizationShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\Authorization
 * @phpstan-import-type ConsumerCanceledMerchandiseShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledMerchandise
 * @phpstan-import-type ConsumerCanceledRecurringTransactionShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledRecurringTransaction
 * @phpstan-import-type ConsumerCanceledServicesShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledServices
 * @phpstan-import-type ConsumerCounterfeitMerchandiseShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCounterfeitMerchandise
 * @phpstan-import-type ConsumerCreditNotProcessedShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCreditNotProcessed
 * @phpstan-import-type ConsumerDamagedOrDefectiveMerchandiseShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerDamagedOrDefectiveMerchandise
 * @phpstan-import-type ConsumerMerchandiseMisrepresentationShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerMerchandiseMisrepresentation
 * @phpstan-import-type ConsumerMerchandiseNotAsDescribedShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerMerchandiseNotAsDescribed
 * @phpstan-import-type ConsumerMerchandiseNotReceivedShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerMerchandiseNotReceived
 * @phpstan-import-type ConsumerNonReceiptOfCashShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerNonReceiptOfCash
 * @phpstan-import-type ConsumerOriginalCreditTransactionNotAcceptedShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerOriginalCreditTransactionNotAccepted
 * @phpstan-import-type ConsumerQualityMerchandiseShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityMerchandise
 * @phpstan-import-type ConsumerQualityServicesShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerQualityServices
 * @phpstan-import-type ConsumerServicesMisrepresentationShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerServicesMisrepresentation
 * @phpstan-import-type ConsumerServicesNotAsDescribedShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerServicesNotAsDescribed
 * @phpstan-import-type ConsumerServicesNotReceivedShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerServicesNotReceived
 * @phpstan-import-type FraudShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\Fraud
 * @phpstan-import-type ProcessingErrorShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ProcessingError
 *
 * @phpstan-type VisaShape = array{
 *   category: Category|value-of<Category>,
 *   authorization?: null|Authorization|AuthorizationShape,
 *   consumerCanceledMerchandise?: null|ConsumerCanceledMerchandise|ConsumerCanceledMerchandiseShape,
 *   consumerCanceledRecurringTransaction?: null|ConsumerCanceledRecurringTransaction|ConsumerCanceledRecurringTransactionShape,
 *   consumerCanceledServices?: null|ConsumerCanceledServices|ConsumerCanceledServicesShape,
 *   consumerCounterfeitMerchandise?: null|ConsumerCounterfeitMerchandise|ConsumerCounterfeitMerchandiseShape,
 *   consumerCreditNotProcessed?: null|ConsumerCreditNotProcessed|ConsumerCreditNotProcessedShape,
 *   consumerDamagedOrDefectiveMerchandise?: null|ConsumerDamagedOrDefectiveMerchandise|ConsumerDamagedOrDefectiveMerchandiseShape,
 *   consumerMerchandiseMisrepresentation?: null|ConsumerMerchandiseMisrepresentation|ConsumerMerchandiseMisrepresentationShape,
 *   consumerMerchandiseNotAsDescribed?: null|ConsumerMerchandiseNotAsDescribed|ConsumerMerchandiseNotAsDescribedShape,
 *   consumerMerchandiseNotReceived?: null|ConsumerMerchandiseNotReceived|ConsumerMerchandiseNotReceivedShape,
 *   consumerNonReceiptOfCash?: null|ConsumerNonReceiptOfCash|ConsumerNonReceiptOfCashShape,
 *   consumerOriginalCreditTransactionNotAccepted?: null|ConsumerOriginalCreditTransactionNotAccepted|ConsumerOriginalCreditTransactionNotAcceptedShape,
 *   consumerQualityMerchandise?: null|ConsumerQualityMerchandise|ConsumerQualityMerchandiseShape,
 *   consumerQualityServices?: null|ConsumerQualityServices|ConsumerQualityServicesShape,
 *   consumerServicesMisrepresentation?: null|ConsumerServicesMisrepresentation|ConsumerServicesMisrepresentationShape,
 *   consumerServicesNotAsDescribed?: null|ConsumerServicesNotAsDescribed|ConsumerServicesNotAsDescribedShape,
 *   consumerServicesNotReceived?: null|ConsumerServicesNotReceived|ConsumerServicesNotReceivedShape,
 *   fraud?: null|Fraud|FraudShape,
 *   processingError?: null|ProcessingError|ProcessingErrorShape,
 * }
 */
final class Visa implements BaseModel
{
    /** @use SdkModel<VisaShape> */
    use SdkModel;

    /**
     * Category.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Authorization. Required if and only if `category` is `authorization`.
     */
    #[Optional]
    public ?Authorization $authorization;

    /**
     * Canceled merchandise. Required if and only if `category` is `consumer_canceled_merchandise`.
     */
    #[Optional('consumer_canceled_merchandise')]
    public ?ConsumerCanceledMerchandise $consumerCanceledMerchandise;

    /**
     * Canceled recurring transaction. Required if and only if `category` is `consumer_canceled_recurring_transaction`.
     */
    #[Optional('consumer_canceled_recurring_transaction')]
    public ?ConsumerCanceledRecurringTransaction $consumerCanceledRecurringTransaction;

    /**
     * Canceled services. Required if and only if `category` is `consumer_canceled_services`.
     */
    #[Optional('consumer_canceled_services')]
    public ?ConsumerCanceledServices $consumerCanceledServices;

    /**
     * Counterfeit merchandise. Required if and only if `category` is `consumer_counterfeit_merchandise`.
     */
    #[Optional('consumer_counterfeit_merchandise')]
    public ?ConsumerCounterfeitMerchandise $consumerCounterfeitMerchandise;

    /**
     * Credit not processed. Required if and only if `category` is `consumer_credit_not_processed`.
     */
    #[Optional('consumer_credit_not_processed')]
    public ?ConsumerCreditNotProcessed $consumerCreditNotProcessed;

    /**
     * Damaged or defective merchandise. Required if and only if `category` is `consumer_damaged_or_defective_merchandise`.
     */
    #[Optional('consumer_damaged_or_defective_merchandise')]
    public ?ConsumerDamagedOrDefectiveMerchandise $consumerDamagedOrDefectiveMerchandise;

    /**
     * Merchandise misrepresentation. Required if and only if `category` is `consumer_merchandise_misrepresentation`.
     */
    #[Optional('consumer_merchandise_misrepresentation')]
    public ?ConsumerMerchandiseMisrepresentation $consumerMerchandiseMisrepresentation;

    /**
     * Merchandise not as described. Required if and only if `category` is `consumer_merchandise_not_as_described`.
     */
    #[Optional('consumer_merchandise_not_as_described')]
    public ?ConsumerMerchandiseNotAsDescribed $consumerMerchandiseNotAsDescribed;

    /**
     * Merchandise not received. Required if and only if `category` is `consumer_merchandise_not_received`.
     */
    #[Optional('consumer_merchandise_not_received')]
    public ?ConsumerMerchandiseNotReceived $consumerMerchandiseNotReceived;

    /**
     * Non-receipt of cash. Required if and only if `category` is `consumer_non_receipt_of_cash`.
     */
    #[Optional('consumer_non_receipt_of_cash')]
    public ?ConsumerNonReceiptOfCash $consumerNonReceiptOfCash;

    /**
     * Original Credit Transaction (OCT) not accepted. Required if and only if `category` is `consumer_original_credit_transaction_not_accepted`.
     */
    #[Optional('consumer_original_credit_transaction_not_accepted')]
    public ?ConsumerOriginalCreditTransactionNotAccepted $consumerOriginalCreditTransactionNotAccepted;

    /**
     * Merchandise quality issue. Required if and only if `category` is `consumer_quality_merchandise`.
     */
    #[Optional('consumer_quality_merchandise')]
    public ?ConsumerQualityMerchandise $consumerQualityMerchandise;

    /**
     * Services quality issue. Required if and only if `category` is `consumer_quality_services`.
     */
    #[Optional('consumer_quality_services')]
    public ?ConsumerQualityServices $consumerQualityServices;

    /**
     * Services misrepresentation. Required if and only if `category` is `consumer_services_misrepresentation`.
     */
    #[Optional('consumer_services_misrepresentation')]
    public ?ConsumerServicesMisrepresentation $consumerServicesMisrepresentation;

    /**
     * Services not as described. Required if and only if `category` is `consumer_services_not_as_described`.
     */
    #[Optional('consumer_services_not_as_described')]
    public ?ConsumerServicesNotAsDescribed $consumerServicesNotAsDescribed;

    /**
     * Services not received. Required if and only if `category` is `consumer_services_not_received`.
     */
    #[Optional('consumer_services_not_received')]
    public ?ConsumerServicesNotReceived $consumerServicesNotReceived;

    /**
     * Fraud. Required if and only if `category` is `fraud`.
     */
    #[Optional]
    public ?Fraud $fraud;

    /**
     * Processing error. Required if and only if `category` is `processing_error`.
     */
    #[Optional('processing_error')]
    public ?ProcessingError $processingError;

    /**
     * `new Visa()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Visa::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Visa)->withCategory(...)
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
     * @param Category|value-of<Category> $category
     * @param Authorization|AuthorizationShape|null $authorization
     * @param ConsumerCanceledMerchandise|ConsumerCanceledMerchandiseShape|null $consumerCanceledMerchandise
     * @param ConsumerCanceledRecurringTransaction|ConsumerCanceledRecurringTransactionShape|null $consumerCanceledRecurringTransaction
     * @param ConsumerCanceledServices|ConsumerCanceledServicesShape|null $consumerCanceledServices
     * @param ConsumerCounterfeitMerchandise|ConsumerCounterfeitMerchandiseShape|null $consumerCounterfeitMerchandise
     * @param ConsumerCreditNotProcessed|ConsumerCreditNotProcessedShape|null $consumerCreditNotProcessed
     * @param ConsumerDamagedOrDefectiveMerchandise|ConsumerDamagedOrDefectiveMerchandiseShape|null $consumerDamagedOrDefectiveMerchandise
     * @param ConsumerMerchandiseMisrepresentation|ConsumerMerchandiseMisrepresentationShape|null $consumerMerchandiseMisrepresentation
     * @param ConsumerMerchandiseNotAsDescribed|ConsumerMerchandiseNotAsDescribedShape|null $consumerMerchandiseNotAsDescribed
     * @param ConsumerMerchandiseNotReceived|ConsumerMerchandiseNotReceivedShape|null $consumerMerchandiseNotReceived
     * @param ConsumerNonReceiptOfCash|ConsumerNonReceiptOfCashShape|null $consumerNonReceiptOfCash
     * @param ConsumerOriginalCreditTransactionNotAccepted|ConsumerOriginalCreditTransactionNotAcceptedShape|null $consumerOriginalCreditTransactionNotAccepted
     * @param ConsumerQualityMerchandise|ConsumerQualityMerchandiseShape|null $consumerQualityMerchandise
     * @param ConsumerQualityServices|ConsumerQualityServicesShape|null $consumerQualityServices
     * @param ConsumerServicesMisrepresentation|ConsumerServicesMisrepresentationShape|null $consumerServicesMisrepresentation
     * @param ConsumerServicesNotAsDescribed|ConsumerServicesNotAsDescribedShape|null $consumerServicesNotAsDescribed
     * @param ConsumerServicesNotReceived|ConsumerServicesNotReceivedShape|null $consumerServicesNotReceived
     * @param Fraud|FraudShape|null $fraud
     * @param ProcessingError|ProcessingErrorShape|null $processingError
     */
    public static function with(
        Category|string $category,
        Authorization|array|null $authorization = null,
        ConsumerCanceledMerchandise|array|null $consumerCanceledMerchandise = null,
        ConsumerCanceledRecurringTransaction|array|null $consumerCanceledRecurringTransaction = null,
        ConsumerCanceledServices|array|null $consumerCanceledServices = null,
        ConsumerCounterfeitMerchandise|array|null $consumerCounterfeitMerchandise = null,
        ConsumerCreditNotProcessed|array|null $consumerCreditNotProcessed = null,
        ConsumerDamagedOrDefectiveMerchandise|array|null $consumerDamagedOrDefectiveMerchandise = null,
        ConsumerMerchandiseMisrepresentation|array|null $consumerMerchandiseMisrepresentation = null,
        ConsumerMerchandiseNotAsDescribed|array|null $consumerMerchandiseNotAsDescribed = null,
        ConsumerMerchandiseNotReceived|array|null $consumerMerchandiseNotReceived = null,
        ConsumerNonReceiptOfCash|array|null $consumerNonReceiptOfCash = null,
        ConsumerOriginalCreditTransactionNotAccepted|array|null $consumerOriginalCreditTransactionNotAccepted = null,
        ConsumerQualityMerchandise|array|null $consumerQualityMerchandise = null,
        ConsumerQualityServices|array|null $consumerQualityServices = null,
        ConsumerServicesMisrepresentation|array|null $consumerServicesMisrepresentation = null,
        ConsumerServicesNotAsDescribed|array|null $consumerServicesNotAsDescribed = null,
        ConsumerServicesNotReceived|array|null $consumerServicesNotReceived = null,
        Fraud|array|null $fraud = null,
        ProcessingError|array|null $processingError = null,
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $authorization && $self['authorization'] = $authorization;
        null !== $consumerCanceledMerchandise && $self['consumerCanceledMerchandise'] = $consumerCanceledMerchandise;
        null !== $consumerCanceledRecurringTransaction && $self['consumerCanceledRecurringTransaction'] = $consumerCanceledRecurringTransaction;
        null !== $consumerCanceledServices && $self['consumerCanceledServices'] = $consumerCanceledServices;
        null !== $consumerCounterfeitMerchandise && $self['consumerCounterfeitMerchandise'] = $consumerCounterfeitMerchandise;
        null !== $consumerCreditNotProcessed && $self['consumerCreditNotProcessed'] = $consumerCreditNotProcessed;
        null !== $consumerDamagedOrDefectiveMerchandise && $self['consumerDamagedOrDefectiveMerchandise'] = $consumerDamagedOrDefectiveMerchandise;
        null !== $consumerMerchandiseMisrepresentation && $self['consumerMerchandiseMisrepresentation'] = $consumerMerchandiseMisrepresentation;
        null !== $consumerMerchandiseNotAsDescribed && $self['consumerMerchandiseNotAsDescribed'] = $consumerMerchandiseNotAsDescribed;
        null !== $consumerMerchandiseNotReceived && $self['consumerMerchandiseNotReceived'] = $consumerMerchandiseNotReceived;
        null !== $consumerNonReceiptOfCash && $self['consumerNonReceiptOfCash'] = $consumerNonReceiptOfCash;
        null !== $consumerOriginalCreditTransactionNotAccepted && $self['consumerOriginalCreditTransactionNotAccepted'] = $consumerOriginalCreditTransactionNotAccepted;
        null !== $consumerQualityMerchandise && $self['consumerQualityMerchandise'] = $consumerQualityMerchandise;
        null !== $consumerQualityServices && $self['consumerQualityServices'] = $consumerQualityServices;
        null !== $consumerServicesMisrepresentation && $self['consumerServicesMisrepresentation'] = $consumerServicesMisrepresentation;
        null !== $consumerServicesNotAsDescribed && $self['consumerServicesNotAsDescribed'] = $consumerServicesNotAsDescribed;
        null !== $consumerServicesNotReceived && $self['consumerServicesNotReceived'] = $consumerServicesNotReceived;
        null !== $fraud && $self['fraud'] = $fraud;
        null !== $processingError && $self['processingError'] = $processingError;

        return $self;
    }

    /**
     * Category.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Authorization. Required if and only if `category` is `authorization`.
     *
     * @param Authorization|AuthorizationShape $authorization
     */
    public function withAuthorization(Authorization|array $authorization): self
    {
        $self = clone $this;
        $self['authorization'] = $authorization;

        return $self;
    }

    /**
     * Canceled merchandise. Required if and only if `category` is `consumer_canceled_merchandise`.
     *
     * @param ConsumerCanceledMerchandise|ConsumerCanceledMerchandiseShape $consumerCanceledMerchandise
     */
    public function withConsumerCanceledMerchandise(
        ConsumerCanceledMerchandise|array $consumerCanceledMerchandise
    ): self {
        $self = clone $this;
        $self['consumerCanceledMerchandise'] = $consumerCanceledMerchandise;

        return $self;
    }

    /**
     * Canceled recurring transaction. Required if and only if `category` is `consumer_canceled_recurring_transaction`.
     *
     * @param ConsumerCanceledRecurringTransaction|ConsumerCanceledRecurringTransactionShape $consumerCanceledRecurringTransaction
     */
    public function withConsumerCanceledRecurringTransaction(
        ConsumerCanceledRecurringTransaction|array $consumerCanceledRecurringTransaction,
    ): self {
        $self = clone $this;
        $self['consumerCanceledRecurringTransaction'] = $consumerCanceledRecurringTransaction;

        return $self;
    }

    /**
     * Canceled services. Required if and only if `category` is `consumer_canceled_services`.
     *
     * @param ConsumerCanceledServices|ConsumerCanceledServicesShape $consumerCanceledServices
     */
    public function withConsumerCanceledServices(
        ConsumerCanceledServices|array $consumerCanceledServices
    ): self {
        $self = clone $this;
        $self['consumerCanceledServices'] = $consumerCanceledServices;

        return $self;
    }

    /**
     * Counterfeit merchandise. Required if and only if `category` is `consumer_counterfeit_merchandise`.
     *
     * @param ConsumerCounterfeitMerchandise|ConsumerCounterfeitMerchandiseShape $consumerCounterfeitMerchandise
     */
    public function withConsumerCounterfeitMerchandise(
        ConsumerCounterfeitMerchandise|array $consumerCounterfeitMerchandise
    ): self {
        $self = clone $this;
        $self['consumerCounterfeitMerchandise'] = $consumerCounterfeitMerchandise;

        return $self;
    }

    /**
     * Credit not processed. Required if and only if `category` is `consumer_credit_not_processed`.
     *
     * @param ConsumerCreditNotProcessed|ConsumerCreditNotProcessedShape $consumerCreditNotProcessed
     */
    public function withConsumerCreditNotProcessed(
        ConsumerCreditNotProcessed|array $consumerCreditNotProcessed
    ): self {
        $self = clone $this;
        $self['consumerCreditNotProcessed'] = $consumerCreditNotProcessed;

        return $self;
    }

    /**
     * Damaged or defective merchandise. Required if and only if `category` is `consumer_damaged_or_defective_merchandise`.
     *
     * @param ConsumerDamagedOrDefectiveMerchandise|ConsumerDamagedOrDefectiveMerchandiseShape $consumerDamagedOrDefectiveMerchandise
     */
    public function withConsumerDamagedOrDefectiveMerchandise(
        ConsumerDamagedOrDefectiveMerchandise|array $consumerDamagedOrDefectiveMerchandise,
    ): self {
        $self = clone $this;
        $self['consumerDamagedOrDefectiveMerchandise'] = $consumerDamagedOrDefectiveMerchandise;

        return $self;
    }

    /**
     * Merchandise misrepresentation. Required if and only if `category` is `consumer_merchandise_misrepresentation`.
     *
     * @param ConsumerMerchandiseMisrepresentation|ConsumerMerchandiseMisrepresentationShape $consumerMerchandiseMisrepresentation
     */
    public function withConsumerMerchandiseMisrepresentation(
        ConsumerMerchandiseMisrepresentation|array $consumerMerchandiseMisrepresentation,
    ): self {
        $self = clone $this;
        $self['consumerMerchandiseMisrepresentation'] = $consumerMerchandiseMisrepresentation;

        return $self;
    }

    /**
     * Merchandise not as described. Required if and only if `category` is `consumer_merchandise_not_as_described`.
     *
     * @param ConsumerMerchandiseNotAsDescribed|ConsumerMerchandiseNotAsDescribedShape $consumerMerchandiseNotAsDescribed
     */
    public function withConsumerMerchandiseNotAsDescribed(
        ConsumerMerchandiseNotAsDescribed|array $consumerMerchandiseNotAsDescribed
    ): self {
        $self = clone $this;
        $self['consumerMerchandiseNotAsDescribed'] = $consumerMerchandiseNotAsDescribed;

        return $self;
    }

    /**
     * Merchandise not received. Required if and only if `category` is `consumer_merchandise_not_received`.
     *
     * @param ConsumerMerchandiseNotReceived|ConsumerMerchandiseNotReceivedShape $consumerMerchandiseNotReceived
     */
    public function withConsumerMerchandiseNotReceived(
        ConsumerMerchandiseNotReceived|array $consumerMerchandiseNotReceived
    ): self {
        $self = clone $this;
        $self['consumerMerchandiseNotReceived'] = $consumerMerchandiseNotReceived;

        return $self;
    }

    /**
     * Non-receipt of cash. Required if and only if `category` is `consumer_non_receipt_of_cash`.
     *
     * @param ConsumerNonReceiptOfCash|ConsumerNonReceiptOfCashShape $consumerNonReceiptOfCash
     */
    public function withConsumerNonReceiptOfCash(
        ConsumerNonReceiptOfCash|array $consumerNonReceiptOfCash
    ): self {
        $self = clone $this;
        $self['consumerNonReceiptOfCash'] = $consumerNonReceiptOfCash;

        return $self;
    }

    /**
     * Original Credit Transaction (OCT) not accepted. Required if and only if `category` is `consumer_original_credit_transaction_not_accepted`.
     *
     * @param ConsumerOriginalCreditTransactionNotAccepted|ConsumerOriginalCreditTransactionNotAcceptedShape $consumerOriginalCreditTransactionNotAccepted
     */
    public function withConsumerOriginalCreditTransactionNotAccepted(
        ConsumerOriginalCreditTransactionNotAccepted|array $consumerOriginalCreditTransactionNotAccepted,
    ): self {
        $self = clone $this;
        $self['consumerOriginalCreditTransactionNotAccepted'] = $consumerOriginalCreditTransactionNotAccepted;

        return $self;
    }

    /**
     * Merchandise quality issue. Required if and only if `category` is `consumer_quality_merchandise`.
     *
     * @param ConsumerQualityMerchandise|ConsumerQualityMerchandiseShape $consumerQualityMerchandise
     */
    public function withConsumerQualityMerchandise(
        ConsumerQualityMerchandise|array $consumerQualityMerchandise
    ): self {
        $self = clone $this;
        $self['consumerQualityMerchandise'] = $consumerQualityMerchandise;

        return $self;
    }

    /**
     * Services quality issue. Required if and only if `category` is `consumer_quality_services`.
     *
     * @param ConsumerQualityServices|ConsumerQualityServicesShape $consumerQualityServices
     */
    public function withConsumerQualityServices(
        ConsumerQualityServices|array $consumerQualityServices
    ): self {
        $self = clone $this;
        $self['consumerQualityServices'] = $consumerQualityServices;

        return $self;
    }

    /**
     * Services misrepresentation. Required if and only if `category` is `consumer_services_misrepresentation`.
     *
     * @param ConsumerServicesMisrepresentation|ConsumerServicesMisrepresentationShape $consumerServicesMisrepresentation
     */
    public function withConsumerServicesMisrepresentation(
        ConsumerServicesMisrepresentation|array $consumerServicesMisrepresentation
    ): self {
        $self = clone $this;
        $self['consumerServicesMisrepresentation'] = $consumerServicesMisrepresentation;

        return $self;
    }

    /**
     * Services not as described. Required if and only if `category` is `consumer_services_not_as_described`.
     *
     * @param ConsumerServicesNotAsDescribed|ConsumerServicesNotAsDescribedShape $consumerServicesNotAsDescribed
     */
    public function withConsumerServicesNotAsDescribed(
        ConsumerServicesNotAsDescribed|array $consumerServicesNotAsDescribed
    ): self {
        $self = clone $this;
        $self['consumerServicesNotAsDescribed'] = $consumerServicesNotAsDescribed;

        return $self;
    }

    /**
     * Services not received. Required if and only if `category` is `consumer_services_not_received`.
     *
     * @param ConsumerServicesNotReceived|ConsumerServicesNotReceivedShape $consumerServicesNotReceived
     */
    public function withConsumerServicesNotReceived(
        ConsumerServicesNotReceived|array $consumerServicesNotReceived
    ): self {
        $self = clone $this;
        $self['consumerServicesNotReceived'] = $consumerServicesNotReceived;

        return $self;
    }

    /**
     * Fraud. Required if and only if `category` is `fraud`.
     *
     * @param Fraud|FraudShape $fraud
     */
    public function withFraud(Fraud|array $fraud): self
    {
        $self = clone $this;
        $self['fraud'] = $fraud;

        return $self;
    }

    /**
     * Processing error. Required if and only if `category` is `processing_error`.
     *
     * @param ProcessingError|ProcessingErrorShape $processingError
     */
    public function withProcessingError(
        ProcessingError|array $processingError
    ): self {
        $self = clone $this;
        $self['processingError'] = $processingError;

        return $self;
    }
}

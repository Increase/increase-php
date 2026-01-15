<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\Authorization;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\Category;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledRecurringTransaction;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCounterfeitMerchandise;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCreditNotProcessed;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerDamagedOrDefectiveMerchandise;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotAsDescribed;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerNonReceiptOfCash;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerOriginalCreditTransactionNotAccepted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityServices;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesMisrepresentation;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesNotAsDescribed;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesNotReceived;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\Fraud;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Visa Card Dispute Chargeback User Submission Chargeback Details object. This field will be present in the JSON response if and only if `category` is equal to `chargeback`. Contains the details specific to a Visa chargeback User Submission for a Card Dispute.
 *
 * @phpstan-import-type AuthorizationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\Authorization
 * @phpstan-import-type ConsumerCanceledMerchandiseShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledMerchandise
 * @phpstan-import-type ConsumerCanceledRecurringTransactionShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledRecurringTransaction
 * @phpstan-import-type ConsumerCanceledServicesShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledServices
 * @phpstan-import-type ConsumerCounterfeitMerchandiseShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCounterfeitMerchandise
 * @phpstan-import-type ConsumerCreditNotProcessedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCreditNotProcessed
 * @phpstan-import-type ConsumerDamagedOrDefectiveMerchandiseShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerDamagedOrDefectiveMerchandise
 * @phpstan-import-type ConsumerMerchandiseMisrepresentationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseMisrepresentation
 * @phpstan-import-type ConsumerMerchandiseNotAsDescribedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotAsDescribed
 * @phpstan-import-type ConsumerMerchandiseNotReceivedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived
 * @phpstan-import-type ConsumerNonReceiptOfCashShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerNonReceiptOfCash
 * @phpstan-import-type ConsumerOriginalCreditTransactionNotAcceptedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerOriginalCreditTransactionNotAccepted
 * @phpstan-import-type ConsumerQualityMerchandiseShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityMerchandise
 * @phpstan-import-type ConsumerQualityServicesShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerQualityServices
 * @phpstan-import-type ConsumerServicesMisrepresentationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesMisrepresentation
 * @phpstan-import-type ConsumerServicesNotAsDescribedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesNotAsDescribed
 * @phpstan-import-type ConsumerServicesNotReceivedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesNotReceived
 * @phpstan-import-type FraudShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\Fraud
 * @phpstan-import-type ProcessingErrorShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError
 *
 * @phpstan-type ChargebackShape = array{
 *   authorization: null|Authorization|AuthorizationShape,
 *   category: \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\Category|value-of<\Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\Category>,
 *   consumerCanceledMerchandise: null|ConsumerCanceledMerchandise|ConsumerCanceledMerchandiseShape,
 *   consumerCanceledRecurringTransaction: null|ConsumerCanceledRecurringTransaction|ConsumerCanceledRecurringTransactionShape,
 *   consumerCanceledServices: null|ConsumerCanceledServices|ConsumerCanceledServicesShape,
 *   consumerCounterfeitMerchandise: null|ConsumerCounterfeitMerchandise|ConsumerCounterfeitMerchandiseShape,
 *   consumerCreditNotProcessed: null|ConsumerCreditNotProcessed|ConsumerCreditNotProcessedShape,
 *   consumerDamagedOrDefectiveMerchandise: null|ConsumerDamagedOrDefectiveMerchandise|ConsumerDamagedOrDefectiveMerchandiseShape,
 *   consumerMerchandiseMisrepresentation: null|ConsumerMerchandiseMisrepresentation|ConsumerMerchandiseMisrepresentationShape,
 *   consumerMerchandiseNotAsDescribed: null|ConsumerMerchandiseNotAsDescribed|ConsumerMerchandiseNotAsDescribedShape,
 *   consumerMerchandiseNotReceived: null|ConsumerMerchandiseNotReceived|ConsumerMerchandiseNotReceivedShape,
 *   consumerNonReceiptOfCash: null|ConsumerNonReceiptOfCash|ConsumerNonReceiptOfCashShape,
 *   consumerOriginalCreditTransactionNotAccepted: null|ConsumerOriginalCreditTransactionNotAccepted|ConsumerOriginalCreditTransactionNotAcceptedShape,
 *   consumerQualityMerchandise: null|ConsumerQualityMerchandise|ConsumerQualityMerchandiseShape,
 *   consumerQualityServices: null|ConsumerQualityServices|ConsumerQualityServicesShape,
 *   consumerServicesMisrepresentation: null|ConsumerServicesMisrepresentation|ConsumerServicesMisrepresentationShape,
 *   consumerServicesNotAsDescribed: null|ConsumerServicesNotAsDescribed|ConsumerServicesNotAsDescribedShape,
 *   consumerServicesNotReceived: null|ConsumerServicesNotReceived|ConsumerServicesNotReceivedShape,
 *   fraud: null|Fraud|FraudShape,
 *   processingError: null|ProcessingError|ProcessingErrorShape,
 * }
 */
final class Chargeback implements BaseModel
{
    /** @use SdkModel<ChargebackShape> */
    use SdkModel;

    /**
     * Authorization. Present if and only if `category` is `authorization`.
     */
    #[Required]
    public ?Authorization $authorization;

    /**
     * Category.
     *
     * @var value-of<Category> $category
     */
    #[Required(
        enum: Category::class,
    )]
    public string $category;

    /**
     * Canceled merchandise. Present if and only if `category` is `consumer_canceled_merchandise`.
     */
    #[Required('consumer_canceled_merchandise')]
    public ?ConsumerCanceledMerchandise $consumerCanceledMerchandise;

    /**
     * Canceled recurring transaction. Present if and only if `category` is `consumer_canceled_recurring_transaction`.
     */
    #[Required('consumer_canceled_recurring_transaction')]
    public ?ConsumerCanceledRecurringTransaction $consumerCanceledRecurringTransaction;

    /**
     * Canceled services. Present if and only if `category` is `consumer_canceled_services`.
     */
    #[Required('consumer_canceled_services')]
    public ?ConsumerCanceledServices $consumerCanceledServices;

    /**
     * Counterfeit merchandise. Present if and only if `category` is `consumer_counterfeit_merchandise`.
     */
    #[Required('consumer_counterfeit_merchandise')]
    public ?ConsumerCounterfeitMerchandise $consumerCounterfeitMerchandise;

    /**
     * Credit not processed. Present if and only if `category` is `consumer_credit_not_processed`.
     */
    #[Required('consumer_credit_not_processed')]
    public ?ConsumerCreditNotProcessed $consumerCreditNotProcessed;

    /**
     * Damaged or defective merchandise. Present if and only if `category` is `consumer_damaged_or_defective_merchandise`.
     */
    #[Required('consumer_damaged_or_defective_merchandise')]
    public ?ConsumerDamagedOrDefectiveMerchandise $consumerDamagedOrDefectiveMerchandise;

    /**
     * Merchandise misrepresentation. Present if and only if `category` is `consumer_merchandise_misrepresentation`.
     */
    #[Required('consumer_merchandise_misrepresentation')]
    public ?ConsumerMerchandiseMisrepresentation $consumerMerchandiseMisrepresentation;

    /**
     * Merchandise not as described. Present if and only if `category` is `consumer_merchandise_not_as_described`.
     */
    #[Required('consumer_merchandise_not_as_described')]
    public ?ConsumerMerchandiseNotAsDescribed $consumerMerchandiseNotAsDescribed;

    /**
     * Merchandise not received. Present if and only if `category` is `consumer_merchandise_not_received`.
     */
    #[Required('consumer_merchandise_not_received')]
    public ?ConsumerMerchandiseNotReceived $consumerMerchandiseNotReceived;

    /**
     * Non-receipt of cash. Present if and only if `category` is `consumer_non_receipt_of_cash`.
     */
    #[Required('consumer_non_receipt_of_cash')]
    public ?ConsumerNonReceiptOfCash $consumerNonReceiptOfCash;

    /**
     * Original Credit Transaction (OCT) not accepted. Present if and only if `category` is `consumer_original_credit_transaction_not_accepted`.
     */
    #[Required('consumer_original_credit_transaction_not_accepted')]
    public ?ConsumerOriginalCreditTransactionNotAccepted $consumerOriginalCreditTransactionNotAccepted;

    /**
     * Merchandise quality issue. Present if and only if `category` is `consumer_quality_merchandise`.
     */
    #[Required('consumer_quality_merchandise')]
    public ?ConsumerQualityMerchandise $consumerQualityMerchandise;

    /**
     * Services quality issue. Present if and only if `category` is `consumer_quality_services`.
     */
    #[Required('consumer_quality_services')]
    public ?ConsumerQualityServices $consumerQualityServices;

    /**
     * Services misrepresentation. Present if and only if `category` is `consumer_services_misrepresentation`.
     */
    #[Required('consumer_services_misrepresentation')]
    public ?ConsumerServicesMisrepresentation $consumerServicesMisrepresentation;

    /**
     * Services not as described. Present if and only if `category` is `consumer_services_not_as_described`.
     */
    #[Required('consumer_services_not_as_described')]
    public ?ConsumerServicesNotAsDescribed $consumerServicesNotAsDescribed;

    /**
     * Services not received. Present if and only if `category` is `consumer_services_not_received`.
     */
    #[Required('consumer_services_not_received')]
    public ?ConsumerServicesNotReceived $consumerServicesNotReceived;

    /**
     * Fraud. Present if and only if `category` is `fraud`.
     */
    #[Required]
    public ?Fraud $fraud;

    /**
     * Processing error. Present if and only if `category` is `processing_error`.
     */
    #[Required('processing_error')]
    public ?ProcessingError $processingError;

    /**
     * `new Chargeback()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Chargeback::with(
     *   authorization: ...,
     *   category: ...,
     *   consumerCanceledMerchandise: ...,
     *   consumerCanceledRecurringTransaction: ...,
     *   consumerCanceledServices: ...,
     *   consumerCounterfeitMerchandise: ...,
     *   consumerCreditNotProcessed: ...,
     *   consumerDamagedOrDefectiveMerchandise: ...,
     *   consumerMerchandiseMisrepresentation: ...,
     *   consumerMerchandiseNotAsDescribed: ...,
     *   consumerMerchandiseNotReceived: ...,
     *   consumerNonReceiptOfCash: ...,
     *   consumerOriginalCreditTransactionNotAccepted: ...,
     *   consumerQualityMerchandise: ...,
     *   consumerQualityServices: ...,
     *   consumerServicesMisrepresentation: ...,
     *   consumerServicesNotAsDescribed: ...,
     *   consumerServicesNotReceived: ...,
     *   fraud: ...,
     *   processingError: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Chargeback)
     *   ->withAuthorization(...)
     *   ->withCategory(...)
     *   ->withConsumerCanceledMerchandise(...)
     *   ->withConsumerCanceledRecurringTransaction(...)
     *   ->withConsumerCanceledServices(...)
     *   ->withConsumerCounterfeitMerchandise(...)
     *   ->withConsumerCreditNotProcessed(...)
     *   ->withConsumerDamagedOrDefectiveMerchandise(...)
     *   ->withConsumerMerchandiseMisrepresentation(...)
     *   ->withConsumerMerchandiseNotAsDescribed(...)
     *   ->withConsumerMerchandiseNotReceived(...)
     *   ->withConsumerNonReceiptOfCash(...)
     *   ->withConsumerOriginalCreditTransactionNotAccepted(...)
     *   ->withConsumerQualityMerchandise(...)
     *   ->withConsumerQualityServices(...)
     *   ->withConsumerServicesMisrepresentation(...)
     *   ->withConsumerServicesNotAsDescribed(...)
     *   ->withConsumerServicesNotReceived(...)
     *   ->withFraud(...)
     *   ->withProcessingError(...)
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
     * @param Authorization|AuthorizationShape|null $authorization
     * @param Category|value-of<Category> $category
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
        Authorization|array|null $authorization,
        Category|string $category,
        ConsumerCanceledMerchandise|array|null $consumerCanceledMerchandise,
        ConsumerCanceledRecurringTransaction|array|null $consumerCanceledRecurringTransaction,
        ConsumerCanceledServices|array|null $consumerCanceledServices,
        ConsumerCounterfeitMerchandise|array|null $consumerCounterfeitMerchandise,
        ConsumerCreditNotProcessed|array|null $consumerCreditNotProcessed,
        ConsumerDamagedOrDefectiveMerchandise|array|null $consumerDamagedOrDefectiveMerchandise,
        ConsumerMerchandiseMisrepresentation|array|null $consumerMerchandiseMisrepresentation,
        ConsumerMerchandiseNotAsDescribed|array|null $consumerMerchandiseNotAsDescribed,
        ConsumerMerchandiseNotReceived|array|null $consumerMerchandiseNotReceived,
        ConsumerNonReceiptOfCash|array|null $consumerNonReceiptOfCash,
        ConsumerOriginalCreditTransactionNotAccepted|array|null $consumerOriginalCreditTransactionNotAccepted,
        ConsumerQualityMerchandise|array|null $consumerQualityMerchandise,
        ConsumerQualityServices|array|null $consumerQualityServices,
        ConsumerServicesMisrepresentation|array|null $consumerServicesMisrepresentation,
        ConsumerServicesNotAsDescribed|array|null $consumerServicesNotAsDescribed,
        ConsumerServicesNotReceived|array|null $consumerServicesNotReceived,
        Fraud|array|null $fraud,
        ProcessingError|array|null $processingError,
    ): self {
        $self = new self;

        $self['authorization'] = $authorization;
        $self['category'] = $category;
        $self['consumerCanceledMerchandise'] = $consumerCanceledMerchandise;
        $self['consumerCanceledRecurringTransaction'] = $consumerCanceledRecurringTransaction;
        $self['consumerCanceledServices'] = $consumerCanceledServices;
        $self['consumerCounterfeitMerchandise'] = $consumerCounterfeitMerchandise;
        $self['consumerCreditNotProcessed'] = $consumerCreditNotProcessed;
        $self['consumerDamagedOrDefectiveMerchandise'] = $consumerDamagedOrDefectiveMerchandise;
        $self['consumerMerchandiseMisrepresentation'] = $consumerMerchandiseMisrepresentation;
        $self['consumerMerchandiseNotAsDescribed'] = $consumerMerchandiseNotAsDescribed;
        $self['consumerMerchandiseNotReceived'] = $consumerMerchandiseNotReceived;
        $self['consumerNonReceiptOfCash'] = $consumerNonReceiptOfCash;
        $self['consumerOriginalCreditTransactionNotAccepted'] = $consumerOriginalCreditTransactionNotAccepted;
        $self['consumerQualityMerchandise'] = $consumerQualityMerchandise;
        $self['consumerQualityServices'] = $consumerQualityServices;
        $self['consumerServicesMisrepresentation'] = $consumerServicesMisrepresentation;
        $self['consumerServicesNotAsDescribed'] = $consumerServicesNotAsDescribed;
        $self['consumerServicesNotReceived'] = $consumerServicesNotReceived;
        $self['fraud'] = $fraud;
        $self['processingError'] = $processingError;

        return $self;
    }

    /**
     * Authorization. Present if and only if `category` is `authorization`.
     *
     * @param Authorization|AuthorizationShape|null $authorization
     */
    public function withAuthorization(
        Authorization|array|null $authorization
    ): self {
        $self = clone $this;
        $self['authorization'] = $authorization;

        return $self;
    }

    /**
     * Category.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(
        Category|string $category,
    ): self {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Canceled merchandise. Present if and only if `category` is `consumer_canceled_merchandise`.
     *
     * @param ConsumerCanceledMerchandise|ConsumerCanceledMerchandiseShape|null $consumerCanceledMerchandise
     */
    public function withConsumerCanceledMerchandise(
        ConsumerCanceledMerchandise|array|null $consumerCanceledMerchandise
    ): self {
        $self = clone $this;
        $self['consumerCanceledMerchandise'] = $consumerCanceledMerchandise;

        return $self;
    }

    /**
     * Canceled recurring transaction. Present if and only if `category` is `consumer_canceled_recurring_transaction`.
     *
     * @param ConsumerCanceledRecurringTransaction|ConsumerCanceledRecurringTransactionShape|null $consumerCanceledRecurringTransaction
     */
    public function withConsumerCanceledRecurringTransaction(
        ConsumerCanceledRecurringTransaction|array|null $consumerCanceledRecurringTransaction,
    ): self {
        $self = clone $this;
        $self['consumerCanceledRecurringTransaction'] = $consumerCanceledRecurringTransaction;

        return $self;
    }

    /**
     * Canceled services. Present if and only if `category` is `consumer_canceled_services`.
     *
     * @param ConsumerCanceledServices|ConsumerCanceledServicesShape|null $consumerCanceledServices
     */
    public function withConsumerCanceledServices(
        ConsumerCanceledServices|array|null $consumerCanceledServices
    ): self {
        $self = clone $this;
        $self['consumerCanceledServices'] = $consumerCanceledServices;

        return $self;
    }

    /**
     * Counterfeit merchandise. Present if and only if `category` is `consumer_counterfeit_merchandise`.
     *
     * @param ConsumerCounterfeitMerchandise|ConsumerCounterfeitMerchandiseShape|null $consumerCounterfeitMerchandise
     */
    public function withConsumerCounterfeitMerchandise(
        ConsumerCounterfeitMerchandise|array|null $consumerCounterfeitMerchandise
    ): self {
        $self = clone $this;
        $self['consumerCounterfeitMerchandise'] = $consumerCounterfeitMerchandise;

        return $self;
    }

    /**
     * Credit not processed. Present if and only if `category` is `consumer_credit_not_processed`.
     *
     * @param ConsumerCreditNotProcessed|ConsumerCreditNotProcessedShape|null $consumerCreditNotProcessed
     */
    public function withConsumerCreditNotProcessed(
        ConsumerCreditNotProcessed|array|null $consumerCreditNotProcessed
    ): self {
        $self = clone $this;
        $self['consumerCreditNotProcessed'] = $consumerCreditNotProcessed;

        return $self;
    }

    /**
     * Damaged or defective merchandise. Present if and only if `category` is `consumer_damaged_or_defective_merchandise`.
     *
     * @param ConsumerDamagedOrDefectiveMerchandise|ConsumerDamagedOrDefectiveMerchandiseShape|null $consumerDamagedOrDefectiveMerchandise
     */
    public function withConsumerDamagedOrDefectiveMerchandise(
        ConsumerDamagedOrDefectiveMerchandise|array|null $consumerDamagedOrDefectiveMerchandise,
    ): self {
        $self = clone $this;
        $self['consumerDamagedOrDefectiveMerchandise'] = $consumerDamagedOrDefectiveMerchandise;

        return $self;
    }

    /**
     * Merchandise misrepresentation. Present if and only if `category` is `consumer_merchandise_misrepresentation`.
     *
     * @param ConsumerMerchandiseMisrepresentation|ConsumerMerchandiseMisrepresentationShape|null $consumerMerchandiseMisrepresentation
     */
    public function withConsumerMerchandiseMisrepresentation(
        ConsumerMerchandiseMisrepresentation|array|null $consumerMerchandiseMisrepresentation,
    ): self {
        $self = clone $this;
        $self['consumerMerchandiseMisrepresentation'] = $consumerMerchandiseMisrepresentation;

        return $self;
    }

    /**
     * Merchandise not as described. Present if and only if `category` is `consumer_merchandise_not_as_described`.
     *
     * @param ConsumerMerchandiseNotAsDescribed|ConsumerMerchandiseNotAsDescribedShape|null $consumerMerchandiseNotAsDescribed
     */
    public function withConsumerMerchandiseNotAsDescribed(
        ConsumerMerchandiseNotAsDescribed|array|null $consumerMerchandiseNotAsDescribed,
    ): self {
        $self = clone $this;
        $self['consumerMerchandiseNotAsDescribed'] = $consumerMerchandiseNotAsDescribed;

        return $self;
    }

    /**
     * Merchandise not received. Present if and only if `category` is `consumer_merchandise_not_received`.
     *
     * @param ConsumerMerchandiseNotReceived|ConsumerMerchandiseNotReceivedShape|null $consumerMerchandiseNotReceived
     */
    public function withConsumerMerchandiseNotReceived(
        ConsumerMerchandiseNotReceived|array|null $consumerMerchandiseNotReceived
    ): self {
        $self = clone $this;
        $self['consumerMerchandiseNotReceived'] = $consumerMerchandiseNotReceived;

        return $self;
    }

    /**
     * Non-receipt of cash. Present if and only if `category` is `consumer_non_receipt_of_cash`.
     *
     * @param ConsumerNonReceiptOfCash|ConsumerNonReceiptOfCashShape|null $consumerNonReceiptOfCash
     */
    public function withConsumerNonReceiptOfCash(
        ConsumerNonReceiptOfCash|array|null $consumerNonReceiptOfCash
    ): self {
        $self = clone $this;
        $self['consumerNonReceiptOfCash'] = $consumerNonReceiptOfCash;

        return $self;
    }

    /**
     * Original Credit Transaction (OCT) not accepted. Present if and only if `category` is `consumer_original_credit_transaction_not_accepted`.
     *
     * @param ConsumerOriginalCreditTransactionNotAccepted|ConsumerOriginalCreditTransactionNotAcceptedShape|null $consumerOriginalCreditTransactionNotAccepted
     */
    public function withConsumerOriginalCreditTransactionNotAccepted(
        ConsumerOriginalCreditTransactionNotAccepted|array|null $consumerOriginalCreditTransactionNotAccepted,
    ): self {
        $self = clone $this;
        $self['consumerOriginalCreditTransactionNotAccepted'] = $consumerOriginalCreditTransactionNotAccepted;

        return $self;
    }

    /**
     * Merchandise quality issue. Present if and only if `category` is `consumer_quality_merchandise`.
     *
     * @param ConsumerQualityMerchandise|ConsumerQualityMerchandiseShape|null $consumerQualityMerchandise
     */
    public function withConsumerQualityMerchandise(
        ConsumerQualityMerchandise|array|null $consumerQualityMerchandise
    ): self {
        $self = clone $this;
        $self['consumerQualityMerchandise'] = $consumerQualityMerchandise;

        return $self;
    }

    /**
     * Services quality issue. Present if and only if `category` is `consumer_quality_services`.
     *
     * @param ConsumerQualityServices|ConsumerQualityServicesShape|null $consumerQualityServices
     */
    public function withConsumerQualityServices(
        ConsumerQualityServices|array|null $consumerQualityServices
    ): self {
        $self = clone $this;
        $self['consumerQualityServices'] = $consumerQualityServices;

        return $self;
    }

    /**
     * Services misrepresentation. Present if and only if `category` is `consumer_services_misrepresentation`.
     *
     * @param ConsumerServicesMisrepresentation|ConsumerServicesMisrepresentationShape|null $consumerServicesMisrepresentation
     */
    public function withConsumerServicesMisrepresentation(
        ConsumerServicesMisrepresentation|array|null $consumerServicesMisrepresentation,
    ): self {
        $self = clone $this;
        $self['consumerServicesMisrepresentation'] = $consumerServicesMisrepresentation;

        return $self;
    }

    /**
     * Services not as described. Present if and only if `category` is `consumer_services_not_as_described`.
     *
     * @param ConsumerServicesNotAsDescribed|ConsumerServicesNotAsDescribedShape|null $consumerServicesNotAsDescribed
     */
    public function withConsumerServicesNotAsDescribed(
        ConsumerServicesNotAsDescribed|array|null $consumerServicesNotAsDescribed
    ): self {
        $self = clone $this;
        $self['consumerServicesNotAsDescribed'] = $consumerServicesNotAsDescribed;

        return $self;
    }

    /**
     * Services not received. Present if and only if `category` is `consumer_services_not_received`.
     *
     * @param ConsumerServicesNotReceived|ConsumerServicesNotReceivedShape|null $consumerServicesNotReceived
     */
    public function withConsumerServicesNotReceived(
        ConsumerServicesNotReceived|array|null $consumerServicesNotReceived
    ): self {
        $self = clone $this;
        $self['consumerServicesNotReceived'] = $consumerServicesNotReceived;

        return $self;
    }

    /**
     * Fraud. Present if and only if `category` is `fraud`.
     *
     * @param Fraud|FraudShape|null $fraud
     */
    public function withFraud(Fraud|array|null $fraud): self
    {
        $self = clone $this;
        $self['fraud'] = $fraud;

        return $self;
    }

    /**
     * Processing error. Present if and only if `category` is `processing_error`.
     *
     * @param ProcessingError|ProcessingErrorShape|null $processingError
     */
    public function withProcessingError(
        ProcessingError|array|null $processingError
    ): self {
        $self = clone $this;
        $self['processingError'] = $processingError;

        return $self;
    }
}

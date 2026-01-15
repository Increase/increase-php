<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError\DuplicateTransaction;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError\ErrorReason;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError\IncorrectAmount;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError\PaidByOtherMeans;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Processing error. Present if and only if `category` is `processing_error`.
 *
 * @phpstan-import-type DuplicateTransactionShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError\DuplicateTransaction
 * @phpstan-import-type IncorrectAmountShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError\IncorrectAmount
 * @phpstan-import-type PaidByOtherMeansShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError\PaidByOtherMeans
 *
 * @phpstan-type ProcessingErrorShape = array{
 *   duplicateTransaction: null|DuplicateTransaction|DuplicateTransactionShape,
 *   errorReason: ErrorReason|value-of<ErrorReason>,
 *   incorrectAmount: null|IncorrectAmount|IncorrectAmountShape,
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   paidByOtherMeans: null|PaidByOtherMeans|PaidByOtherMeansShape,
 * }
 */
final class ProcessingError implements BaseModel
{
    /** @use SdkModel<ProcessingErrorShape> */
    use SdkModel;

    /**
     * Duplicate transaction. Present if and only if `error_reason` is `duplicate_transaction`.
     */
    #[Required('duplicate_transaction')]
    public ?DuplicateTransaction $duplicateTransaction;

    /**
     * Error reason.
     *
     * @var value-of<ErrorReason> $errorReason
     */
    #[Required('error_reason', enum: ErrorReason::class)]
    public string $errorReason;

    /**
     * Incorrect amount. Present if and only if `error_reason` is `incorrect_amount`.
     */
    #[Required('incorrect_amount')]
    public ?IncorrectAmount $incorrectAmount;

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
     * Paid by other means. Present if and only if `error_reason` is `paid_by_other_means`.
     */
    #[Required('paid_by_other_means')]
    public ?PaidByOtherMeans $paidByOtherMeans;

    /**
     * `new ProcessingError()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProcessingError::with(
     *   duplicateTransaction: ...,
     *   errorReason: ...,
     *   incorrectAmount: ...,
     *   merchantResolutionAttempted: ...,
     *   paidByOtherMeans: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProcessingError)
     *   ->withDuplicateTransaction(...)
     *   ->withErrorReason(...)
     *   ->withIncorrectAmount(...)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withPaidByOtherMeans(...)
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
     * @param DuplicateTransaction|DuplicateTransactionShape|null $duplicateTransaction
     * @param ErrorReason|value-of<ErrorReason> $errorReason
     * @param IncorrectAmount|IncorrectAmountShape|null $incorrectAmount
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     * @param PaidByOtherMeans|PaidByOtherMeansShape|null $paidByOtherMeans
     */
    public static function with(
        DuplicateTransaction|array|null $duplicateTransaction,
        ErrorReason|string $errorReason,
        IncorrectAmount|array|null $incorrectAmount,
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        PaidByOtherMeans|array|null $paidByOtherMeans,
    ): self {
        $self = new self;

        $self['duplicateTransaction'] = $duplicateTransaction;
        $self['errorReason'] = $errorReason;
        $self['incorrectAmount'] = $incorrectAmount;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['paidByOtherMeans'] = $paidByOtherMeans;

        return $self;
    }

    /**
     * Duplicate transaction. Present if and only if `error_reason` is `duplicate_transaction`.
     *
     * @param DuplicateTransaction|DuplicateTransactionShape|null $duplicateTransaction
     */
    public function withDuplicateTransaction(
        DuplicateTransaction|array|null $duplicateTransaction
    ): self {
        $self = clone $this;
        $self['duplicateTransaction'] = $duplicateTransaction;

        return $self;
    }

    /**
     * Error reason.
     *
     * @param ErrorReason|value-of<ErrorReason> $errorReason
     */
    public function withErrorReason(ErrorReason|string $errorReason): self
    {
        $self = clone $this;
        $self['errorReason'] = $errorReason;

        return $self;
    }

    /**
     * Incorrect amount. Present if and only if `error_reason` is `incorrect_amount`.
     *
     * @param IncorrectAmount|IncorrectAmountShape|null $incorrectAmount
     */
    public function withIncorrectAmount(
        IncorrectAmount|array|null $incorrectAmount
    ): self {
        $self = clone $this;
        $self['incorrectAmount'] = $incorrectAmount;

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
     * Paid by other means. Present if and only if `error_reason` is `paid_by_other_means`.
     *
     * @param PaidByOtherMeans|PaidByOtherMeansShape|null $paidByOtherMeans
     */
    public function withPaidByOtherMeans(
        PaidByOtherMeans|array|null $paidByOtherMeans
    ): self {
        $self = clone $this;
        $self['paidByOtherMeans'] = $paidByOtherMeans;

        return $self;
    }
}

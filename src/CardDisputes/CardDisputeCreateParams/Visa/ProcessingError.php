<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa;

use Increase\CardDisputes\CardDisputeCreateParams\Visa\ProcessingError\DuplicateTransaction;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ProcessingError\ErrorReason;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ProcessingError\IncorrectAmount;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ProcessingError\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ProcessingError\PaidByOtherMeans;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Processing error. Required if and only if `category` is `processing_error`.
 *
 * @phpstan-import-type DuplicateTransactionShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ProcessingError\DuplicateTransaction
 * @phpstan-import-type IncorrectAmountShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ProcessingError\IncorrectAmount
 * @phpstan-import-type PaidByOtherMeansShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ProcessingError\PaidByOtherMeans
 *
 * @phpstan-type ProcessingErrorShape = array{
 *   errorReason: ErrorReason|value-of<ErrorReason>,
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   duplicateTransaction?: null|DuplicateTransaction|DuplicateTransactionShape,
 *   incorrectAmount?: null|IncorrectAmount|IncorrectAmountShape,
 *   paidByOtherMeans?: null|PaidByOtherMeans|PaidByOtherMeansShape,
 * }
 */
final class ProcessingError implements BaseModel
{
    /** @use SdkModel<ProcessingErrorShape> */
    use SdkModel;

    /**
     * Error reason.
     *
     * @var value-of<ErrorReason> $errorReason
     */
    #[Required('error_reason', enum: ErrorReason::class)]
    public string $errorReason;

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
     * Duplicate transaction. Required if and only if `error_reason` is `duplicate_transaction`.
     */
    #[Optional('duplicate_transaction')]
    public ?DuplicateTransaction $duplicateTransaction;

    /**
     * Incorrect amount. Required if and only if `error_reason` is `incorrect_amount`.
     */
    #[Optional('incorrect_amount')]
    public ?IncorrectAmount $incorrectAmount;

    /**
     * Paid by other means. Required if and only if `error_reason` is `paid_by_other_means`.
     */
    #[Optional('paid_by_other_means')]
    public ?PaidByOtherMeans $paidByOtherMeans;

    /**
     * `new ProcessingError()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProcessingError::with(errorReason: ..., merchantResolutionAttempted: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProcessingError)
     *   ->withErrorReason(...)
     *   ->withMerchantResolutionAttempted(...)
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
     * @param ErrorReason|value-of<ErrorReason> $errorReason
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     * @param DuplicateTransaction|DuplicateTransactionShape|null $duplicateTransaction
     * @param IncorrectAmount|IncorrectAmountShape|null $incorrectAmount
     * @param PaidByOtherMeans|PaidByOtherMeansShape|null $paidByOtherMeans
     */
    public static function with(
        ErrorReason|string $errorReason,
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        DuplicateTransaction|array|null $duplicateTransaction = null,
        IncorrectAmount|array|null $incorrectAmount = null,
        PaidByOtherMeans|array|null $paidByOtherMeans = null,
    ): self {
        $self = new self;

        $self['errorReason'] = $errorReason;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;

        null !== $duplicateTransaction && $self['duplicateTransaction'] = $duplicateTransaction;
        null !== $incorrectAmount && $self['incorrectAmount'] = $incorrectAmount;
        null !== $paidByOtherMeans && $self['paidByOtherMeans'] = $paidByOtherMeans;

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
     * Duplicate transaction. Required if and only if `error_reason` is `duplicate_transaction`.
     *
     * @param DuplicateTransaction|DuplicateTransactionShape $duplicateTransaction
     */
    public function withDuplicateTransaction(
        DuplicateTransaction|array $duplicateTransaction
    ): self {
        $self = clone $this;
        $self['duplicateTransaction'] = $duplicateTransaction;

        return $self;
    }

    /**
     * Incorrect amount. Required if and only if `error_reason` is `incorrect_amount`.
     *
     * @param IncorrectAmount|IncorrectAmountShape $incorrectAmount
     */
    public function withIncorrectAmount(
        IncorrectAmount|array $incorrectAmount
    ): self {
        $self = clone $this;
        $self['incorrectAmount'] = $incorrectAmount;

        return $self;
    }

    /**
     * Paid by other means. Required if and only if `error_reason` is `paid_by_other_means`.
     *
     * @param PaidByOtherMeans|PaidByOtherMeansShape $paidByOtherMeans
     */
    public function withPaidByOtherMeans(
        PaidByOtherMeans|array $paidByOtherMeans
    ): self {
        $self = clone $this;
        $self['paidByOtherMeans'] = $paidByOtherMeans;

        return $self;
    }
}

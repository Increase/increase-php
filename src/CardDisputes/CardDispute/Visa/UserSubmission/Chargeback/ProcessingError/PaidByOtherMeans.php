<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError\PaidByOtherMeans\OtherFormOfPaymentEvidence;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Paid by other means. Present if and only if `error_reason` is `paid_by_other_means`.
 *
 * @phpstan-type PaidByOtherMeansShape = array{
 *   otherFormOfPaymentEvidence: OtherFormOfPaymentEvidence|value-of<OtherFormOfPaymentEvidence>,
 *   otherTransactionID: string|null,
 * }
 */
final class PaidByOtherMeans implements BaseModel
{
    /** @use SdkModel<PaidByOtherMeansShape> */
    use SdkModel;

    /**
     * Other form of payment evidence.
     *
     * @var value-of<OtherFormOfPaymentEvidence> $otherFormOfPaymentEvidence
     */
    #[Required(
        'other_form_of_payment_evidence',
        enum: OtherFormOfPaymentEvidence::class
    )]
    public string $otherFormOfPaymentEvidence;

    /**
     * Other transaction ID.
     */
    #[Required('other_transaction_id')]
    public ?string $otherTransactionID;

    /**
     * `new PaidByOtherMeans()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaidByOtherMeans::with(otherFormOfPaymentEvidence: ..., otherTransactionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaidByOtherMeans)
     *   ->withOtherFormOfPaymentEvidence(...)
     *   ->withOtherTransactionID(...)
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
     * @param OtherFormOfPaymentEvidence|value-of<OtherFormOfPaymentEvidence> $otherFormOfPaymentEvidence
     */
    public static function with(
        OtherFormOfPaymentEvidence|string $otherFormOfPaymentEvidence,
        ?string $otherTransactionID,
    ): self {
        $self = new self;

        $self['otherFormOfPaymentEvidence'] = $otherFormOfPaymentEvidence;
        $self['otherTransactionID'] = $otherTransactionID;

        return $self;
    }

    /**
     * Other form of payment evidence.
     *
     * @param OtherFormOfPaymentEvidence|value-of<OtherFormOfPaymentEvidence> $otherFormOfPaymentEvidence
     */
    public function withOtherFormOfPaymentEvidence(
        OtherFormOfPaymentEvidence|string $otherFormOfPaymentEvidence
    ): self {
        $self = clone $this;
        $self['otherFormOfPaymentEvidence'] = $otherFormOfPaymentEvidence;

        return $self;
    }

    /**
     * Other transaction ID.
     */
    public function withOtherTransactionID(?string $otherTransactionID): self
    {
        $self = clone $this;
        $self['otherTransactionID'] = $otherTransactionID;

        return $self;
    }
}

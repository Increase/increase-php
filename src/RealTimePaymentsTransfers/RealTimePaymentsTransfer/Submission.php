<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * After the transfer is submitted to Real-Time Payments, this will contain supplemental details.
 *
 * @phpstan-type SubmissionShape = array{
 *   submittedAt: \DateTimeInterface|null, transactionIdentification: string
 * }
 */
final class Submission implements BaseModel
{
    /** @use SdkModel<SubmissionShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was submitted to The Clearing House.
     */
    #[Required('submitted_at')]
    public ?\DateTimeInterface $submittedAt;

    /**
     * The Real-Time Payments network identification of the transfer.
     */
    #[Required('transaction_identification')]
    public string $transactionIdentification;

    /**
     * `new Submission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Submission::with(submittedAt: ..., transactionIdentification: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Submission)->withSubmittedAt(...)->withTransactionIdentification(...)
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
     */
    public static function with(
        ?\DateTimeInterface $submittedAt,
        string $transactionIdentification
    ): self {
        $self = new self;

        $self['submittedAt'] = $submittedAt;
        $self['transactionIdentification'] = $transactionIdentification;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was submitted to The Clearing House.
     */
    public function withSubmittedAt(?\DateTimeInterface $submittedAt): self
    {
        $self = clone $this;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }

    /**
     * The Real-Time Payments network identification of the transfer.
     */
    public function withTransactionIdentification(
        string $transactionIdentification
    ): self {
        $self = clone $this;
        $self['transactionIdentification'] = $transactionIdentification;

        return $self;
    }
}

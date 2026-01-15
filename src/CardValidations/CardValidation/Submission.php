<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * After the validation is submitted to the card network, this will contain supplemental details.
 *
 * @phpstan-type SubmissionShape = array{
 *   retrievalReferenceNumber: string,
 *   submittedAt: \DateTimeInterface,
 *   traceNumber: string,
 * }
 */
final class Submission implements BaseModel
{
    /** @use SdkModel<SubmissionShape> */
    use SdkModel;

    /**
     * A 12-digit retrieval reference number that identifies the validation. Usually a combination of a timestamp and the trace number.
     */
    #[Required('retrieval_reference_number')]
    public string $retrievalReferenceNumber;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the validation was submitted to the card network.
     */
    #[Required('submitted_at')]
    public \DateTimeInterface $submittedAt;

    /**
     * A 6-digit trace number that identifies the validation within a short time window.
     */
    #[Required('trace_number')]
    public string $traceNumber;

    /**
     * `new Submission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Submission::with(
     *   retrievalReferenceNumber: ..., submittedAt: ..., traceNumber: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Submission)
     *   ->withRetrievalReferenceNumber(...)
     *   ->withSubmittedAt(...)
     *   ->withTraceNumber(...)
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
        string $retrievalReferenceNumber,
        \DateTimeInterface $submittedAt,
        string $traceNumber,
    ): self {
        $self = new self;

        $self['retrievalReferenceNumber'] = $retrievalReferenceNumber;
        $self['submittedAt'] = $submittedAt;
        $self['traceNumber'] = $traceNumber;

        return $self;
    }

    /**
     * A 12-digit retrieval reference number that identifies the validation. Usually a combination of a timestamp and the trace number.
     */
    public function withRetrievalReferenceNumber(
        string $retrievalReferenceNumber
    ): self {
        $self = clone $this;
        $self['retrievalReferenceNumber'] = $retrievalReferenceNumber;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the validation was submitted to the card network.
     */
    public function withSubmittedAt(\DateTimeInterface $submittedAt): self
    {
        $self = clone $this;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }

    /**
     * A 6-digit trace number that identifies the validation within a short time window.
     */
    public function withTraceNumber(string $traceNumber): self
    {
        $self = clone $this;
        $self['traceNumber'] = $traceNumber;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * After the transfer is submitted to Fedwire, this will contain supplemental details.
 *
 * @phpstan-type SubmissionShape = array{
 *   inputMessageAccountabilityData: string, submittedAt: \DateTimeInterface
 * }
 */
final class Submission implements BaseModel
{
    /** @use SdkModel<SubmissionShape> */
    use SdkModel;

    /**
     * The accountability data for the submission.
     */
    #[Required('input_message_accountability_data')]
    public string $inputMessageAccountabilityData;

    /**
     * When this wire transfer was submitted to Fedwire.
     */
    #[Required('submitted_at')]
    public \DateTimeInterface $submittedAt;

    /**
     * `new Submission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Submission::with(inputMessageAccountabilityData: ..., submittedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Submission)->withInputMessageAccountabilityData(...)->withSubmittedAt(...)
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
        string $inputMessageAccountabilityData,
        \DateTimeInterface $submittedAt
    ): self {
        $self = new self;

        $self['inputMessageAccountabilityData'] = $inputMessageAccountabilityData;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }

    /**
     * The accountability data for the submission.
     */
    public function withInputMessageAccountabilityData(
        string $inputMessageAccountabilityData
    ): self {
        $self = clone $this;
        $self['inputMessageAccountabilityData'] = $inputMessageAccountabilityData;

        return $self;
    }

    /**
     * When this wire transfer was submitted to Fedwire.
     */
    public function withSubmittedAt(\DateTimeInterface $submittedAt): self
    {
        $self = clone $this;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }
}

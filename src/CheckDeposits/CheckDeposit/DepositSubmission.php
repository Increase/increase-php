<?php

declare(strict_types=1);

namespace Increase\CheckDeposits\CheckDeposit;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * After the check is parsed, it is submitted to the Check21 network for processing. This will contain details of the submission.
 *
 * @phpstan-type DepositSubmissionShape = array{
 *   backFileID: string, frontFileID: string, submittedAt: \DateTimeInterface
 * }
 */
final class DepositSubmission implements BaseModel
{
    /** @use SdkModel<DepositSubmissionShape> */
    use SdkModel;

    /**
     * The ID for the File containing the check back image that was submitted to the Check21 network.
     */
    #[Required('back_file_id')]
    public string $backFileID;

    /**
     * The ID for the File containing the check front image that was submitted to the Check21 network.
     */
    #[Required('front_file_id')]
    public string $frontFileID;

    /**
     * When the check deposit was submitted to the Check21 network for processing. During business days, this happens within a few hours of the check being accepted by Increase.
     */
    #[Required('submitted_at')]
    public \DateTimeInterface $submittedAt;

    /**
     * `new DepositSubmission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DepositSubmission::with(backFileID: ..., frontFileID: ..., submittedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DepositSubmission)
     *   ->withBackFileID(...)
     *   ->withFrontFileID(...)
     *   ->withSubmittedAt(...)
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
        string $backFileID,
        string $frontFileID,
        \DateTimeInterface $submittedAt
    ): self {
        $self = new self;

        $self['backFileID'] = $backFileID;
        $self['frontFileID'] = $frontFileID;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }

    /**
     * The ID for the File containing the check back image that was submitted to the Check21 network.
     */
    public function withBackFileID(string $backFileID): self
    {
        $self = clone $this;
        $self['backFileID'] = $backFileID;

        return $self;
    }

    /**
     * The ID for the File containing the check front image that was submitted to the Check21 network.
     */
    public function withFrontFileID(string $frontFileID): self
    {
        $self = clone $this;
        $self['frontFileID'] = $frontFileID;

        return $self;
    }

    /**
     * When the check deposit was submitted to the Check21 network for processing. During business days, this happens within a few hours of the check being accepted by Increase.
     */
    public function withSubmittedAt(\DateTimeInterface $submittedAt): self
    {
        $self = clone $this;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }
}

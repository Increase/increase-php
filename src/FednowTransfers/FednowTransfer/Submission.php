<?php

declare(strict_types=1);

namespace Increase\FednowTransfers\FednowTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * After the transfer is submitted to FedNow, this will contain supplemental details.
 *
 * @phpstan-type SubmissionShape = array{
 *   messageIdentification: string, submittedAt: \DateTimeInterface|null
 * }
 */
final class Submission implements BaseModel
{
    /** @use SdkModel<SubmissionShape> */
    use SdkModel;

    /**
     * The FedNow network identification of the message submitted.
     */
    #[Required('message_identification')]
    public string $messageIdentification;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was submitted to FedNow.
     */
    #[Required('submitted_at')]
    public ?\DateTimeInterface $submittedAt;

    /**
     * `new Submission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Submission::with(messageIdentification: ..., submittedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Submission)->withMessageIdentification(...)->withSubmittedAt(...)
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
        string $messageIdentification,
        ?\DateTimeInterface $submittedAt
    ): self {
        $self = new self;

        $self['messageIdentification'] = $messageIdentification;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }

    /**
     * The FedNow network identification of the message submitted.
     */
    public function withMessageIdentification(
        string $messageIdentification
    ): self {
        $self = clone $this;
        $self['messageIdentification'] = $messageIdentification;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was submitted to FedNow.
     */
    public function withSubmittedAt(?\DateTimeInterface $submittedAt): self
    {
        $self = clone $this;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }
}

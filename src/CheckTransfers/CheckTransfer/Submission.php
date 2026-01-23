<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer;

use Increase\CheckTransfers\CheckTransfer\Submission\SubmittedAddress;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * After the transfer is submitted, this will contain supplemental details.
 *
 * @phpstan-import-type SubmittedAddressShape from \Increase\CheckTransfers\CheckTransfer\Submission\SubmittedAddress
 *
 * @phpstan-type SubmissionShape = array{
 *   previewFileID: string|null,
 *   submittedAddress: SubmittedAddress|SubmittedAddressShape,
 *   submittedAt: \DateTimeInterface,
 *   trackingNumber: string|null,
 * }
 */
final class Submission implements BaseModel
{
    /** @use SdkModel<SubmissionShape> */
    use SdkModel;

    /**
     * The ID of the file corresponding to an image of the check that was mailed, if available.
     */
    #[Required('preview_file_id')]
    public ?string $previewFileID;

    /**
     * The address we submitted to the printer. This is what is physically printed on the check.
     */
    #[Required('submitted_address')]
    public SubmittedAddress $submittedAddress;

    /**
     * When this check was submitted to our check printer.
     */
    #[Required('submitted_at')]
    public \DateTimeInterface $submittedAt;

    /**
     * The tracking number for the check shipment.
     */
    #[Required('tracking_number')]
    public ?string $trackingNumber;

    /**
     * `new Submission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Submission::with(
     *   previewFileID: ...,
     *   submittedAddress: ...,
     *   submittedAt: ...,
     *   trackingNumber: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Submission)
     *   ->withPreviewFileID(...)
     *   ->withSubmittedAddress(...)
     *   ->withSubmittedAt(...)
     *   ->withTrackingNumber(...)
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
     * @param SubmittedAddress|SubmittedAddressShape $submittedAddress
     */
    public static function with(
        ?string $previewFileID,
        SubmittedAddress|array $submittedAddress,
        \DateTimeInterface $submittedAt,
        ?string $trackingNumber,
    ): self {
        $self = new self;

        $self['previewFileID'] = $previewFileID;
        $self['submittedAddress'] = $submittedAddress;
        $self['submittedAt'] = $submittedAt;
        $self['trackingNumber'] = $trackingNumber;

        return $self;
    }

    /**
     * The ID of the file corresponding to an image of the check that was mailed, if available.
     */
    public function withPreviewFileID(?string $previewFileID): self
    {
        $self = clone $this;
        $self['previewFileID'] = $previewFileID;

        return $self;
    }

    /**
     * The address we submitted to the printer. This is what is physically printed on the check.
     *
     * @param SubmittedAddress|SubmittedAddressShape $submittedAddress
     */
    public function withSubmittedAddress(
        SubmittedAddress|array $submittedAddress
    ): self {
        $self = clone $this;
        $self['submittedAddress'] = $submittedAddress;

        return $self;
    }

    /**
     * When this check was submitted to our check printer.
     */
    public function withSubmittedAt(\DateTimeInterface $submittedAt): self
    {
        $self = clone $this;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }

    /**
     * The tracking number for the check shipment.
     */
    public function withTrackingNumber(?string $trackingNumber): self
    {
        $self = clone $this;
        $self['trackingNumber'] = $trackingNumber;

        return $self;
    }
}

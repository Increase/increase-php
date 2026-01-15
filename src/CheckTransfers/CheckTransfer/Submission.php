<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer;

use Increase\CheckTransfers\CheckTransfer\Submission\AddressCorrectionAction;
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
 *   addressCorrectionAction: AddressCorrectionAction|value-of<AddressCorrectionAction>,
 *   submittedAddress: SubmittedAddress|SubmittedAddressShape,
 *   submittedAt: \DateTimeInterface,
 * }
 */
final class Submission implements BaseModel
{
    /** @use SdkModel<SubmissionShape> */
    use SdkModel;

    /**
     * Per USPS requirements, Increase will standardize the address to USPS standards and check it against the USPS National Change of Address (NCOA) database before mailing it. This indicates what modifications, if any, were made to the address before printing and mailing the check.
     *
     * @var value-of<AddressCorrectionAction> $addressCorrectionAction
     */
    #[Required('address_correction_action', enum: AddressCorrectionAction::class)]
    public string $addressCorrectionAction;

    /**
     * The address we submitted to the printer. This is what is physically printed on the check.
     */
    #[Required('submitted_address')]
    public SubmittedAddress $submittedAddress;

    /**
     * When this check transfer was submitted to our check printer.
     */
    #[Required('submitted_at')]
    public \DateTimeInterface $submittedAt;

    /**
     * `new Submission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Submission::with(
     *   addressCorrectionAction: ..., submittedAddress: ..., submittedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Submission)
     *   ->withAddressCorrectionAction(...)
     *   ->withSubmittedAddress(...)
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
     *
     * @param AddressCorrectionAction|value-of<AddressCorrectionAction> $addressCorrectionAction
     * @param SubmittedAddress|SubmittedAddressShape $submittedAddress
     */
    public static function with(
        AddressCorrectionAction|string $addressCorrectionAction,
        SubmittedAddress|array $submittedAddress,
        \DateTimeInterface $submittedAt,
    ): self {
        $self = new self;

        $self['addressCorrectionAction'] = $addressCorrectionAction;
        $self['submittedAddress'] = $submittedAddress;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }

    /**
     * Per USPS requirements, Increase will standardize the address to USPS standards and check it against the USPS National Change of Address (NCOA) database before mailing it. This indicates what modifications, if any, were made to the address before printing and mailing the check.
     *
     * @param AddressCorrectionAction|value-of<AddressCorrectionAction> $addressCorrectionAction
     */
    public function withAddressCorrectionAction(
        AddressCorrectionAction|string $addressCorrectionAction
    ): self {
        $self = clone $this;
        $self['addressCorrectionAction'] = $addressCorrectionAction;

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
     * When this check transfer was submitted to our check printer.
     */
    public function withSubmittedAt(\DateTimeInterface $submittedAt): self
    {
        $self = clone $this;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }
}

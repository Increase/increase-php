<?php

declare(strict_types=1);

namespace Increase\FednowTransfers\FednowTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\FednowTransfers\FednowTransfer\Rejection\RejectReasonCode;

/**
 * If the transfer is rejected by FedNow or the destination financial institution, this will contain supplemental details.
 *
 * @phpstan-type RejectionShape = array{
 *   rejectReasonAdditionalInformation: string|null,
 *   rejectReasonCode: RejectReasonCode|value-of<RejectReasonCode>,
 *   rejectedAt: \DateTimeInterface|null,
 * }
 */
final class Rejection implements BaseModel
{
    /** @use SdkModel<RejectionShape> */
    use SdkModel;

    /**
     * Additional information about the rejection provided by the recipient bank.
     */
    #[Required('reject_reason_additional_information')]
    public ?string $rejectReasonAdditionalInformation;

    /**
     * The reason the transfer was rejected as provided by the recipient bank or the FedNow network.
     *
     * @var value-of<RejectReasonCode> $rejectReasonCode
     */
    #[Required('reject_reason_code', enum: RejectReasonCode::class)]
    public string $rejectReasonCode;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was rejected.
     */
    #[Required('rejected_at')]
    public ?\DateTimeInterface $rejectedAt;

    /**
     * `new Rejection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Rejection::with(
     *   rejectReasonAdditionalInformation: ..., rejectReasonCode: ..., rejectedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Rejection)
     *   ->withRejectReasonAdditionalInformation(...)
     *   ->withRejectReasonCode(...)
     *   ->withRejectedAt(...)
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
     * @param RejectReasonCode|value-of<RejectReasonCode> $rejectReasonCode
     */
    public static function with(
        ?string $rejectReasonAdditionalInformation,
        RejectReasonCode|string $rejectReasonCode,
        ?\DateTimeInterface $rejectedAt,
    ): self {
        $self = new self;

        $self['rejectReasonAdditionalInformation'] = $rejectReasonAdditionalInformation;
        $self['rejectReasonCode'] = $rejectReasonCode;
        $self['rejectedAt'] = $rejectedAt;

        return $self;
    }

    /**
     * Additional information about the rejection provided by the recipient bank.
     */
    public function withRejectReasonAdditionalInformation(
        ?string $rejectReasonAdditionalInformation
    ): self {
        $self = clone $this;
        $self['rejectReasonAdditionalInformation'] = $rejectReasonAdditionalInformation;

        return $self;
    }

    /**
     * The reason the transfer was rejected as provided by the recipient bank or the FedNow network.
     *
     * @param RejectReasonCode|value-of<RejectReasonCode> $rejectReasonCode
     */
    public function withRejectReasonCode(
        RejectReasonCode|string $rejectReasonCode
    ): self {
        $self = clone $this;
        $self['rejectReasonCode'] = $rejectReasonCode;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was rejected.
     */
    public function withRejectedAt(?\DateTimeInterface $rejectedAt): self
    {
        $self = clone $this;
        $self['rejectedAt'] = $rejectedAt;

        return $self;
    }
}

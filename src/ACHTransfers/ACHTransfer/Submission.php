<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

use Increase\ACHTransfers\ACHTransfer\Submission\ExpectedSettlementSchedule;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * After the transfer is submitted to FedACH, this will contain supplemental details. Increase batches transfers and submits a file to the Federal Reserve roughly every 30 minutes. The Federal Reserve processes ACH transfers during weekdays according to their [posted schedule](https://www.frbservices.org/resources/resource-centers/same-day-ach/fedach-processing-schedule.html).
 *
 * @phpstan-type SubmissionShape = array{
 *   administrativeReturnsExpectedBy: \DateTimeInterface,
 *   effectiveDate: string,
 *   expectedFundsSettlementAt: \DateTimeInterface,
 *   expectedSettlementSchedule: ExpectedSettlementSchedule|value-of<ExpectedSettlementSchedule>,
 *   submittedAt: \DateTimeInterface,
 *   traceNumber: string,
 * }
 */
final class Submission implements BaseModel
{
    /** @use SdkModel<SubmissionShape> */
    use SdkModel;

    /**
     * The timestamp by which any administrative returns are expected to be received by. This follows the NACHA guidelines for return windows, which are: "In general, return entries must be received by the RDFI’s ACH Operator by its deposit deadline for the return entry to be made available to the ODFI no later than the opening of business on the second banking day following the Settlement Date of the original entry.".
     */
    #[Required('administrative_returns_expected_by')]
    public \DateTimeInterface $administrativeReturnsExpectedBy;

    /**
     * The ACH transfer's effective date as sent to the Federal Reserve. If a specific date was configured using `preferred_effective_date`, this will match that value. Otherwise, it will be the date selected (following the specified settlement schedule) at the time the transfer was submitted.
     */
    #[Required('effective_date')]
    public string $effectiveDate;

    /**
     * When the transfer is expected to settle in the recipient's account. Credits may be available sooner, at the receiving banks discretion. The FedACH schedule is published [here](https://www.frbservices.org/resources/resource-centers/same-day-ach/fedach-processing-schedule.html).
     */
    #[Required('expected_funds_settlement_at')]
    public \DateTimeInterface $expectedFundsSettlementAt;

    /**
     * The settlement schedule the transfer is expected to follow. This expectation takes into account the `effective_date`, `submitted_at`, and the amount of the transfer.
     *
     * @var value-of<ExpectedSettlementSchedule> $expectedSettlementSchedule
     */
    #[Required(
        'expected_settlement_schedule',
        enum: ExpectedSettlementSchedule::class
    )]
    public string $expectedSettlementSchedule;

    /**
     * When the ACH transfer was sent to FedACH.
     */
    #[Required('submitted_at')]
    public \DateTimeInterface $submittedAt;

    /**
     * A 15 digit number recorded in the Nacha file and transmitted to the receiving bank. Along with the amount, date, and originating routing number, this can be used to identify the ACH transfer at the receiving bank. ACH trace numbers are not unique, but are [used to correlate returns](https://increase.com/documentation/ach-returns#ach-returns).
     */
    #[Required('trace_number')]
    public string $traceNumber;

    /**
     * `new Submission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Submission::with(
     *   administrativeReturnsExpectedBy: ...,
     *   effectiveDate: ...,
     *   expectedFundsSettlementAt: ...,
     *   expectedSettlementSchedule: ...,
     *   submittedAt: ...,
     *   traceNumber: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Submission)
     *   ->withAdministrativeReturnsExpectedBy(...)
     *   ->withEffectiveDate(...)
     *   ->withExpectedFundsSettlementAt(...)
     *   ->withExpectedSettlementSchedule(...)
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
     *
     * @param ExpectedSettlementSchedule|value-of<ExpectedSettlementSchedule> $expectedSettlementSchedule
     */
    public static function with(
        \DateTimeInterface $administrativeReturnsExpectedBy,
        string $effectiveDate,
        \DateTimeInterface $expectedFundsSettlementAt,
        ExpectedSettlementSchedule|string $expectedSettlementSchedule,
        \DateTimeInterface $submittedAt,
        string $traceNumber,
    ): self {
        $self = new self;

        $self['administrativeReturnsExpectedBy'] = $administrativeReturnsExpectedBy;
        $self['effectiveDate'] = $effectiveDate;
        $self['expectedFundsSettlementAt'] = $expectedFundsSettlementAt;
        $self['expectedSettlementSchedule'] = $expectedSettlementSchedule;
        $self['submittedAt'] = $submittedAt;
        $self['traceNumber'] = $traceNumber;

        return $self;
    }

    /**
     * The timestamp by which any administrative returns are expected to be received by. This follows the NACHA guidelines for return windows, which are: "In general, return entries must be received by the RDFI’s ACH Operator by its deposit deadline for the return entry to be made available to the ODFI no later than the opening of business on the second banking day following the Settlement Date of the original entry.".
     */
    public function withAdministrativeReturnsExpectedBy(
        \DateTimeInterface $administrativeReturnsExpectedBy
    ): self {
        $self = clone $this;
        $self['administrativeReturnsExpectedBy'] = $administrativeReturnsExpectedBy;

        return $self;
    }

    /**
     * The ACH transfer's effective date as sent to the Federal Reserve. If a specific date was configured using `preferred_effective_date`, this will match that value. Otherwise, it will be the date selected (following the specified settlement schedule) at the time the transfer was submitted.
     */
    public function withEffectiveDate(string $effectiveDate): self
    {
        $self = clone $this;
        $self['effectiveDate'] = $effectiveDate;

        return $self;
    }

    /**
     * When the transfer is expected to settle in the recipient's account. Credits may be available sooner, at the receiving banks discretion. The FedACH schedule is published [here](https://www.frbservices.org/resources/resource-centers/same-day-ach/fedach-processing-schedule.html).
     */
    public function withExpectedFundsSettlementAt(
        \DateTimeInterface $expectedFundsSettlementAt
    ): self {
        $self = clone $this;
        $self['expectedFundsSettlementAt'] = $expectedFundsSettlementAt;

        return $self;
    }

    /**
     * The settlement schedule the transfer is expected to follow. This expectation takes into account the `effective_date`, `submitted_at`, and the amount of the transfer.
     *
     * @param ExpectedSettlementSchedule|value-of<ExpectedSettlementSchedule> $expectedSettlementSchedule
     */
    public function withExpectedSettlementSchedule(
        ExpectedSettlementSchedule|string $expectedSettlementSchedule
    ): self {
        $self = clone $this;
        $self['expectedSettlementSchedule'] = $expectedSettlementSchedule;

        return $self;
    }

    /**
     * When the ACH transfer was sent to FedACH.
     */
    public function withSubmittedAt(\DateTimeInterface $submittedAt): self
    {
        $self = clone $this;
        $self['submittedAt'] = $submittedAt;

        return $self;
    }

    /**
     * A 15 digit number recorded in the Nacha file and transmitted to the receiving bank. Along with the amount, date, and originating routing number, this can be used to identify the ACH transfer at the receiving bank. ACH trace numbers are not unique, but are [used to correlate returns](https://increase.com/documentation/ach-returns#ach-returns).
     */
    public function withTraceNumber(string $traceNumber): self
    {
        $self = clone $this;
        $self['traceNumber'] = $traceNumber;

        return $self;
    }
}

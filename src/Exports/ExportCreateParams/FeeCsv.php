<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\ExportCreateParams\FeeCsv\CreatedAt;

/**
 * Options for the created export. Required if `category` is equal to `fee_csv`.
 *
 * @phpstan-import-type CreatedAtShape from \Increase\Exports\ExportCreateParams\FeeCsv\CreatedAt
 *
 * @phpstan-type FeeCsvShape = array{
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   feeStatementPeriodStart?: string|null,
 *   programID?: string|null,
 * }
 */
final class FeeCsv implements BaseModel
{
    /** @use SdkModel<FeeCsvShape> */
    use SdkModel;

    /**
     * Filter exported Fees by the time they were created. This suits historical exports across many fee statements. To get all of the Fees for a given fee statement period, we recommend using `fee_statement_period_start` instead. The time range must not include any Fees on an open fee statement.
     */
    #[Optional('created_at')]
    public ?CreatedAt $createdAt;

    /**
     * Filter exported Fees to the fee statements whose period starts on this UTC date, such as `2026-08-01`. Use this filter to export all of the Fees on a fee statement. The matching fee statements must be closed.
     */
    #[Optional('fee_statement_period_start')]
    public ?string $feeStatementPeriodStart;

    /**
     * Filter exported Fees to the specified Program.
     */
    #[Optional('program_id')]
    public ?string $programID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CreatedAt|CreatedAtShape|null $createdAt
     */
    public static function with(
        CreatedAt|array|null $createdAt = null,
        ?string $feeStatementPeriodStart = null,
        ?string $programID = null,
    ): self {
        $self = new self;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $feeStatementPeriodStart && $self['feeStatementPeriodStart'] = $feeStatementPeriodStart;
        null !== $programID && $self['programID'] = $programID;

        return $self;
    }

    /**
     * Filter exported Fees by the time they were created. This suits historical exports across many fee statements. To get all of the Fees for a given fee statement period, we recommend using `fee_statement_period_start` instead. The time range must not include any Fees on an open fee statement.
     *
     * @param CreatedAt|CreatedAtShape $createdAt
     */
    public function withCreatedAt(CreatedAt|array $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Filter exported Fees to the fee statements whose period starts on this UTC date, such as `2026-08-01`. Use this filter to export all of the Fees on a fee statement. The matching fee statements must be closed.
     */
    public function withFeeStatementPeriodStart(
        string $feeStatementPeriodStart
    ): self {
        $self = clone $this;
        $self['feeStatementPeriodStart'] = $feeStatementPeriodStart;

        return $self;
    }

    /**
     * Filter exported Fees to the specified Program.
     */
    public function withProgramID(string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

        return $self;
    }
}

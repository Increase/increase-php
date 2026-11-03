<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\Export\FeeCsv\CreatedAt;

/**
 * Details of the fee CSV export. This field will be present when the `category` is equal to `fee_csv`.
 *
 * @phpstan-import-type CreatedAtShape from \Increase\Exports\Export\FeeCsv\CreatedAt
 *
 * @phpstan-type FeeCsvShape = array{
 *   createdAt: null|CreatedAt|CreatedAtShape, feeStatementPeriodStart: string|null
 * }
 */
final class FeeCsv implements BaseModel
{
    /** @use SdkModel<FeeCsvShape> */
    use SdkModel;

    /**
     * Filter fees by their created date. The time range must not include any fees on an open fee statement.
     */
    #[Required('created_at')]
    public ?CreatedAt $createdAt;

    /**
     * Filter fees by the UTC start date of their fee statement's period, such as `2026-08-01`.
     */
    #[Required('fee_statement_period_start')]
    public ?string $feeStatementPeriodStart;

    /**
     * `new FeeCsv()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FeeCsv::with(createdAt: ..., feeStatementPeriodStart: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FeeCsv)->withCreatedAt(...)->withFeeStatementPeriodStart(...)
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
     * @param CreatedAt|CreatedAtShape|null $createdAt
     */
    public static function with(
        CreatedAt|array|null $createdAt,
        ?string $feeStatementPeriodStart
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['feeStatementPeriodStart'] = $feeStatementPeriodStart;

        return $self;
    }

    /**
     * Filter fees by their created date. The time range must not include any fees on an open fee statement.
     *
     * @param CreatedAt|CreatedAtShape|null $createdAt
     */
    public function withCreatedAt(CreatedAt|array|null $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Filter fees by the UTC start date of their fee statement's period, such as `2026-08-01`.
     */
    public function withFeeStatementPeriodStart(
        ?string $feeStatementPeriodStart
    ): self {
        $self = clone $this;
        $self['feeStatementPeriodStart'] = $feeStatementPeriodStart;

        return $self;
    }
}

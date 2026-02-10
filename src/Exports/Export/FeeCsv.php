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
 * @phpstan-type FeeCsvShape = array{createdAt: null|CreatedAt|CreatedAtShape}
 */
final class FeeCsv implements BaseModel
{
    /** @use SdkModel<FeeCsvShape> */
    use SdkModel;

    /**
     * Filter fees by their created date. The time range must not include any fees that are part of an open fee statement.
     */
    #[Required('created_at')]
    public ?CreatedAt $createdAt;

    /**
     * `new FeeCsv()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FeeCsv::with(createdAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FeeCsv)->withCreatedAt(...)
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
    public static function with(CreatedAt|array|null $createdAt): self
    {
        $self = new self;

        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Filter fees by their created date. The time range must not include any fees that are part of an open fee statement.
     *
     * @param CreatedAt|CreatedAtShape|null $createdAt
     */
    public function withCreatedAt(CreatedAt|array|null $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }
}

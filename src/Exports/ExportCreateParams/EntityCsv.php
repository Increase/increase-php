<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\ExportCreateParams\EntityCsv\Status;

/**
 * Options for the created export. Required if `category` is equal to `entity_csv`.
 *
 * @phpstan-import-type StatusShape from \Increase\Exports\ExportCreateParams\EntityCsv\Status
 *
 * @phpstan-type EntityCsvShape = array{status?: null|Status|StatusShape}
 */
final class EntityCsv implements BaseModel
{
    /** @use SdkModel<EntityCsvShape> */
    use SdkModel;

    /**
     * Entity statuses to filter by.
     */
    #[Optional]
    public ?Status $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|StatusShape|null $status
     */
    public static function with(Status|array|null $status = null): self
    {
        $self = new self;

        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Entity statuses to filter by.
     *
     * @param Status|StatusShape $status
     */
    public function withStatus(Status|array $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}

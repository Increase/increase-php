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
 *   createdAt?: null|CreatedAt|CreatedAtShape, programID?: string|null
 * }
 */
final class FeeCsv implements BaseModel
{
    /** @use SdkModel<FeeCsvShape> */
    use SdkModel;

    /**
     * Filter results by time range on the `created_at` attribute.
     */
    #[Optional('created_at')]
    public ?CreatedAt $createdAt;

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
        ?string $programID = null
    ): self {
        $self = new self;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $programID && $self['programID'] = $programID;

        return $self;
    }

    /**
     * Filter results by time range on the `created_at` attribute.
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
     * Filter exported Fees to the specified Program.
     */
    public function withProgramID(string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

        return $self;
    }
}

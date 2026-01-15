<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\ExportCreateParams\BalanceCsv\CreatedAt;

/**
 * Options for the created export. Required if `category` is equal to `balance_csv`.
 *
 * @phpstan-import-type CreatedAtShape from \Increase\Exports\ExportCreateParams\BalanceCsv\CreatedAt
 *
 * @phpstan-type BalanceCsvShape = array{
 *   accountID?: string|null,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   programID?: string|null,
 * }
 */
final class BalanceCsv implements BaseModel
{
    /** @use SdkModel<BalanceCsvShape> */
    use SdkModel;

    /**
     * Filter exported Transactions to the specified Account.
     */
    #[Optional('account_id')]
    public ?string $accountID;

    /**
     * Filter results by time range on the `created_at` attribute.
     */
    #[Optional('created_at')]
    public ?CreatedAt $createdAt;

    /**
     * Filter exported Transactions to the specified Program.
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
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $programID = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $programID && $self['programID'] = $programID;

        return $self;
    }

    /**
     * Filter exported Transactions to the specified Account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

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
     * Filter exported Transactions to the specified Program.
     */
    public function withProgramID(string $programID): self
    {
        $self = clone $this;
        $self['programID'] = $programID;

        return $self;
    }
}

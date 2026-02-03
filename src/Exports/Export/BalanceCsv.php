<?php

declare(strict_types=1);

namespace Increase\Exports\Export;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\Export\BalanceCsv\CreatedAt;

/**
 * Details of the balance CSV export. This field will be present when the `category` is equal to `balance_csv`.
 *
 * @phpstan-import-type CreatedAtShape from \Increase\Exports\Export\BalanceCsv\CreatedAt
 *
 * @phpstan-type BalanceCsvShape = array{
 *   accountID: string|null, createdAt: null|CreatedAt|CreatedAtShape
 * }
 */
final class BalanceCsv implements BaseModel
{
    /** @use SdkModel<BalanceCsvShape> */
    use SdkModel;

    /**
     * Filter results by Account.
     */
    #[Required('account_id')]
    public ?string $accountID;

    /**
     * Filter balances by their created date.
     */
    #[Required('created_at')]
    public ?CreatedAt $createdAt;

    /**
     * `new BalanceCsv()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BalanceCsv::with(accountID: ..., createdAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BalanceCsv)->withAccountID(...)->withCreatedAt(...)
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
        ?string $accountID,
        CreatedAt|array|null $createdAt
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Filter results by Account.
     */
    public function withAccountID(?string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Filter balances by their created date.
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

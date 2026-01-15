<?php

declare(strict_types=1);

namespace Increase\Exports\ExportCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Exports\ExportCreateParams\AccountStatementOfx\CreatedAt;

/**
 * Options for the created export. Required if `category` is equal to `account_statement_ofx`.
 *
 * @phpstan-import-type CreatedAtShape from \Increase\Exports\ExportCreateParams\AccountStatementOfx\CreatedAt
 *
 * @phpstan-type AccountStatementOfxShape = array{
 *   accountID: string, createdAt?: null|CreatedAt|CreatedAtShape
 * }
 */
final class AccountStatementOfx implements BaseModel
{
    /** @use SdkModel<AccountStatementOfxShape> */
    use SdkModel;

    /**
     * The Account to create a statement for.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * Filter results by time range on the `created_at` attribute.
     */
    #[Optional('created_at')]
    public ?CreatedAt $createdAt;

    /**
     * `new AccountStatementOfx()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountStatementOfx::with(accountID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountStatementOfx)->withAccountID(...)
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
        string $accountID,
        CreatedAt|array|null $createdAt = null
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;

        null !== $createdAt && $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The Account to create a statement for.
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
}

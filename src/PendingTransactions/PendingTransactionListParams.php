<?php

declare(strict_types=1);

namespace Increase\PendingTransactions;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\PendingTransactions\PendingTransactionListParams\Category;
use Increase\PendingTransactions\PendingTransactionListParams\CreatedAt;
use Increase\PendingTransactions\PendingTransactionListParams\Status;

/**
 * List Pending Transactions.
 *
 * @see Increase\Services\PendingTransactionsService::list()
 *
 * @phpstan-import-type CategoryShape from \Increase\PendingTransactions\PendingTransactionListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\PendingTransactions\PendingTransactionListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\PendingTransactions\PendingTransactionListParams\Status
 *
 * @phpstan-type PendingTransactionListParamsShape = array{
 *   accountID?: string|null,
 *   category?: null|Category|CategoryShape,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   routeID?: string|null,
 *   status?: null|Status|StatusShape,
 * }
 */
final class PendingTransactionListParams implements BaseModel
{
    /** @use SdkModel<PendingTransactionListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter pending transactions to those belonging to the specified Account.
     */
    #[Optional]
    public ?string $accountID;

    #[Optional]
    public ?Category $category;

    #[Optional]
    public ?CreatedAt $createdAt;

    /**
     * Return the page of entries after this one.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter pending transactions to those belonging to the specified Route.
     */
    #[Optional]
    public ?string $routeID;

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
     * @param Category|CategoryShape|null $category
     * @param CreatedAt|CreatedAtShape|null $createdAt
     * @param Status|StatusShape|null $status
     */
    public static function with(
        ?string $accountID = null,
        Category|array|null $category = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        ?string $routeID = null,
        Status|array|null $status = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $category && $self['category'] = $category;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $routeID && $self['routeID'] = $routeID;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Filter pending transactions to those belonging to the specified Account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * @param Category|CategoryShape $category
     */
    public function withCategory(Category|array $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * @param CreatedAt|CreatedAtShape $createdAt
     */
    public function withCreatedAt(CreatedAt|array $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Return the page of entries after this one.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter pending transactions to those belonging to the specified Route.
     */
    public function withRouteID(string $routeID): self
    {
        $self = clone $this;
        $self['routeID'] = $routeID;

        return $self;
    }

    /**
     * @param Status|StatusShape $status
     */
    public function withStatus(Status|array $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}

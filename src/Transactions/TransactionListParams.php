<?php

declare(strict_types=1);

namespace Increase\Transactions;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\TransactionListParams\Category;
use Increase\Transactions\TransactionListParams\CreatedAt;

/**
 * List Transactions.
 *
 * @see Increase\Services\TransactionsService::list()
 *
 * @phpstan-import-type CategoryShape from \Increase\Transactions\TransactionListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\Transactions\TransactionListParams\CreatedAt
 *
 * @phpstan-type TransactionListParamsShape = array{
 *   accountID?: string|null,
 *   category?: null|Category|CategoryShape,
 *   createdAt?: null|CreatedAt|CreatedAtShape,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   routeID?: string|null,
 * }
 */
final class TransactionListParams implements BaseModel
{
    /** @use SdkModel<TransactionListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter Transactions for those belonging to the specified Account.
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
     * Filter Transactions for those belonging to the specified route. This could be a Card ID or an Account Number ID.
     */
    #[Optional]
    public ?string $routeID;

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
     */
    public static function with(
        ?string $accountID = null,
        Category|array|null $category = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        ?string $routeID = null,
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $category && $self['category'] = $category;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $routeID && $self['routeID'] = $routeID;

        return $self;
    }

    /**
     * Filter Transactions for those belonging to the specified Account.
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
     * Filter Transactions for those belonging to the specified route. This could be a Card ID or an Account Number ID.
     */
    public function withRouteID(string $routeID): self
    {
        $self = clone $this;
        $self['routeID'] = $routeID;

        return $self;
    }
}

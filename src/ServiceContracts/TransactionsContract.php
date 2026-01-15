<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;
use Increase\Transactions\Transaction;
use Increase\Transactions\TransactionListParams\Category;
use Increase\Transactions\TransactionListParams\CreatedAt;

/**
 * @phpstan-import-type CategoryShape from \Increase\Transactions\TransactionListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\Transactions\TransactionListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface TransactionsContract
{
    /**
     * @api
     *
     * @param string $transactionID the identifier of the Transaction to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $transactionID,
        RequestOptions|array|null $requestOptions = null
    ): Transaction;

    /**
     * @api
     *
     * @param string $accountID filter Transactions for those belonging to the specified Account
     * @param Category|CategoryShape $category
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param string $routeID Filter Transactions for those belonging to the specified route. This could be a Card ID or an Account Number ID.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<Transaction>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        Category|array|null $category = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        ?string $routeID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}

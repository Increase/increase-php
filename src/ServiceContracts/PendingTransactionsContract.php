<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\PendingTransactions\PendingTransaction;
use Increase\PendingTransactions\PendingTransactionListParams\Category;
use Increase\PendingTransactions\PendingTransactionListParams\CreatedAt;
use Increase\PendingTransactions\PendingTransactionListParams\Status;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CategoryShape from \Increase\PendingTransactions\PendingTransactionListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\PendingTransactions\PendingTransactionListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\PendingTransactions\PendingTransactionListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface PendingTransactionsContract
{
    /**
     * @api
     *
     * @param string $accountID the Account to place the hold on
     * @param int $amount The amount to hold in the minor unit of the account's currency. For dollars, for example, this is cents. This should be a negative amount - to hold $1.00 from the account, you would pass -100.
     * @param string $description the description you choose to give the hold
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        int $amount,
        ?string $description = null,
        RequestOptions|array|null $requestOptions = null,
    ): PendingTransaction;

    /**
     * @api
     *
     * @param string $pendingTransactionID the identifier of the Pending Transaction
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $pendingTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): PendingTransaction;

    /**
     * @api
     *
     * @param string $accountID filter pending transactions to those belonging to the specified Account
     * @param Category|CategoryShape $category
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param string $routeID filter pending transactions to those belonging to the specified Route
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<PendingTransaction>
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
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;

    /**
     * @api
     *
     * @param string $pendingTransactionID the identifier of the Pending Transaction to release
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function release(
        string $pendingTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): PendingTransaction;
}

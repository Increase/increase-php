<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\PendingTransactions\PendingTransaction;
use Increase\PendingTransactions\PendingTransactionListParams\Category;
use Increase\PendingTransactions\PendingTransactionListParams\CreatedAt;
use Increase\PendingTransactions\PendingTransactionListParams\Status;
use Increase\RequestOptions;
use Increase\ServiceContracts\PendingTransactionsContract;

/**
 * @phpstan-import-type CategoryShape from \Increase\PendingTransactions\PendingTransactionListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\PendingTransactions\PendingTransactionListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\PendingTransactions\PendingTransactionListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class PendingTransactionsService implements PendingTransactionsContract
{
    /**
     * @api
     */
    public PendingTransactionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PendingTransactionsRawService($client);
    }

    /**
     * @api
     *
     * Creates a pending transaction on an account. This can be useful to hold funds for an external payment or known future transaction outside of Increase (only negative amounts are supported). The resulting Pending Transaction will have a `category` of `user_initiated_hold` and can be released via the API to unlock the held funds.
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
    ): PendingTransaction {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'amount' => $amount,
                'description' => $description,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Pending Transaction
     *
     * @param string $pendingTransactionID the identifier of the Pending Transaction
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $pendingTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): PendingTransaction {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($pendingTransactionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Pending Transactions
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
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'category' => $category,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'limit' => $limit,
                'routeID' => $routeID,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Release a Pending Transaction you had previously created. The Pending Transaction must have a `category` of `user_initiated_hold` and a `status` of `pending`. This will unlock the held funds and mark the Pending Transaction as complete.
     *
     * @param string $pendingTransactionID the identifier of the Pending Transaction to release
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function release(
        string $pendingTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): PendingTransaction {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->release($pendingTransactionID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

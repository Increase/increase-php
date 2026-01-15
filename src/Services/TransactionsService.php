<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\TransactionsContract;
use Increase\Transactions\Transaction;
use Increase\Transactions\TransactionListParams\Category;
use Increase\Transactions\TransactionListParams\CreatedAt;

/**
 * @phpstan-import-type CategoryShape from \Increase\Transactions\TransactionListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\Transactions\TransactionListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class TransactionsService implements TransactionsContract
{
    /**
     * @api
     */
    public TransactionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TransactionsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Transaction
     *
     * @param string $transactionID the identifier of the Transaction to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $transactionID,
        RequestOptions|array|null $requestOptions = null
    ): Transaction {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($transactionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Transactions
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
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'category' => $category,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'limit' => $limit,
                'routeID' => $routeID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

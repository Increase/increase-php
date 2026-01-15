<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\DeclinedTransactions\DeclinedTransaction;
use Increase\DeclinedTransactions\DeclinedTransactionListParams\Category;
use Increase\DeclinedTransactions\DeclinedTransactionListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\DeclinedTransactionsContract;

/**
 * @phpstan-import-type CategoryShape from \Increase\DeclinedTransactions\DeclinedTransactionListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\DeclinedTransactions\DeclinedTransactionListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class DeclinedTransactionsService implements DeclinedTransactionsContract
{
    /**
     * @api
     */
    public DeclinedTransactionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DeclinedTransactionsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Declined Transaction
     *
     * @param string $declinedTransactionID the identifier of the Declined Transaction
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $declinedTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): DeclinedTransaction {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($declinedTransactionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Declined Transactions
     *
     * @param string $accountID filter Declined Transactions to ones belonging to the specified Account
     * @param Category|CategoryShape $category
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param string $routeID filter Declined Transactions to those belonging to the specified route
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<DeclinedTransaction>
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

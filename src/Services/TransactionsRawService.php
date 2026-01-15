<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\TransactionsRawContract;
use Increase\Transactions\Transaction;
use Increase\Transactions\TransactionListParams;
use Increase\Transactions\TransactionListParams\Category;
use Increase\Transactions\TransactionListParams\CreatedAt;

/**
 * @phpstan-import-type CategoryShape from \Increase\Transactions\TransactionListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\Transactions\TransactionListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class TransactionsRawService implements TransactionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Transaction
     *
     * @param string $transactionID the identifier of the Transaction to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Transaction>
     *
     * @throws APIException
     */
    public function retrieve(
        string $transactionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['transactions/%1$s', $transactionID],
            options: $requestOptions,
            convert: Transaction::class,
        );
    }

    /**
     * @api
     *
     * List Transactions
     *
     * @param array{
     *   accountID?: string,
     *   category?: Category|CategoryShape,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     *   routeID?: string,
     * }|TransactionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Transaction>>
     *
     * @throws APIException
     */
    public function list(
        array|TransactionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TransactionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'transactions',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'routeID' => 'route_id',
                ],
            ),
            options: $options,
            convert: Transaction::class,
            page: Page::class,
        );
    }
}

<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\PendingTransactions\PendingTransaction;
use Increase\PendingTransactions\PendingTransactionCreateParams;
use Increase\PendingTransactions\PendingTransactionListParams;
use Increase\PendingTransactions\PendingTransactionListParams\Category;
use Increase\PendingTransactions\PendingTransactionListParams\CreatedAt;
use Increase\PendingTransactions\PendingTransactionListParams\Status;
use Increase\RequestOptions;
use Increase\ServiceContracts\PendingTransactionsRawContract;

/**
 * @phpstan-import-type CategoryShape from \Increase\PendingTransactions\PendingTransactionListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\PendingTransactions\PendingTransactionListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\PendingTransactions\PendingTransactionListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class PendingTransactionsRawService implements PendingTransactionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a pending transaction on an account. This can be useful to hold funds for an external payment or known future transaction outside of Increase (only negative amounts are supported). The resulting Pending Transaction will have a `category` of `user_initiated_hold` and can be released via the API to unlock the held funds.
     *
     * @param array{
     *   accountID: string, amount: int, description?: string
     * }|PendingTransactionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PendingTransaction>
     *
     * @throws APIException
     */
    public function create(
        array|PendingTransactionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PendingTransactionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'pending_transactions',
            body: (object) $parsed,
            options: $options,
            convert: PendingTransaction::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Pending Transaction
     *
     * @param string $pendingTransactionID the identifier of the Pending Transaction
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PendingTransaction>
     *
     * @throws APIException
     */
    public function retrieve(
        string $pendingTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['pending_transactions/%1$s', $pendingTransactionID],
            options: $requestOptions,
            convert: PendingTransaction::class,
        );
    }

    /**
     * @api
     *
     * List Pending Transactions
     *
     * @param array{
     *   accountID?: string,
     *   category?: Category|CategoryShape,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     *   routeID?: string,
     *   status?: Status|StatusShape,
     * }|PendingTransactionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<PendingTransaction>>
     *
     * @throws APIException
     */
    public function list(
        array|PendingTransactionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PendingTransactionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'pending_transactions',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'routeID' => 'route_id',
                ],
            ),
            options: $options,
            convert: PendingTransaction::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Release a Pending Transaction you had previously created. The Pending Transaction must have a `category` of `user_initiated_hold` and a `status` of `pending`. This will unlock the held funds and mark the Pending Transaction as complete.
     *
     * @param string $pendingTransactionID the identifier of the Pending Transaction to release
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PendingTransaction>
     *
     * @throws APIException
     */
    public function release(
        string $pendingTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['pending_transactions/%1$s/release', $pendingTransactionID],
            options: $requestOptions,
            convert: PendingTransaction::class,
        );
    }
}

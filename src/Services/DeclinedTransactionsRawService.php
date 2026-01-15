<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\DeclinedTransactions\DeclinedTransaction;
use Increase\DeclinedTransactions\DeclinedTransactionListParams;
use Increase\DeclinedTransactions\DeclinedTransactionListParams\Category;
use Increase\DeclinedTransactions\DeclinedTransactionListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\DeclinedTransactionsRawContract;

/**
 * @phpstan-import-type CategoryShape from \Increase\DeclinedTransactions\DeclinedTransactionListParams\Category
 * @phpstan-import-type CreatedAtShape from \Increase\DeclinedTransactions\DeclinedTransactionListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class DeclinedTransactionsRawService implements DeclinedTransactionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Declined Transaction
     *
     * @param string $declinedTransactionID the identifier of the Declined Transaction
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeclinedTransaction>
     *
     * @throws APIException
     */
    public function retrieve(
        string $declinedTransactionID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['declined_transactions/%1$s', $declinedTransactionID],
            options: $requestOptions,
            convert: DeclinedTransaction::class,
        );
    }

    /**
     * @api
     *
     * List Declined Transactions
     *
     * @param array{
     *   accountID?: string,
     *   category?: Category|CategoryShape,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     *   routeID?: string,
     * }|DeclinedTransactionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<DeclinedTransaction>>
     *
     * @throws APIException
     */
    public function list(
        array|DeclinedTransactionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DeclinedTransactionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'declined_transactions',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'routeID' => 'route_id',
                ],
            ),
            options: $options,
            convert: DeclinedTransaction::class,
            page: Page::class,
        );
    }
}

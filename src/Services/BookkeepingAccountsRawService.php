<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\BookkeepingAccounts\BookkeepingAccount;
use Increase\BookkeepingAccounts\BookkeepingAccountBalanceParams;
use Increase\BookkeepingAccounts\BookkeepingAccountCreateParams;
use Increase\BookkeepingAccounts\BookkeepingAccountCreateParams\ComplianceCategory;
use Increase\BookkeepingAccounts\BookkeepingAccountListParams;
use Increase\BookkeepingAccounts\BookkeepingAccountUpdateParams;
use Increase\BookkeepingAccounts\BookkeepingBalanceLookup;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\BookkeepingAccountsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class BookkeepingAccountsRawService implements BookkeepingAccountsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Bookkeeping Account
     *
     * @param array{
     *   name: string,
     *   accountID?: string,
     *   complianceCategory?: ComplianceCategory|value-of<ComplianceCategory>,
     *   entityID?: string,
     * }|BookkeepingAccountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BookkeepingAccount>
     *
     * @throws APIException
     */
    public function create(
        array|BookkeepingAccountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BookkeepingAccountCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'bookkeeping_accounts',
            body: (object) $parsed,
            options: $options,
            convert: BookkeepingAccount::class,
        );
    }

    /**
     * @api
     *
     * Update a Bookkeeping Account
     *
     * @param string $bookkeepingAccountID the bookkeeping account you would like to update
     * @param array{name: string}|BookkeepingAccountUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BookkeepingAccount>
     *
     * @throws APIException
     */
    public function update(
        string $bookkeepingAccountID,
        array|BookkeepingAccountUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BookkeepingAccountUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['bookkeeping_accounts/%1$s', $bookkeepingAccountID],
            body: (object) $parsed,
            options: $options,
            convert: BookkeepingAccount::class,
        );
    }

    /**
     * @api
     *
     * List Bookkeeping Accounts
     *
     * @param array{
     *   cursor?: string, idempotencyKey?: string, limit?: int
     * }|BookkeepingAccountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<BookkeepingAccount>>
     *
     * @throws APIException
     */
    public function list(
        array|BookkeepingAccountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BookkeepingAccountListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'bookkeeping_accounts',
            query: Util::array_transform_keys(
                $parsed,
                ['idempotencyKey' => 'idempotency_key']
            ),
            options: $options,
            convert: BookkeepingAccount::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Bookkeeping Account Balance
     *
     * @param string $bookkeepingAccountID the identifier of the Bookkeeping Account to retrieve
     * @param array{
     *   atTime?: \DateTimeInterface
     * }|BookkeepingAccountBalanceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BookkeepingBalanceLookup>
     *
     * @throws APIException
     */
    public function balance(
        string $bookkeepingAccountID,
        array|BookkeepingAccountBalanceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BookkeepingAccountBalanceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['bookkeeping_accounts/%1$s/balance', $bookkeepingAccountID],
            query: Util::array_transform_keys($parsed, ['atTime' => 'at_time']),
            options: $options,
            convert: BookkeepingBalanceLookup::class,
        );
    }
}

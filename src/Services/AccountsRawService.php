<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Accounts\Account;
use Increase\Accounts\AccountBalanceParams;
use Increase\Accounts\AccountCreateParams;
use Increase\Accounts\AccountListParams;
use Increase\Accounts\AccountListParams\CreatedAt;
use Increase\Accounts\AccountListParams\Status;
use Increase\Accounts\AccountUpdateParams;
use Increase\Accounts\BalanceLookup;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\AccountsRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\Accounts\AccountListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\Accounts\AccountListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class AccountsRawService implements AccountsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an Account
     *
     * @param array{
     *   name: string,
     *   entityID?: string,
     *   informationalEntityID?: string,
     *   programID?: string,
     * }|AccountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Account>
     *
     * @throws APIException
     */
    public function create(
        array|AccountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'accounts',
            body: (object) $parsed,
            options: $options,
            convert: Account::class,
        );
    }

    /**
     * @api
     *
     * Retrieve an Account
     *
     * @param string $accountID the identifier of the Account to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Account>
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['accounts/%1$s', $accountID],
            options: $requestOptions,
            convert: Account::class,
        );
    }

    /**
     * @api
     *
     * Update an Account
     *
     * @param string $accountID the identifier of the Account to update
     * @param array{name?: string}|AccountUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Account>
     *
     * @throws APIException
     */
    public function update(
        string $accountID,
        array|AccountUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['accounts/%1$s', $accountID],
            body: (object) $parsed,
            options: $options,
            convert: Account::class,
        );
    }

    /**
     * @api
     *
     * List Accounts
     *
     * @param array{
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   entityID?: string,
     *   idempotencyKey?: string,
     *   informationalEntityID?: string,
     *   limit?: int,
     *   programID?: string,
     *   status?: Status|StatusShape,
     * }|AccountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Account>>
     *
     * @throws APIException
     */
    public function list(
        array|AccountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'accounts',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'createdAt' => 'created_at',
                    'entityID' => 'entity_id',
                    'idempotencyKey' => 'idempotency_key',
                    'informationalEntityID' => 'informational_entity_id',
                    'programID' => 'program_id',
                ],
            ),
            options: $options,
            convert: Account::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Retrieve the current and available balances for an account in minor units of the account's currency. Learn more about [account balances](/documentation/balance).
     *
     * @param string $accountID the identifier of the Account to retrieve
     * @param array{atTime?: \DateTimeInterface}|AccountBalanceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BalanceLookup>
     *
     * @throws APIException
     */
    public function balance(
        string $accountID,
        array|AccountBalanceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountBalanceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['accounts/%1$s/balance', $accountID],
            query: Util::array_transform_keys($parsed, ['atTime' => 'at_time']),
            options: $options,
            convert: BalanceLookup::class,
        );
    }

    /**
     * @api
     *
     * Close an Account
     *
     * @param string $accountID The identifier of the Account to close. The account must have a zero balance.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Account>
     *
     * @throws APIException
     */
    public function close(
        string $accountID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['accounts/%1$s/close', $accountID],
            options: $requestOptions,
            convert: Account::class,
        );
    }
}

<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Accounts\Account;
use Increase\Accounts\AccountBalanceParams;
use Increase\Accounts\AccountCreateParams;
use Increase\Accounts\AccountListParams;
use Increase\Accounts\AccountUpdateParams;
use Increase\Accounts\BalanceLookup;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AccountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Account>
     *
     * @throws APIException
     */
    public function create(
        array|AccountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $accountID the identifier of the Account to update
     * @param array<string,mixed>|AccountUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AccountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Account>>
     *
     * @throws APIException
     */
    public function list(
        array|AccountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $accountID the identifier of the Account to retrieve
     * @param array<string,mixed>|AccountBalanceParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}

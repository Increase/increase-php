<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\BookkeepingAccounts\BookkeepingAccount;
use Increase\BookkeepingAccounts\BookkeepingAccountBalanceParams;
use Increase\BookkeepingAccounts\BookkeepingAccountCreateParams;
use Increase\BookkeepingAccounts\BookkeepingAccountListParams;
use Increase\BookkeepingAccounts\BookkeepingAccountUpdateParams;
use Increase\BookkeepingAccounts\BookkeepingBalanceLookup;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface BookkeepingAccountsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BookkeepingAccountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BookkeepingAccount>
     *
     * @throws APIException
     */
    public function create(
        array|BookkeepingAccountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $bookkeepingAccountID the bookkeeping account you would like to update
     * @param array<string,mixed>|BookkeepingAccountUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BookkeepingAccountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<BookkeepingAccount>>
     *
     * @throws APIException
     */
    public function list(
        array|BookkeepingAccountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $bookkeepingAccountID the identifier of the Bookkeeping Account to retrieve
     * @param array<string,mixed>|BookkeepingAccountBalanceParams $params
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
    ): BaseResponse;
}

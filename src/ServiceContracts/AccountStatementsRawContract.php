<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\AccountStatements\AccountStatement;
use Increase\AccountStatements\AccountStatementListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountStatementsRawContract
{
    /**
     * @api
     *
     * @param string $accountStatementID the identifier of the Account Statement to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountStatement>
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountStatementID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AccountStatementListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<AccountStatement>>
     *
     * @throws APIException
     */
    public function list(
        array|AccountStatementListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

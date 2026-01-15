<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\AccountStatements\AccountStatement;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\AccountStatements\AccountStatementCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountStatementsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AccountStatementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountStatement>
     *
     * @throws APIException
     */
    public function create(
        array|AccountStatementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

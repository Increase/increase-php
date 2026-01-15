<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\AccountStatements\AccountStatement;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountStatementsContract
{
    /**
     * @api
     *
     * @param string $accountID the identifier of the Account the statement is for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        RequestOptions|array|null $requestOptions = null
    ): AccountStatement;
}

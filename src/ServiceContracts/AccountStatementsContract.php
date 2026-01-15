<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\AccountStatements\AccountStatement;
use Increase\AccountStatements\AccountStatementListParams\StatementPeriodStart;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type StatementPeriodStartShape from \Increase\AccountStatements\AccountStatementListParams\StatementPeriodStart
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountStatementsContract
{
    /**
     * @api
     *
     * @param string $accountStatementID the identifier of the Account Statement to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountStatementID,
        RequestOptions|array|null $requestOptions = null,
    ): AccountStatement;

    /**
     * @api
     *
     * @param string $accountID filter Account Statements to those belonging to the specified Account
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param StatementPeriodStart|StatementPeriodStartShape $statementPeriodStart
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<AccountStatement>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ?string $cursor = null,
        ?int $limit = null,
        StatementPeriodStart|array|null $statementPeriodStart = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}

<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\AccountStatements\AccountStatement;
use Increase\AccountStatements\AccountStatementListParams\StatementPeriodStart;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\AccountStatementsContract;

/**
 * @phpstan-import-type StatementPeriodStartShape from \Increase\AccountStatements\AccountStatementListParams\StatementPeriodStart
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class AccountStatementsService implements AccountStatementsContract
{
    /**
     * @api
     */
    public AccountStatementsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AccountStatementsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an Account Statement
     *
     * @param string $accountStatementID the identifier of the Account Statement to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountStatementID,
        RequestOptions|array|null $requestOptions = null
    ): AccountStatement {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($accountStatementID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Account Statements
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
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'cursor' => $cursor,
                'limit' => $limit,
                'statementPeriodStart' => $statementPeriodStart,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

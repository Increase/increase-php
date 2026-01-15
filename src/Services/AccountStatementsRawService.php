<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\AccountStatements\AccountStatement;
use Increase\AccountStatements\AccountStatementListParams;
use Increase\AccountStatements\AccountStatementListParams\StatementPeriodStart;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\AccountStatementsRawContract;

/**
 * @phpstan-import-type StatementPeriodStartShape from \Increase\AccountStatements\AccountStatementListParams\StatementPeriodStart
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class AccountStatementsRawService implements AccountStatementsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve an Account Statement
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
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['account_statements/%1$s', $accountStatementID],
            options: $requestOptions,
            convert: AccountStatement::class,
        );
    }

    /**
     * @api
     *
     * List Account Statements
     *
     * @param array{
     *   accountID?: string,
     *   cursor?: string,
     *   limit?: int,
     *   statementPeriodStart?: StatementPeriodStart|StatementPeriodStartShape,
     * }|AccountStatementListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<AccountStatement>>
     *
     * @throws APIException
     */
    public function list(
        array|AccountStatementListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountStatementListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'account_statements',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'statementPeriodStart' => 'statement_period_start',
                ],
            ),
            options: $options,
            convert: AccountStatement::class,
            page: Page::class,
        );
    }
}

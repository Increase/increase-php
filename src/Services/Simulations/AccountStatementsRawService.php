<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\AccountStatements\AccountStatement;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\AccountStatementsRawContract;
use Increase\Simulations\AccountStatements\AccountStatementCreateParams;

/**
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
     * Simulates an [Account Statement](#account-statements) being created for an account. In production, Account Statements are generated once per month.
     *
     * @param array{accountID: string}|AccountStatementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountStatement>
     *
     * @throws APIException
     */
    public function create(
        array|AccountStatementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountStatementCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/account_statements',
            body: (object) $parsed,
            options: $options,
            convert: AccountStatement::class,
        );
    }
}

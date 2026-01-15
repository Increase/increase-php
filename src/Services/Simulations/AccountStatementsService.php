<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\AccountStatements\AccountStatement;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\AccountStatementsContract;

/**
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
     * Simulates an [Account Statement](#account-statements) being created for an account. In production, Account Statements are generated once per month.
     *
     * @param string $accountID the identifier of the Account the statement is for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        RequestOptions|array|null $requestOptions = null
    ): AccountStatement {
        $params = Util::removeNulls(['accountID' => $accountID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

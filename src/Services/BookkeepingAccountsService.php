<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\BookkeepingAccounts\BookkeepingAccount;
use Increase\BookkeepingAccounts\BookkeepingAccountCreateParams\ComplianceCategory;
use Increase\BookkeepingAccounts\BookkeepingBalanceLookup;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\BookkeepingAccountsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class BookkeepingAccountsService implements BookkeepingAccountsContract
{
    /**
     * @api
     */
    public BookkeepingAccountsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BookkeepingAccountsRawService($client);
    }

    /**
     * @api
     *
     * Create a Bookkeeping Account
     *
     * @param string $name the name you choose for the account
     * @param string $accountID the account, if `compliance_category` is `commingled_cash`
     * @param ComplianceCategory|value-of<ComplianceCategory> $complianceCategory the account compliance category
     * @param string $entityID the entity, if `compliance_category` is `customer_balance`
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $accountID = null,
        ComplianceCategory|string|null $complianceCategory = null,
        ?string $entityID = null,
        RequestOptions|array|null $requestOptions = null,
    ): BookkeepingAccount {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'accountID' => $accountID,
                'complianceCategory' => $complianceCategory,
                'entityID' => $entityID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a Bookkeeping Account
     *
     * @param string $bookkeepingAccountID the bookkeeping account you would like to update
     * @param string $name the name you choose for the account
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $bookkeepingAccountID,
        string $name,
        RequestOptions|array|null $requestOptions = null,
    ): BookkeepingAccount {
        $params = Util::removeNulls(['name' => $name]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($bookkeepingAccountID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Bookkeeping Accounts
     *
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<BookkeepingAccount>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Bookkeeping Account Balance
     *
     * @param string $bookkeepingAccountID the identifier of the Bookkeeping Account to retrieve
     * @param \DateTimeInterface $atTime The moment to query the balance at. If not set, returns the current balances.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function balance(
        string $bookkeepingAccountID,
        ?\DateTimeInterface $atTime = null,
        RequestOptions|array|null $requestOptions = null,
    ): BookkeepingBalanceLookup {
        $params = Util::removeNulls(['atTime' => $atTime]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->balance($bookkeepingAccountID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

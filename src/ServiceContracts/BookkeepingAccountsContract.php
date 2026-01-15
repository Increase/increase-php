<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\BookkeepingAccounts\BookkeepingAccount;
use Increase\BookkeepingAccounts\BookkeepingAccountCreateParams\ComplianceCategory;
use Increase\BookkeepingAccounts\BookkeepingBalanceLookup;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface BookkeepingAccountsContract
{
    /**
     * @api
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
    ): BookkeepingAccount;

    /**
     * @api
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
    ): BookkeepingAccount;

    /**
     * @api
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
    ): Page;

    /**
     * @api
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
    ): BookkeepingBalanceLookup;
}

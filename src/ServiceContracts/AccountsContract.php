<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Accounts\Account;
use Increase\Accounts\AccountListParams\CreatedAt;
use Increase\Accounts\AccountListParams\Status;
use Increase\Accounts\BalanceLookup;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\Accounts\AccountListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\Accounts\AccountListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountsContract
{
    /**
     * @api
     *
     * @param string $name the name you choose for the Account
     * @param string $entityID the identifier for the Entity that will own the Account
     * @param string $informationalEntityID The identifier of an Entity that, while not owning the Account, is associated with its activity. This is generally the beneficiary of the funds.
     * @param string $programID The identifier for the Program that this Account falls under. Required if you operate more than one Program.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $entityID = null,
        ?string $informationalEntityID = null,
        ?string $programID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Account;

    /**
     * @api
     *
     * @param string $accountID the identifier of the Account to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountID,
        RequestOptions|array|null $requestOptions = null
    ): Account;

    /**
     * @api
     *
     * @param string $accountID the identifier of the Account to update
     * @param int $creditLimit the new credit limit of the Account, if and only if the Account is a loan account
     * @param string $name the new name of the Account
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $accountID,
        ?int $creditLimit = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): Account;

    /**
     * @api
     *
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $entityID filter Accounts for those belonging to the specified Entity
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param string $informationalEntityID filter Accounts for those belonging to the specified Entity as informational
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param string $programID filter Accounts for those in a specific Program
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<Account>
     *
     * @throws APIException
     */
    public function list(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $entityID = null,
        ?string $idempotencyKey = null,
        ?string $informationalEntityID = null,
        ?int $limit = null,
        ?string $programID = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;

    /**
     * @api
     *
     * @param string $accountID the identifier of the Account to retrieve
     * @param \DateTimeInterface $atTime The moment to query the balance at. If not set, returns the current balances.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function balance(
        string $accountID,
        ?\DateTimeInterface $atTime = null,
        RequestOptions|array|null $requestOptions = null,
    ): BalanceLookup;

    /**
     * @api
     *
     * @param string $accountID The identifier of the Account to close. The account must have a zero balance.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function close(
        string $accountID,
        RequestOptions|array|null $requestOptions = null
    ): Account;
}

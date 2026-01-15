<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\ExternalAccounts\ExternalAccount;
use Increase\ExternalAccounts\ExternalAccountCreateParams\AccountHolder;
use Increase\ExternalAccounts\ExternalAccountCreateParams\Funding;
use Increase\ExternalAccounts\ExternalAccountUpdateParams\Status;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type StatusShape from \Increase\ExternalAccounts\ExternalAccountListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ExternalAccountsContract
{
    /**
     * @api
     *
     * @param string $accountNumber the account number for the destination account
     * @param string $description the name you choose for the Account
     * @param string $routingNumber the American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account
     * @param AccountHolder|value-of<AccountHolder> $accountHolder the type of entity that owns the External Account
     * @param Funding|value-of<Funding> $funding The type of the destination account. Defaults to `checking`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountNumber,
        string $description,
        string $routingNumber,
        AccountHolder|string|null $accountHolder = null,
        Funding|string|null $funding = null,
        RequestOptions|array|null $requestOptions = null,
    ): ExternalAccount;

    /**
     * @api
     *
     * @param string $externalAccountID the identifier of the External Account
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $externalAccountID,
        RequestOptions|array|null $requestOptions = null,
    ): ExternalAccount;

    /**
     * @api
     *
     * @param string $externalAccountID the external account identifier
     * @param \Increase\ExternalAccounts\ExternalAccountUpdateParams\AccountHolder|value-of<\Increase\ExternalAccounts\ExternalAccountUpdateParams\AccountHolder> $accountHolder the type of entity that owns the External Account
     * @param string $description the description you choose to give the external account
     * @param \Increase\ExternalAccounts\ExternalAccountUpdateParams\Funding|value-of<\Increase\ExternalAccounts\ExternalAccountUpdateParams\Funding> $funding the funding type of the External Account
     * @param Status|value-of<Status> $status the status of the External Account
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $externalAccountID,
        \Increase\ExternalAccounts\ExternalAccountUpdateParams\AccountHolder|string|null $accountHolder = null,
        ?string $description = null,
        \Increase\ExternalAccounts\ExternalAccountUpdateParams\Funding|string|null $funding = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): ExternalAccount;

    /**
     * @api
     *
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param string $routingNumber filter External Accounts to those with the specified Routing Number
     * @param \Increase\ExternalAccounts\ExternalAccountListParams\Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<ExternalAccount>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        ?string $routingNumber = null,
        \Increase\ExternalAccounts\ExternalAccountListParams\Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}

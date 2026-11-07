<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\AccountNumbers\AccountNumber;
use Increase\AccountNumbers\AccountNumberCreateParams\InboundACHDebits;
use Increase\AccountNumbers\AccountNumberCreateParams\UnregisteredInboundChecks;
use Increase\AccountNumbers\AccountNumberListParams\CreatedAt;
use Increase\AccountNumbers\AccountNumberUpdateParams\Status;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\AccountNumbersContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\AccountNumbers\AccountNumberListParams\CreatedAt
 * @phpstan-import-type InboundACHDebitsShape from \Increase\AccountNumbers\AccountNumberListParams\InboundACHDebits
 * @phpstan-import-type StatusShape from \Increase\AccountNumbers\AccountNumberListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class AccountNumbersService implements AccountNumbersContract
{
    /**
     * @api
     */
    public AccountNumbersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AccountNumbersRawService($client);
    }

    /**
     * @api
     *
     * Create an Account Number
     *
     * @param string $accountID the Account the Account Number should belong to
     * @param string $name the name you choose for the Account Number
     * @param InboundACHDebits|value-of<InboundACHDebits> $inboundACHDebits Whether inbound ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active. If you do not specify this field, the default is `allowed`.
     * @param UnregisteredInboundChecks|value-of<UnregisteredInboundChecks> $unregisteredInboundChecks Whether unregistered inbound checks for this Account Number can be deposited. If you do not specify this field, the default is `blocked`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        string $name,
        InboundACHDebits|string|null $inboundACHDebits = null,
        UnregisteredInboundChecks|string|null $unregisteredInboundChecks = null,
        RequestOptions|array|null $requestOptions = null,
    ): AccountNumber {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'name' => $name,
                'inboundACHDebits' => $inboundACHDebits,
                'unregisteredInboundChecks' => $unregisteredInboundChecks,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve an Account Number
     *
     * @param string $accountNumberID the identifier of the Account Number to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountNumberID,
        RequestOptions|array|null $requestOptions = null
    ): AccountNumber {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($accountNumberID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update an Account Number
     *
     * @param string $accountNumberID the identifier of the Account Number
     * @param \Increase\AccountNumbers\AccountNumberUpdateParams\InboundACHDebits|value-of<\Increase\AccountNumbers\AccountNumberUpdateParams\InboundACHDebits> $inboundACHDebits Whether inbound ACH debits are allowed against this Account Number. Note that ACH debits will be declined if this is `allowed` but the Account Number is not active.
     * @param string $name the name you choose for the Account Number
     * @param Status|value-of<Status> $status this indicates if transfers can be made to the Account Number
     * @param \Increase\AccountNumbers\AccountNumberUpdateParams\UnregisteredInboundChecks|value-of<\Increase\AccountNumbers\AccountNumberUpdateParams\UnregisteredInboundChecks> $unregisteredInboundChecks whether unregistered inbound checks for this Account Number can be deposited
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $accountNumberID,
        \Increase\AccountNumbers\AccountNumberUpdateParams\InboundACHDebits|string|null $inboundACHDebits = null,
        ?string $name = null,
        Status|string|null $status = null,
        \Increase\AccountNumbers\AccountNumberUpdateParams\UnregisteredInboundChecks|string|null $unregisteredInboundChecks = null,
        RequestOptions|array|null $requestOptions = null,
    ): AccountNumber {
        $params = Util::removeNulls(
            [
                'inboundACHDebits' => $inboundACHDebits,
                'name' => $name,
                'status' => $status,
                'unregisteredInboundChecks' => $unregisteredInboundChecks,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($accountNumberID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Account Numbers
     *
     * @param string $accountID filter Account Numbers to those belonging to the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param \Increase\AccountNumbers\AccountNumberListParams\InboundACHDebits|InboundACHDebitsShape $inboundACHDebits
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     *
     * Defaults to `100`.
     * @param \Increase\AccountNumbers\AccountNumberListParams\Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<AccountNumber>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        \Increase\AccountNumbers\AccountNumberListParams\InboundACHDebits|array|null $inboundACHDebits = null,
        int $limit = 100,
        \Increase\AccountNumbers\AccountNumberListParams\Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'inboundACHDebits' => $inboundACHDebits,
                'limit' => $limit,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

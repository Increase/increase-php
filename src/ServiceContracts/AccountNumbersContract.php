<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\AccountNumbers\AccountNumber;
use Increase\AccountNumbers\AccountNumberCreateParams\InboundACH;
use Increase\AccountNumbers\AccountNumberCreateParams\InboundChecks;
use Increase\AccountNumbers\AccountNumberListParams\ACHDebitStatus;
use Increase\AccountNumbers\AccountNumberListParams\CreatedAt;
use Increase\AccountNumbers\AccountNumberUpdateParams\Status;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type InboundACHShape from \Increase\AccountNumbers\AccountNumberCreateParams\InboundACH
 * @phpstan-import-type InboundChecksShape from \Increase\AccountNumbers\AccountNumberCreateParams\InboundChecks
 * @phpstan-import-type InboundACHShape from \Increase\AccountNumbers\AccountNumberUpdateParams\InboundACH as InboundACHShape1
 * @phpstan-import-type InboundChecksShape from \Increase\AccountNumbers\AccountNumberUpdateParams\InboundChecks as InboundChecksShape1
 * @phpstan-import-type ACHDebitStatusShape from \Increase\AccountNumbers\AccountNumberListParams\ACHDebitStatus
 * @phpstan-import-type CreatedAtShape from \Increase\AccountNumbers\AccountNumberListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\AccountNumbers\AccountNumberListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountNumbersContract
{
    /**
     * @api
     *
     * @param string $accountID the Account the Account Number should belong to
     * @param string $name the name you choose for the Account Number
     * @param InboundACH|InboundACHShape $inboundACH options related to how this Account Number should handle inbound ACH transfers
     * @param InboundChecks|InboundChecksShape $inboundChecks options related to how this Account Number should handle inbound check withdrawals
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        string $name,
        InboundACH|array|null $inboundACH = null,
        InboundChecks|array|null $inboundChecks = null,
        RequestOptions|array|null $requestOptions = null,
    ): AccountNumber;

    /**
     * @api
     *
     * @param string $accountNumberID the identifier of the Account Number to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountNumberID,
        RequestOptions|array|null $requestOptions = null
    ): AccountNumber;

    /**
     * @api
     *
     * @param string $accountNumberID the identifier of the Account Number
     * @param \Increase\AccountNumbers\AccountNumberUpdateParams\InboundACH|InboundACHShape1 $inboundACH options related to how this Account Number handles inbound ACH transfers
     * @param \Increase\AccountNumbers\AccountNumberUpdateParams\InboundChecks|InboundChecksShape1 $inboundChecks options related to how this Account Number should handle inbound check withdrawals
     * @param string $name the name you choose for the Account Number
     * @param Status|value-of<Status> $status this indicates if transfers can be made to the Account Number
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $accountNumberID,
        \Increase\AccountNumbers\AccountNumberUpdateParams\InboundACH|array|null $inboundACH = null,
        \Increase\AccountNumbers\AccountNumberUpdateParams\InboundChecks|array|null $inboundChecks = null,
        ?string $name = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): AccountNumber;

    /**
     * @api
     *
     * @param string $accountID filter Account Numbers to those belonging to the specified Account
     * @param ACHDebitStatus|ACHDebitStatusShape $achDebitStatus
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param \Increase\AccountNumbers\AccountNumberListParams\Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<AccountNumber>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ACHDebitStatus|array|null $achDebitStatus = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        \Increase\AccountNumbers\AccountNumberListParams\Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}

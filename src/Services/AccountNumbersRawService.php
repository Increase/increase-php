<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\AccountNumbers\AccountNumber;
use Increase\AccountNumbers\AccountNumberCreateParams;
use Increase\AccountNumbers\AccountNumberCreateParams\InboundACH;
use Increase\AccountNumbers\AccountNumberCreateParams\InboundChecks;
use Increase\AccountNumbers\AccountNumberListParams;
use Increase\AccountNumbers\AccountNumberListParams\ACHDebitStatus;
use Increase\AccountNumbers\AccountNumberListParams\CreatedAt;
use Increase\AccountNumbers\AccountNumberListParams\Status;
use Increase\AccountNumbers\AccountNumberUpdateParams;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\AccountNumbersRawContract;

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
final class AccountNumbersRawService implements AccountNumbersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an Account Number
     *
     * @param array{
     *   accountID: string,
     *   name: string,
     *   inboundACH?: InboundACH|InboundACHShape,
     *   inboundChecks?: InboundChecks|InboundChecksShape,
     * }|AccountNumberCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountNumber>
     *
     * @throws APIException
     */
    public function create(
        array|AccountNumberCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountNumberCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'account_numbers',
            body: (object) $parsed,
            options: $options,
            convert: AccountNumber::class,
        );
    }

    /**
     * @api
     *
     * Retrieve an Account Number
     *
     * @param string $accountNumberID the identifier of the Account Number to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountNumber>
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountNumberID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['account_numbers/%1$s', $accountNumberID],
            options: $requestOptions,
            convert: AccountNumber::class,
        );
    }

    /**
     * @api
     *
     * Update an Account Number
     *
     * @param string $accountNumberID the identifier of the Account Number
     * @param array{
     *   inboundACH?: AccountNumberUpdateParams\InboundACH|InboundACHShape1,
     *   inboundChecks?: AccountNumberUpdateParams\InboundChecks|InboundChecksShape1,
     *   name?: string,
     *   status?: AccountNumberUpdateParams\Status|value-of<AccountNumberUpdateParams\Status>,
     * }|AccountNumberUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountNumber>
     *
     * @throws APIException
     */
    public function update(
        string $accountNumberID,
        array|AccountNumberUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountNumberUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['account_numbers/%1$s', $accountNumberID],
            body: (object) $parsed,
            options: $options,
            convert: AccountNumber::class,
        );
    }

    /**
     * @api
     *
     * List Account Numbers
     *
     * @param array{
     *   accountID?: string,
     *   achDebitStatus?: ACHDebitStatus|ACHDebitStatusShape,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|AccountNumberListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<AccountNumber>>
     *
     * @throws APIException
     */
    public function list(
        array|AccountNumberListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountNumberListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'account_numbers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'achDebitStatus' => 'ach_debit_status',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: AccountNumber::class,
            page: Page::class,
        );
    }
}

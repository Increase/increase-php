<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\ExternalAccounts\ExternalAccount;
use Increase\ExternalAccounts\ExternalAccountCreateParams;
use Increase\ExternalAccounts\ExternalAccountCreateParams\AccountHolder;
use Increase\ExternalAccounts\ExternalAccountCreateParams\Funding;
use Increase\ExternalAccounts\ExternalAccountListParams;
use Increase\ExternalAccounts\ExternalAccountListParams\Status;
use Increase\ExternalAccounts\ExternalAccountUpdateParams;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\ExternalAccountsRawContract;

/**
 * @phpstan-import-type StatusShape from \Increase\ExternalAccounts\ExternalAccountListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class ExternalAccountsRawService implements ExternalAccountsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an External Account
     *
     * @param array{
     *   accountNumber: string,
     *   description: string,
     *   routingNumber: string,
     *   accountHolder?: AccountHolder|value-of<AccountHolder>,
     *   funding?: Funding|value-of<Funding>,
     * }|ExternalAccountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExternalAccount>
     *
     * @throws APIException
     */
    public function create(
        array|ExternalAccountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExternalAccountCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'external_accounts',
            body: (object) $parsed,
            options: $options,
            convert: ExternalAccount::class,
        );
    }

    /**
     * @api
     *
     * Retrieve an External Account
     *
     * @param string $externalAccountID the identifier of the External Account
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExternalAccount>
     *
     * @throws APIException
     */
    public function retrieve(
        string $externalAccountID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['external_accounts/%1$s', $externalAccountID],
            options: $requestOptions,
            convert: ExternalAccount::class,
        );
    }

    /**
     * @api
     *
     * Update an External Account
     *
     * @param string $externalAccountID the external account identifier
     * @param array{
     *   accountHolder?: ExternalAccountUpdateParams\AccountHolder|value-of<ExternalAccountUpdateParams\AccountHolder>,
     *   description?: string,
     *   funding?: ExternalAccountUpdateParams\Funding|value-of<ExternalAccountUpdateParams\Funding>,
     *   status?: ExternalAccountUpdateParams\Status|value-of<ExternalAccountUpdateParams\Status>,
     * }|ExternalAccountUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ExternalAccount>
     *
     * @throws APIException
     */
    public function update(
        string $externalAccountID,
        array|ExternalAccountUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExternalAccountUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['external_accounts/%1$s', $externalAccountID],
            body: (object) $parsed,
            options: $options,
            convert: ExternalAccount::class,
        );
    }

    /**
     * @api
     *
     * List External Accounts
     *
     * @param array{
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   routingNumber?: string,
     *   status?: Status|StatusShape,
     * }|ExternalAccountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<ExternalAccount>>
     *
     * @throws APIException
     */
    public function list(
        array|ExternalAccountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ExternalAccountListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'external_accounts',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'idempotencyKey' => 'idempotency_key',
                    'routingNumber' => 'routing_number',
                ],
            ),
            options: $options,
            convert: ExternalAccount::class,
            page: Page::class,
        );
    }
}

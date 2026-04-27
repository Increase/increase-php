<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\LockboxAddresses\LockboxAddress;
use Increase\LockboxAddresses\LockboxAddressCreateParams;
use Increase\LockboxAddresses\LockboxAddressListParams;
use Increase\LockboxAddresses\LockboxAddressListParams\CreatedAt;
use Increase\LockboxAddresses\LockboxAddressUpdateParams;
use Increase\LockboxAddresses\LockboxAddressUpdateParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\LockboxAddressesRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\LockboxAddresses\LockboxAddressListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class LockboxAddressesRawService implements LockboxAddressesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Lockbox Address
     *
     * @param array{description?: string}|LockboxAddressCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxAddress>
     *
     * @throws APIException
     */
    public function create(
        array|LockboxAddressCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LockboxAddressCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'lockbox_addresses',
            body: (object) $parsed,
            options: $options,
            convert: LockboxAddress::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Lockbox Address
     *
     * @param string $lockboxAddressID the identifier of the Lockbox Address to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxAddress>
     *
     * @throws APIException
     */
    public function retrieve(
        string $lockboxAddressID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['lockbox_addresses/%1$s', $lockboxAddressID],
            options: $requestOptions,
            convert: LockboxAddress::class,
        );
    }

    /**
     * @api
     *
     * Update a Lockbox Address
     *
     * @param string $lockboxAddressID the identifier of the Lockbox Address
     * @param array{
     *   description?: string, status?: Status|value-of<Status>
     * }|LockboxAddressUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxAddress>
     *
     * @throws APIException
     */
    public function update(
        string $lockboxAddressID,
        array|LockboxAddressUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LockboxAddressUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['lockbox_addresses/%1$s', $lockboxAddressID],
            body: (object) $parsed,
            options: $options,
            convert: LockboxAddress::class,
        );
    }

    /**
     * @api
     *
     * List Lockbox Addresses
     *
     * @param array{
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     * }|LockboxAddressListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<LockboxAddress>>
     *
     * @throws APIException
     */
    public function list(
        array|LockboxAddressListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LockboxAddressListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'lockbox_addresses',
            query: Util::array_transform_keys(
                $parsed,
                ['createdAt' => 'created_at', 'idempotencyKey' => 'idempotency_key'],
            ),
            options: $options,
            convert: LockboxAddress::class,
            page: Page::class,
        );
    }
}

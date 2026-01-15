<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Lockboxes\Lockbox;
use Increase\Lockboxes\LockboxCreateParams;
use Increase\Lockboxes\LockboxListParams;
use Increase\Lockboxes\LockboxListParams\CreatedAt;
use Increase\Lockboxes\LockboxUpdateParams;
use Increase\Lockboxes\LockboxUpdateParams\CheckDepositBehavior;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\LockboxesRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\Lockboxes\LockboxListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class LockboxesRawService implements LockboxesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Lockbox
     *
     * @param array{
     *   accountID: string, description?: string, recipientName?: string
     * }|LockboxCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Lockbox>
     *
     * @throws APIException
     */
    public function create(
        array|LockboxCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LockboxCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'lockboxes',
            body: (object) $parsed,
            options: $options,
            convert: Lockbox::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Lockbox
     *
     * @param string $lockboxID the identifier of the Lockbox to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Lockbox>
     *
     * @throws APIException
     */
    public function retrieve(
        string $lockboxID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['lockboxes/%1$s', $lockboxID],
            options: $requestOptions,
            convert: Lockbox::class,
        );
    }

    /**
     * @api
     *
     * Update a Lockbox
     *
     * @param string $lockboxID the identifier of the Lockbox
     * @param array{
     *   checkDepositBehavior?: CheckDepositBehavior|value-of<CheckDepositBehavior>,
     *   description?: string,
     *   recipientName?: string,
     * }|LockboxUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Lockbox>
     *
     * @throws APIException
     */
    public function update(
        string $lockboxID,
        array|LockboxUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LockboxUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['lockboxes/%1$s', $lockboxID],
            body: (object) $parsed,
            options: $options,
            convert: Lockbox::class,
        );
    }

    /**
     * @api
     *
     * List Lockboxes
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     * }|LockboxListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Lockbox>>
     *
     * @throws APIException
     */
    public function list(
        array|LockboxListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LockboxListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'lockboxes',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: Lockbox::class,
            page: Page::class,
        );
    }
}

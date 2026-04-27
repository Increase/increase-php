<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\LockboxRecipients\LockboxRecipient;
use Increase\LockboxRecipients\LockboxRecipientCreateParams;
use Increase\LockboxRecipients\LockboxRecipientListParams;
use Increase\LockboxRecipients\LockboxRecipientListParams\CreatedAt;
use Increase\LockboxRecipients\LockboxRecipientUpdateParams;
use Increase\LockboxRecipients\LockboxRecipientUpdateParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\LockboxRecipientsRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\LockboxRecipients\LockboxRecipientListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class LockboxRecipientsRawService implements LockboxRecipientsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Lockbox Recipient
     *
     * @param array{
     *   accountID: string,
     *   lockboxAddressID: string,
     *   description?: string,
     *   recipientName?: string,
     * }|LockboxRecipientCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxRecipient>
     *
     * @throws APIException
     */
    public function create(
        array|LockboxRecipientCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LockboxRecipientCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'lockbox_recipients',
            body: (object) $parsed,
            options: $options,
            convert: LockboxRecipient::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Lockbox Recipient
     *
     * @param string $lockboxRecipientID the identifier of the Lockbox Recipient to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxRecipient>
     *
     * @throws APIException
     */
    public function retrieve(
        string $lockboxRecipientID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['lockbox_recipients/%1$s', $lockboxRecipientID],
            options: $requestOptions,
            convert: LockboxRecipient::class,
        );
    }

    /**
     * @api
     *
     * Update a Lockbox Recipient
     *
     * @param string $lockboxRecipientID the identifier of the Lockbox Recipient
     * @param array{
     *   description?: string, recipientName?: string, status?: Status|value-of<Status>
     * }|LockboxRecipientUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LockboxRecipient>
     *
     * @throws APIException
     */
    public function update(
        string $lockboxRecipientID,
        array|LockboxRecipientUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LockboxRecipientUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['lockbox_recipients/%1$s', $lockboxRecipientID],
            body: (object) $parsed,
            options: $options,
            convert: LockboxRecipient::class,
        );
    }

    /**
     * @api
     *
     * List Lockbox Recipients
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   lockboxAddressID?: string,
     * }|LockboxRecipientListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<LockboxRecipient>>
     *
     * @throws APIException
     */
    public function list(
        array|LockboxRecipientListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LockboxRecipientListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'lockbox_recipients',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                    'lockboxAddressID' => 'lockbox_address_id',
                ],
            ),
            options: $options,
            convert: LockboxRecipient::class,
            page: Page::class,
        );
    }
}

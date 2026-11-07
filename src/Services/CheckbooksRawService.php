<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Checkbooks\Checkbook;
use Increase\Checkbooks\CheckbookCreateParams;
use Increase\Checkbooks\CheckbookCreateParams\MailingAddress;
use Increase\Checkbooks\CheckbookCreateParams\Payer;
use Increase\Checkbooks\CheckbookListParams;
use Increase\Checkbooks\CheckbookListParams\Status;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CheckbooksRawContract;

/**
 * @phpstan-import-type MailingAddressShape from \Increase\Checkbooks\CheckbookCreateParams\MailingAddress
 * @phpstan-import-type PayerShape from \Increase\Checkbooks\CheckbookCreateParams\Payer
 * @phpstan-import-type StatusShape from \Increase\Checkbooks\CheckbookListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckbooksRawService implements CheckbooksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Checkbook
     *
     * @param array{
     *   accountNumberID: string,
     *   mailingAddress: MailingAddress|MailingAddressShape,
     *   payer: list<Payer|PayerShape>,
     * }|CheckbookCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Checkbook>
     *
     * @throws APIException
     */
    public function create(
        array|CheckbookCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckbookCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'checkbooks',
            body: (object) $parsed,
            options: $options,
            convert: Checkbook::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Checkbook
     *
     * @param string $checkbookID the identifier of the Checkbook
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Checkbook>
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkbookID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['checkbooks/%1$s', $checkbookID],
            options: $requestOptions,
            convert: Checkbook::class,
        );
    }

    /**
     * @api
     *
     * List Checkbooks
     *
     * @param array{
     *   accountNumberID?: string,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|CheckbookListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Checkbook>>
     *
     * @throws APIException
     */
    public function list(
        array|CheckbookListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckbookListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'checkbooks',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountNumberID' => 'account_number_id',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: Checkbook::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Stop a Checkbook. Stopping a Checkbook stops all of its checks that have not yet been deposited.
     *
     * @param string $checkbookID the identifier of the Checkbook to stop
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Checkbook>
     *
     * @throws APIException
     */
    public function stop(
        string $checkbookID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['checkbooks/%1$s/stop', $checkbookID],
            options: $requestOptions,
            convert: Checkbook::class,
        );
    }
}

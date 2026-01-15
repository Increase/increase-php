<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\BookkeepingEntrySets\BookkeepingEntrySet;
use Increase\BookkeepingEntrySets\BookkeepingEntrySetCreateParams;
use Increase\BookkeepingEntrySets\BookkeepingEntrySetCreateParams\Entry;
use Increase\BookkeepingEntrySets\BookkeepingEntrySetListParams;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\BookkeepingEntrySetsRawContract;

/**
 * @phpstan-import-type EntryShape from \Increase\BookkeepingEntrySets\BookkeepingEntrySetCreateParams\Entry
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class BookkeepingEntrySetsRawService implements BookkeepingEntrySetsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Bookkeeping Entry Set
     *
     * @param array{
     *   entries: list<Entry|EntryShape>,
     *   date?: \DateTimeInterface,
     *   transactionID?: string,
     * }|BookkeepingEntrySetCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BookkeepingEntrySet>
     *
     * @throws APIException
     */
    public function create(
        array|BookkeepingEntrySetCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BookkeepingEntrySetCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'bookkeeping_entry_sets',
            body: (object) $parsed,
            options: $options,
            convert: BookkeepingEntrySet::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Bookkeeping Entry Set
     *
     * @param string $bookkeepingEntrySetID the identifier of the Bookkeeping Entry Set
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BookkeepingEntrySet>
     *
     * @throws APIException
     */
    public function retrieve(
        string $bookkeepingEntrySetID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['bookkeeping_entry_sets/%1$s', $bookkeepingEntrySetID],
            options: $requestOptions,
            convert: BookkeepingEntrySet::class,
        );
    }

    /**
     * @api
     *
     * List Bookkeeping Entry Sets
     *
     * @param array{
     *   cursor?: string, idempotencyKey?: string, limit?: int, transactionID?: string
     * }|BookkeepingEntrySetListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<BookkeepingEntrySet>>
     *
     * @throws APIException
     */
    public function list(
        array|BookkeepingEntrySetListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BookkeepingEntrySetListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'bookkeeping_entry_sets',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'idempotencyKey' => 'idempotency_key',
                    'transactionID' => 'transaction_id',
                ],
            ),
            options: $options,
            convert: BookkeepingEntrySet::class,
            page: Page::class,
        );
    }
}

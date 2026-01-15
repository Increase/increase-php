<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\BookkeepingEntries\BookkeepingEntry;
use Increase\BookkeepingEntries\BookkeepingEntryListParams;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\BookkeepingEntriesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class BookkeepingEntriesRawService implements BookkeepingEntriesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Bookkeeping Entry
     *
     * @param string $bookkeepingEntryID the identifier of the Bookkeeping Entry
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BookkeepingEntry>
     *
     * @throws APIException
     */
    public function retrieve(
        string $bookkeepingEntryID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['bookkeeping_entries/%1$s', $bookkeepingEntryID],
            options: $requestOptions,
            convert: BookkeepingEntry::class,
        );
    }

    /**
     * @api
     *
     * List Bookkeeping Entries
     *
     * @param array{
     *   accountID?: string, cursor?: string, limit?: int
     * }|BookkeepingEntryListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<BookkeepingEntry>>
     *
     * @throws APIException
     */
    public function list(
        array|BookkeepingEntryListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BookkeepingEntryListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'bookkeeping_entries',
            query: Util::array_transform_keys($parsed, ['accountID' => 'account_id']),
            options: $options,
            convert: BookkeepingEntry::class,
            page: Page::class,
        );
    }
}

<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\BookkeepingEntries\BookkeepingEntry;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\BookkeepingEntriesContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class BookkeepingEntriesService implements BookkeepingEntriesContract
{
    /**
     * @api
     */
    public BookkeepingEntriesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BookkeepingEntriesRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Bookkeeping Entry
     *
     * @param string $bookkeepingEntryID the identifier of the Bookkeeping Entry
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $bookkeepingEntryID,
        RequestOptions|array|null $requestOptions = null
    ): BookkeepingEntry {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($bookkeepingEntryID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Bookkeeping Entries
     *
     * @param string $accountID the identifier for the Bookkeeping Account to filter by
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<BookkeepingEntry>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            ['accountID' => $accountID, 'cursor' => $cursor, 'limit' => $limit]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

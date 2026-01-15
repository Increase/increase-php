<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\BookkeepingEntries\BookkeepingEntry;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface BookkeepingEntriesContract
{
    /**
     * @api
     *
     * @param string $bookkeepingEntryID the identifier of the Bookkeeping Entry
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $bookkeepingEntryID,
        RequestOptions|array|null $requestOptions = null,
    ): BookkeepingEntry;

    /**
     * @api
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
    ): Page;
}

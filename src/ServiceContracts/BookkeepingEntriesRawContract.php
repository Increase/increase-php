<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\BookkeepingEntries\BookkeepingEntry;
use Increase\BookkeepingEntries\BookkeepingEntryListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface BookkeepingEntriesRawContract
{
    /**
     * @api
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BookkeepingEntryListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<BookkeepingEntry>>
     *
     * @throws APIException
     */
    public function list(
        array|BookkeepingEntryListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

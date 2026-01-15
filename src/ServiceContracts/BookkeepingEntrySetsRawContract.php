<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\BookkeepingEntrySets\BookkeepingEntrySet;
use Increase\BookkeepingEntrySets\BookkeepingEntrySetCreateParams;
use Increase\BookkeepingEntrySets\BookkeepingEntrySetListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface BookkeepingEntrySetsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BookkeepingEntrySetCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BookkeepingEntrySet>
     *
     * @throws APIException
     */
    public function create(
        array|BookkeepingEntrySetCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BookkeepingEntrySetListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<BookkeepingEntrySet>>
     *
     * @throws APIException
     */
    public function list(
        array|BookkeepingEntrySetListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

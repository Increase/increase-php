<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Lockboxes\Lockbox;
use Increase\Lockboxes\LockboxCreateParams;
use Increase\Lockboxes\LockboxListParams;
use Increase\Lockboxes\LockboxUpdateParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface LockboxesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|LockboxCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Lockbox>
     *
     * @throws APIException
     */
    public function create(
        array|LockboxCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $lockboxID the identifier of the Lockbox
     * @param array<string,mixed>|LockboxUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|LockboxListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Lockbox>>
     *
     * @throws APIException
     */
    public function list(
        array|LockboxListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

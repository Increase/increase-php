<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Checkbooks\Checkbook;
use Increase\Checkbooks\CheckbookCreateParams;
use Increase\Checkbooks\CheckbookListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckbooksRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CheckbookCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Checkbook>
     *
     * @throws APIException
     */
    public function create(
        array|CheckbookCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CheckbookListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Checkbook>>
     *
     * @throws APIException
     */
    public function list(
        array|CheckbookListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}

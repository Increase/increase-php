<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Exports\Export;
use Increase\Exports\ExportCreateParams;
use Increase\Exports\ExportListParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ExportsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ExportCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Export>
     *
     * @throws APIException
     */
    public function create(
        array|ExportCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $exportID the identifier of the Export to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Export>
     *
     * @throws APIException
     */
    public function retrieve(
        string $exportID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ExportListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<Export>>
     *
     * @throws APIException
     */
    public function list(
        array|ExportListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

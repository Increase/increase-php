<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\FileLinks\FileLink;
use Increase\FileLinks\FileLinkCreateParams;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface FileLinksRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|FileLinkCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileLink>
     *
     * @throws APIException
     */
    public function create(
        array|FileLinkCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

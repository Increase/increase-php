<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;
use Increase\SupplementalDocuments\EntitySupplementalDocument;
use Increase\SupplementalDocuments\SupplementalDocumentCreateParams;
use Increase\SupplementalDocuments\SupplementalDocumentListParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface SupplementalDocumentsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SupplementalDocumentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntitySupplementalDocument>
     *
     * @throws APIException
     */
    public function create(
        array|SupplementalDocumentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SupplementalDocumentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<EntitySupplementalDocument>>
     *
     * @throws APIException
     */
    public function list(
        array|SupplementalDocumentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

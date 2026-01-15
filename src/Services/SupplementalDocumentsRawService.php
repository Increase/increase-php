<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\SupplementalDocumentsRawContract;
use Increase\SupplementalDocuments\EntitySupplementalDocument;
use Increase\SupplementalDocuments\SupplementalDocumentCreateParams;
use Increase\SupplementalDocuments\SupplementalDocumentListParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class SupplementalDocumentsRawService implements SupplementalDocumentsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a supplemental document for an Entity
     *
     * @param array{
     *   entityID: string, fileID: string
     * }|SupplementalDocumentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntitySupplementalDocument>
     *
     * @throws APIException
     */
    public function create(
        array|SupplementalDocumentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SupplementalDocumentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'entity_supplemental_documents',
            body: (object) $parsed,
            options: $options,
            convert: EntitySupplementalDocument::class,
        );
    }

    /**
     * @api
     *
     * List Entity Supplemental Document Submissions
     *
     * @param array{
     *   entityID: string, cursor?: string, idempotencyKey?: string, limit?: int
     * }|SupplementalDocumentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<EntitySupplementalDocument>>
     *
     * @throws APIException
     */
    public function list(
        array|SupplementalDocumentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SupplementalDocumentListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'entity_supplemental_documents',
            query: Util::array_transform_keys(
                $parsed,
                ['entityID' => 'entity_id', 'idempotencyKey' => 'idempotency_key'],
            ),
            options: $options,
            convert: EntitySupplementalDocument::class,
            page: Page::class,
        );
    }
}

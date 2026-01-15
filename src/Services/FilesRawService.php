<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Files\File;
use Increase\Files\FileCreateParams;
use Increase\Files\FileCreateParams\Purpose;
use Increase\Files\FileListParams;
use Increase\Files\FileListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\FilesRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\Files\FileListParams\CreatedAt
 * @phpstan-import-type PurposeShape from \Increase\Files\FileListParams\Purpose
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class FilesRawService implements FilesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * To upload a file to Increase, you'll need to send a request of Content-Type `multipart/form-data`. The request should contain the file you would like to upload, as well as the parameters for creating a file.
     *
     * @param array{
     *   file: string, purpose: value-of<Purpose>, description?: string
     * }|FileCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<File>
     *
     * @throws APIException
     */
    public function create(
        array|FileCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FileCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'files',
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
            convert: File::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a File
     *
     * @param string $fileID the identifier of the File
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<File>
     *
     * @throws APIException
     */
    public function retrieve(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['files/%1$s', $fileID],
            options: $requestOptions,
            convert: File::class,
        );
    }

    /**
     * @api
     *
     * List Files
     *
     * @param array{
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   purpose?: FileListParams\Purpose|PurposeShape,
     * }|FileListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<File>>
     *
     * @throws APIException
     */
    public function list(
        array|FileListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FileListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'files',
            query: Util::array_transform_keys(
                $parsed,
                ['createdAt' => 'created_at', 'idempotencyKey' => 'idempotency_key'],
            ),
            options: $options,
            convert: File::class,
            page: Page::class,
        );
    }
}

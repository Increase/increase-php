<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\Files\File;
use Increase\Files\FileCreateParams\Purpose;
use Increase\Files\FileListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\Files\FileListParams\CreatedAt
 * @phpstan-import-type PurposeShape from \Increase\Files\FileListParams\Purpose
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface FilesContract
{
    /**
     * @api
     *
     * @param string $file The file contents. This should follow the specifications of [RFC 7578](https://datatracker.ietf.org/doc/html/rfc7578) which defines file transfers for the multipart/form-data protocol.
     * @param Purpose|value-of<Purpose> $purpose what the File will be used for in Increase's systems
     * @param string $description the description you choose to give the File
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $file,
        Purpose|string $purpose,
        ?string $description = null,
        RequestOptions|array|null $requestOptions = null,
    ): File;

    /**
     * @api
     *
     * @param string $fileID the identifier of the File
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $fileID,
        RequestOptions|array|null $requestOptions = null
    ): File;

    /**
     * @api
     *
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param \Increase\Files\FileListParams\Purpose|PurposeShape $purpose
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<File>
     *
     * @throws APIException
     */
    public function list(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        \Increase\Files\FileListParams\Purpose|array|null $purpose = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}

<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\FileLinks\FileLink;
use Increase\FileLinks\FileLinkCreateParams;
use Increase\RequestOptions;
use Increase\ServiceContracts\FileLinksRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class FileLinksRawService implements FileLinksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a File Link
     *
     * @param array{
     *   fileID: string, expiresAt?: \DateTimeInterface
     * }|FileLinkCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileLink>
     *
     * @throws APIException
     */
    public function create(
        array|FileLinkCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FileLinkCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'file_links',
            body: (object) $parsed,
            options: $options,
            convert: FileLink::class,
        );
    }
}

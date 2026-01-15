<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\FileLinks\FileLink;
use Increase\RequestOptions;
use Increase\ServiceContracts\FileLinksContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class FileLinksService implements FileLinksContract
{
    /**
     * @api
     */
    public FileLinksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FileLinksRawService($client);
    }

    /**
     * @api
     *
     * Create a File Link
     *
     * @param string $fileID the File to create a File Link for
     * @param \DateTimeInterface $expiresAt The time at which the File Link will expire. The default is 1 hour from the time of the request. The maxiumum is 1 day from the time of the request.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $fileID,
        ?\DateTimeInterface $expiresAt = null,
        RequestOptions|array|null $requestOptions = null,
    ): FileLink {
        $params = Util::removeNulls(
            ['fileID' => $fileID, 'expiresAt' => $expiresAt]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

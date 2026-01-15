<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\FileLinks\FileLink;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface FileLinksContract
{
    /**
     * @api
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
    ): FileLink;
}

<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Checkbooks\Checkbook;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CheckbooksContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckbooksService implements CheckbooksContract
{
    /**
     * @api
     */
    public CheckbooksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CheckbooksRawService($client);
    }

    /**
     * @api
     *
     * Simulates the mailing of a [Checkbook](#checkbooks), which happens periodically throughout the day in production but can be sped up in sandbox. This Checkbook must have a `status` of `pending_submission` or `pending_mailing`.
     *
     * @param string $checkbookID the identifier of the Checkbook you wish to mail
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function mail(
        string $checkbookID,
        RequestOptions|array|null $requestOptions = null
    ): Checkbook {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->mail($checkbookID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

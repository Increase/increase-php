<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Checkbooks\Checkbook;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CheckbooksRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckbooksRawService implements CheckbooksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates the mailing of a [Checkbook](#checkbooks), which happens periodically throughout the day in production but can be sped up in sandbox. This Checkbook must have a `status` of `pending_submission` or `pending_mailing`.
     *
     * @param string $checkbookID the identifier of the Checkbook you wish to mail
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Checkbook>
     *
     * @throws APIException
     */
    public function mail(
        string $checkbookID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/checkbooks/%1$s/mail', $checkbookID],
            options: $requestOptions,
            convert: Checkbook::class,
        );
    }
}

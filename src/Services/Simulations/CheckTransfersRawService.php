<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CheckTransfers\CheckTransfer;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CheckTransfersRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckTransfersRawService implements CheckTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates the mailing of a [Check Transfer](#check-transfers), which happens periodically throughout the day in production but can be sped up in sandbox. This transfer must first have a `status` of `pending_approval` or `pending_submission`.
     *
     * @param string $checkTransferID the identifier of the Check Transfer you wish to mail
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckTransfer>
     *
     * @throws APIException
     */
    public function mail(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/check_transfers/%1$s/mail', $checkTransferID],
            options: $requestOptions,
            convert: CheckTransfer::class,
        );
    }
}

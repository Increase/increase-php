<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\WireTransfersRawContract;
use Increase\WireTransfers\WireTransfer;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class WireTransfersRawService implements WireTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates the reversal of a [Wire Transfer](#wire-transfers) by the Federal Reserve due to error conditions. This will also create a [Transaction](#transaction) to account for the returned funds. This Wire Transfer must first have a `status` of `complete`.
     *
     * @param string $wireTransferID the identifier of the Wire Transfer you wish to reverse
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function reverse(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/wire_transfers/%1$s/reverse', $wireTransferID],
            options: $requestOptions,
            convert: WireTransfer::class,
        );
    }

    /**
     * @api
     *
     * Simulates the submission of a [Wire Transfer](#wire-transfers) to the Federal Reserve. This transfer must first have a `status` of `pending_approval` or `pending_creating`.
     *
     * @param string $wireTransferID the identifier of the Wire Transfer you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WireTransfer>
     *
     * @throws APIException
     */
    public function submit(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/wire_transfers/%1$s/submit', $wireTransferID],
            options: $requestOptions,
            convert: WireTransfer::class,
        );
    }
}

<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\FednowTransfers\FednowTransfer;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\FednowTransfersRawContract;
use Increase\Simulations\FednowTransfers\FednowTransferCompleteParams;
use Increase\Simulations\FednowTransfers\FednowTransferCompleteParams\Rejection;

/**
 * @phpstan-import-type RejectionShape from \Increase\Simulations\FednowTransfers\FednowTransferCompleteParams\Rejection
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class FednowTransfersRawService implements FednowTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates submission of a [FedNow Transfer](#fednow-transfers) and handling the response from the destination financial institution. This transfer must first have a `status` of `pending_submitting`.
     *
     * @param string $fednowTransferID the identifier of the FedNow Transfer you wish to complete
     * @param array{
     *   rejection?: Rejection|RejectionShape
     * }|FednowTransferCompleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FednowTransfer>
     *
     * @throws APIException
     */
    public function complete(
        string $fednowTransferID,
        array|FednowTransferCompleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = FednowTransferCompleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/fednow_transfers/%1$s/complete', $fednowTransferID],
            body: (object) $parsed,
            options: $options,
            convert: FednowTransfer::class,
        );
    }
}

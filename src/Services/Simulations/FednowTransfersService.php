<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\FednowTransfers\FednowTransfer;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\FednowTransfersContract;
use Increase\Simulations\FednowTransfers\FednowTransferCompleteParams\Rejection;

/**
 * @phpstan-import-type RejectionShape from \Increase\Simulations\FednowTransfers\FednowTransferCompleteParams\Rejection
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class FednowTransfersService implements FednowTransfersContract
{
    /**
     * @api
     */
    public FednowTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FednowTransfersRawService($client);
    }

    /**
     * @api
     *
     * Simulates submission of a [FedNow Transfer](#fednow-transfers) and handling the response from the destination financial institution. This transfer must first have a `status` of `pending_submitting`.
     *
     * @param string $fednowTransferID the identifier of the FedNow Transfer you wish to complete
     * @param Rejection|RejectionShape $rejection if set, the simulation will reject the transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function complete(
        string $fednowTransferID,
        Rejection|array|null $rejection = null,
        RequestOptions|array|null $requestOptions = null,
    ): FednowTransfer {
        $params = Util::removeNulls(['rejection' => $rejection]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->complete($fednowTransferID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

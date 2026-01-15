<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CheckTransfers\CheckTransfer;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CheckTransfersContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckTransfersService implements CheckTransfersContract
{
    /**
     * @api
     */
    public CheckTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CheckTransfersRawService($client);
    }

    /**
     * @api
     *
     * Simulates the mailing of a [Check Transfer](#check-transfers), which happens periodically throughout the day in production but can be sped up in sandbox. This transfer must first have a `status` of `pending_approval` or `pending_submission`.
     *
     * @param string $checkTransferID the identifier of the Check Transfer you wish to mail
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function mail(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): CheckTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->mail($checkTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

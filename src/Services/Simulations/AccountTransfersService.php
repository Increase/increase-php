<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\AccountTransfers\AccountTransfer;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\AccountTransfersContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class AccountTransfersService implements AccountTransfersContract
{
    /**
     * @api
     */
    public AccountTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AccountTransfersRawService($client);
    }

    /**
     * @api
     *
     * If your account is configured to require approval for each transfer, this endpoint simulates the approval of an [Account Transfer](#account-transfers). You can also approve sandbox Account Transfers in the dashboard. This transfer must first have a `status` of `pending_approval`.
     *
     * @param string $accountTransferID the identifier of the Account Transfer you wish to complete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function complete(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null
    ): AccountTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->complete($accountTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

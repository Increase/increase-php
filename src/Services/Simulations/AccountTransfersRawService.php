<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\AccountTransfers\AccountTransfer;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\AccountTransfersRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class AccountTransfersRawService implements AccountTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * If your account is configured to require approval for each transfer, this endpoint simulates the approval of an [Account Transfer](#account-transfers). You can also approve sandbox Account Transfers in the dashboard. This transfer must first have a `status` of `pending_approval`.
     *
     * @param string $accountTransferID the identifier of the Account Transfer you wish to complete
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountTransfer>
     *
     * @throws APIException
     */
    public function complete(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/account_transfers/%1$s/complete', $accountTransferID],
            options: $requestOptions,
            convert: AccountTransfer::class,
        );
    }
}

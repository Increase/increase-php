<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\IntrafiBalances\IntrafiBalance;
use Increase\RequestOptions;
use Increase\ServiceContracts\IntrafiBalancesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class IntrafiBalancesRawService implements IntrafiBalancesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the IntraFi balance for the given account. IntraFi may sweep funds to multiple banks. This endpoint will include both the total balance and the amount swept to each institution.
     *
     * @param string $accountID the identifier of the Account to get balances for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<IntrafiBalance>
     *
     * @throws APIException
     */
    public function intrafiBalance(
        string $accountID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['accounts/%1$s/intrafi_balance', $accountID],
            options: $requestOptions,
            convert: IntrafiBalance::class,
        );
    }
}

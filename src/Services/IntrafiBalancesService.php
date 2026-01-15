<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\IntrafiBalances\IntrafiBalance;
use Increase\RequestOptions;
use Increase\ServiceContracts\IntrafiBalancesContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class IntrafiBalancesService implements IntrafiBalancesContract
{
    /**
     * @api
     */
    public IntrafiBalancesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new IntrafiBalancesRawService($client);
    }

    /**
     * @api
     *
     * Returns the IntraFi balance for the given account. IntraFi may sweep funds to multiple banks. This endpoint will include both the total balance and the amount swept to each institution.
     *
     * @param string $accountID the identifier of the Account to get balances for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function intrafiBalance(
        string $accountID,
        RequestOptions|array|null $requestOptions = null
    ): IntrafiBalance {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->intrafiBalance($accountID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

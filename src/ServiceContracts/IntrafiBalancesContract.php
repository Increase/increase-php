<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\IntrafiBalances\IntrafiBalance;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface IntrafiBalancesContract
{
    /**
     * @api
     *
     * @param string $accountID the identifier of the Account to get balances for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function intrafiBalance(
        string $accountID,
        RequestOptions|array|null $requestOptions = null
    ): IntrafiBalance;
}

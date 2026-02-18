<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CheckDeposits\CheckDeposit;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CheckDeposits\CheckDepositSubmitParams\Scan;

/**
 * @phpstan-import-type ScanShape from \Increase\Simulations\CheckDeposits\CheckDepositSubmitParams\Scan
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckDepositsContract
{
    /**
     * @api
     *
     * @param string $checkDepositID the identifier of the Check Deposit you wish to reject
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function reject(
        string $checkDepositID,
        RequestOptions|array|null $requestOptions = null
    ): CheckDeposit;

    /**
     * @api
     *
     * @param string $checkDepositID the identifier of the Check Deposit you wish to return
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function return(
        string $checkDepositID,
        RequestOptions|array|null $requestOptions = null
    ): CheckDeposit;

    /**
     * @api
     *
     * @param string $checkDepositID the identifier of the Check Deposit you wish to submit
     * @param Scan|ScanShape $scan if set, the simulation will use these values for the check's scanned MICR data
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        string $checkDepositID,
        Scan|array|null $scan = null,
        RequestOptions|array|null $requestOptions = null,
    ): CheckDeposit;
}

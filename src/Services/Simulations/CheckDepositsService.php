<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CheckDeposits\CheckDeposit;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CheckDepositsContract;
use Increase\Simulations\CheckDeposits\CheckDepositSubmitParams\Scan;

/**
 * @phpstan-import-type ScanShape from \Increase\Simulations\CheckDeposits\CheckDepositSubmitParams\Scan
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckDepositsService implements CheckDepositsContract
{
    /**
     * @api
     */
    public CheckDepositsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CheckDepositsRawService($client);
    }

    /**
     * @api
     *
     * Simulates the rejection of a [Check Deposit](#check-deposits) by Increase due to factors like poor image quality. This Check Deposit must first have a `status` of `pending`.
     *
     * @param string $checkDepositID the identifier of the Check Deposit you wish to reject
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function reject(
        string $checkDepositID,
        RequestOptions|array|null $requestOptions = null
    ): CheckDeposit {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->reject($checkDepositID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Simulates the return of a [Check Deposit](#check-deposits). This Check Deposit must first have a `status` of `submitted`.
     *
     * @param string $checkDepositID the identifier of the Check Deposit you wish to return
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function return(
        string $checkDepositID,
        RequestOptions|array|null $requestOptions = null
    ): CheckDeposit {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->return($checkDepositID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Simulates the submission of a [Check Deposit](#check-deposits) to the Federal Reserve. This Check Deposit must first have a `status` of `pending`.
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
    ): CheckDeposit {
        $params = Util::removeNulls(['scan' => $scan]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submit($checkDepositID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

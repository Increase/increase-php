<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CheckDeposits\CheckDeposit;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CheckDepositsRawContract;
use Increase\Simulations\CheckDeposits\CheckDepositSubmitParams;
use Increase\Simulations\CheckDeposits\CheckDepositSubmitParams\Scan;

/**
 * @phpstan-import-type ScanShape from \Increase\Simulations\CheckDeposits\CheckDepositSubmitParams\Scan
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckDepositsRawService implements CheckDepositsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates the rejection of a [Check Deposit](#check-deposits) by Increase due to factors like poor image quality. This Check Deposit must first have a `status` of `pending`.
     *
     * @param string $checkDepositID the identifier of the Check Deposit you wish to reject
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckDeposit>
     *
     * @throws APIException
     */
    public function reject(
        string $checkDepositID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/check_deposits/%1$s/reject', $checkDepositID],
            options: $requestOptions,
            convert: CheckDeposit::class,
        );
    }

    /**
     * @api
     *
     * Simulates the return of a [Check Deposit](#check-deposits). This Check Deposit must first have a `status` of `submitted`.
     *
     * @param string $checkDepositID the identifier of the Check Deposit you wish to return
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckDeposit>
     *
     * @throws APIException
     */
    public function return(
        string $checkDepositID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/check_deposits/%1$s/return', $checkDepositID],
            options: $requestOptions,
            convert: CheckDeposit::class,
        );
    }

    /**
     * @api
     *
     * Simulates the submission of a [Check Deposit](#check-deposits) to the Federal Reserve. This Check Deposit must first have a `status` of `pending`.
     *
     * @param string $checkDepositID the identifier of the Check Deposit you wish to submit
     * @param array{scan?: Scan|ScanShape}|CheckDepositSubmitParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckDeposit>
     *
     * @throws APIException
     */
    public function submit(
        string $checkDepositID,
        array|CheckDepositSubmitParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckDepositSubmitParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/check_deposits/%1$s/submit', $checkDepositID],
            body: (object) $parsed,
            options: $options,
            convert: CheckDeposit::class,
        );
    }
}

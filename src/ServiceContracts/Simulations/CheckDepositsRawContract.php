<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CheckDeposits\CheckDeposit;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CheckDeposits\CheckDepositSubmitParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckDepositsRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $checkDepositID the identifier of the Check Deposit you wish to submit
     * @param array<string,mixed>|CheckDepositSubmitParams $params
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
    ): BaseResponse;
}

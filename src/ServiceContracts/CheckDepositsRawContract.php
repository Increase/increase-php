<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CheckDeposits\CheckDeposit;
use Increase\CheckDeposits\CheckDepositCreateParams;
use Increase\CheckDeposits\CheckDepositListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckDepositsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CheckDepositCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckDeposit>
     *
     * @throws APIException
     */
    public function create(
        array|CheckDepositCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $checkDepositID the identifier of the Check Deposit to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckDeposit>
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkDepositID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CheckDepositListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CheckDeposit>>
     *
     * @throws APIException
     */
    public function list(
        array|CheckDepositListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

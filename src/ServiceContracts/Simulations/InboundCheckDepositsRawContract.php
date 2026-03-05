<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundCheckDeposits\InboundCheckDeposit;
use Increase\RequestOptions;
use Increase\Simulations\InboundCheckDeposits\InboundCheckDepositAdjustmentParams;
use Increase\Simulations\InboundCheckDeposits\InboundCheckDepositCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundCheckDepositsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InboundCheckDepositCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundCheckDeposit>
     *
     * @throws APIException
     */
    public function create(
        array|InboundCheckDepositCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to adjust
     * @param array<string,mixed>|InboundCheckDepositAdjustmentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundCheckDeposit>
     *
     * @throws APIException
     */
    public function adjustment(
        string $inboundCheckDepositID,
        array|InboundCheckDepositAdjustmentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

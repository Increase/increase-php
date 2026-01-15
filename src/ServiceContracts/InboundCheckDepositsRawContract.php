<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundCheckDeposits\InboundCheckDeposit;
use Increase\InboundCheckDeposits\InboundCheckDepositListParams;
use Increase\InboundCheckDeposits\InboundCheckDepositReturnParams;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundCheckDepositsRawContract
{
    /**
     * @api
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundCheckDeposit>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundCheckDepositID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InboundCheckDepositListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundCheckDeposit>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundCheckDepositListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to decline
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundCheckDeposit>
     *
     * @throws APIException
     */
    public function decline(
        string $inboundCheckDepositID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to return
     * @param array<string,mixed>|InboundCheckDepositReturnParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundCheckDeposit>
     *
     * @throws APIException
     */
    public function return(
        string $inboundCheckDepositID,
        array|InboundCheckDepositReturnParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

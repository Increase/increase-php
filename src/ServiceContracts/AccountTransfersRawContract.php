<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\AccountTransfers\AccountTransfer;
use Increase\AccountTransfers\AccountTransferCreateParams;
use Increase\AccountTransfers\AccountTransferListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AccountTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|AccountTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $accountTransferID the identifier of the Account Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AccountTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<AccountTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|AccountTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $accountTransferID the identifier of the Account Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $accountTransferID the identifier of the pending Account Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

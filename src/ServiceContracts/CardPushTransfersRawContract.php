<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CardPushTransfers\CardPushTransfer;
use Increase\CardPushTransfers\CardPushTransferCreateParams;
use Increase\CardPushTransfers\CardPushTransferListParams;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardPushTransfersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CardPushTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPushTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|CardPushTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardPushTransferID the identifier of the Card Push Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPushTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardPushTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CardPushTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardPushTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|CardPushTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardPushTransferID the identifier of the Card Push Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPushTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $cardPushTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $cardPushTransferID the identifier of the pending Card Push Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPushTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $cardPushTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

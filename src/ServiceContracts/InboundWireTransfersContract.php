<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\InboundWireTransfers\InboundWireTransfer;
use Increase\InboundWireTransfers\InboundWireTransferListParams\CreatedAt;
use Increase\InboundWireTransfers\InboundWireTransferListParams\Status;
use Increase\InboundWireTransfers\InboundWireTransferReverseParams\Reason;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundWireTransfers\InboundWireTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\InboundWireTransfers\InboundWireTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundWireTransfersContract
{
    /**
     * @api
     *
     * @param string $inboundWireTransferID the identifier of the Inbound Wire Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundWireTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundWireTransfer;

    /**
     * @api
     *
     * @param string $accountID filter Inbound Wire Transfers to ones belonging to the specified Account
     * @param string $accountNumberID filter Inbound Wire Transfers to ones belonging to the specified Account Number
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param string $wireDrawdownRequestID filter Inbound Wire Transfers to ones belonging to the specified Wire Drawdown Request
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<InboundWireTransfer>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ?string $accountNumberID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        Status|array|null $status = null,
        ?string $wireDrawdownRequestID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;

    /**
     * @api
     *
     * @param string $inboundWireTransferID the identifier of the Inbound Wire Transfer to reverse
     * @param Reason|value-of<Reason> $reason reason for the reversal
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function reverse(
        string $inboundWireTransferID,
        Reason|string $reason,
        RequestOptions|array|null $requestOptions = null,
    ): InboundWireTransfer;
}

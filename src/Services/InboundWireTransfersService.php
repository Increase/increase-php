<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundWireTransfers\InboundWireTransfer;
use Increase\InboundWireTransfers\InboundWireTransferListParams\CreatedAt;
use Increase\InboundWireTransfers\InboundWireTransferListParams\Status;
use Increase\InboundWireTransfers\InboundWireTransferReverseParams\Reason;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundWireTransfersContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundWireTransfers\InboundWireTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\InboundWireTransfers\InboundWireTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundWireTransfersService implements InboundWireTransfersContract
{
    /**
     * @api
     */
    public InboundWireTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundWireTransfersRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an Inbound Wire Transfer
     *
     * @param string $inboundWireTransferID the identifier of the Inbound Wire Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundWireTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundWireTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($inboundWireTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Inbound Wire Transfers
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
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'accountNumberID' => $accountNumberID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'limit' => $limit,
                'status' => $status,
                'wireDrawdownRequestID' => $wireDrawdownRequestID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Reverse an Inbound Wire Transfer
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
    ): InboundWireTransfer {
        $params = Util::removeNulls(['reason' => $reason]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->reverse($inboundWireTransferID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

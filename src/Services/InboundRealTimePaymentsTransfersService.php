<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransferListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundRealTimePaymentsTransfersContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransferListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundRealTimePaymentsTransfersService implements InboundRealTimePaymentsTransfersContract
{
    /**
     * @api
     */
    public InboundRealTimePaymentsTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundRealTimePaymentsTransfersRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an Inbound Real-Time Payments Transfer
     *
     * @param string $inboundRealTimePaymentsTransferID the identifier of the Inbound Real-Time Payments Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundRealTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundRealTimePaymentsTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($inboundRealTimePaymentsTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Inbound Real-Time Payments Transfers
     *
     * @param string $accountID filter Inbound Real-Time Payments Transfers to those belonging to the specified Account
     * @param string $accountNumberID filter Inbound Real-Time Payments Transfers to ones belonging to the specified Account Number
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<InboundRealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ?string $accountNumberID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'accountNumberID' => $accountNumberID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

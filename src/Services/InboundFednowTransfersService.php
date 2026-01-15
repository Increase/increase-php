<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundFednowTransfers\InboundFednowTransfer;
use Increase\InboundFednowTransfers\InboundFednowTransferListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundFednowTransfersContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundFednowTransfers\InboundFednowTransferListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundFednowTransfersService implements InboundFednowTransfersContract
{
    /**
     * @api
     */
    public InboundFednowTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundFednowTransfersRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an Inbound FedNow Transfer
     *
     * @param string $inboundFednowTransferID the identifier of the Inbound FedNow Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundFednowTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundFednowTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($inboundFednowTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Inbound FedNow Transfers
     *
     * @param string $accountID filter Inbound FedNow Transfers to those belonging to the specified Account
     * @param string $accountNumberID filter Inbound FedNow Transfers to ones belonging to the specified Account Number
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<InboundFednowTransfer>
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

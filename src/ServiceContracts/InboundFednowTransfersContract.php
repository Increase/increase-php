<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\InboundFednowTransfers\InboundFednowTransfer;
use Increase\InboundFednowTransfers\InboundFednowTransferListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundFednowTransfers\InboundFednowTransferListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundFednowTransfersContract
{
    /**
     * @api
     *
     * @param string $inboundFednowTransferID the identifier of the Inbound FedNow Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundFednowTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundFednowTransfer;

    /**
     * @api
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
    ): Page;
}

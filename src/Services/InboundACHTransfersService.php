<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundACHTransfers\InboundACHTransfer;
use Increase\InboundACHTransfers\InboundACHTransferDeclineParams\Reason;
use Increase\InboundACHTransfers\InboundACHTransferListParams\CreatedAt;
use Increase\InboundACHTransfers\InboundACHTransferListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundACHTransfersContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundACHTransfers\InboundACHTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\InboundACHTransfers\InboundACHTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundACHTransfersService implements InboundACHTransfersContract
{
    /**
     * @api
     */
    public InboundACHTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundACHTransfersRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an Inbound ACH Transfer
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundACHTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundACHTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($inboundACHTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Inbound ACH Transfers
     *
     * @param string $accountID filter Inbound ACH Transfers to ones belonging to the specified Account
     * @param string $accountNumberID filter Inbound ACH Transfers to ones belonging to the specified Account Number
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<InboundACHTransfer>
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
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a notification of change for an Inbound ACH Transfer
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer for which to create a notification of change
     * @param string $updatedAccountNumber the updated account number to send in the notification of change
     * @param string $updatedRoutingNumber the updated routing number to send in the notification of change
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createNotificationOfChange(
        string $inboundACHTransferID,
        ?string $updatedAccountNumber = null,
        ?string $updatedRoutingNumber = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundACHTransfer {
        $params = Util::removeNulls(
            [
                'updatedAccountNumber' => $updatedAccountNumber,
                'updatedRoutingNumber' => $updatedRoutingNumber,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createNotificationOfChange($inboundACHTransferID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Decline an Inbound ACH Transfer
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer to decline
     * @param Reason|value-of<Reason> $reason The reason why this transfer will be returned. If this parameter is unset, the return codes will be `payment_stopped` for debits and `credit_entry_refused_by_receiver` for credits.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function decline(
        string $inboundACHTransferID,
        Reason|string|null $reason = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundACHTransfer {
        $params = Util::removeNulls(['reason' => $reason]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->decline($inboundACHTransferID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Return an Inbound ACH Transfer
     *
     * @param string $inboundACHTransferID the identifier of the Inbound ACH Transfer to return to the originating financial institution
     * @param \Increase\InboundACHTransfers\InboundACHTransferTransferReturnParams\Reason|value-of<\Increase\InboundACHTransfers\InboundACHTransferTransferReturnParams\Reason> $reason The reason why this transfer will be returned. The most usual return codes are `payment_stopped` for debits and `credit_entry_refused_by_receiver` for credits.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function transferReturn(
        string $inboundACHTransferID,
        \Increase\InboundACHTransfers\InboundACHTransferTransferReturnParams\Reason|string $reason,
        RequestOptions|array|null $requestOptions = null,
    ): InboundACHTransfer {
        $params = Util::removeNulls(['reason' => $reason]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->transferReturn($inboundACHTransferID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

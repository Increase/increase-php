<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferListParams\CreatedAt;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferListParams\Status;
use Increase\RequestOptions;
use Increase\ServiceContracts\RealTimePaymentsTransfersContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\RealTimePaymentsTransfers\RealTimePaymentsTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class RealTimePaymentsTransfersService implements RealTimePaymentsTransfersContract
{
    /**
     * @api
     */
    public RealTimePaymentsTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RealTimePaymentsTransfersRawService($client);
    }

    /**
     * @api
     *
     * Create a Real-Time Payments Transfer
     *
     * @param int $amount The transfer amount in USD cents. For Real-Time Payments transfers, must be positive.
     * @param string $creditorName the name of the transfer's recipient
     * @param string $remittanceInformation unstructured information that will show on the recipient's bank statement
     * @param string $sourceAccountNumberID the identifier of the Account Number from which to send the transfer
     * @param string $debtorName The name of the transfer's sender. If not provided, defaults to the name of the account's entity.
     * @param string $destinationAccountNumber the destination account number
     * @param string $destinationRoutingNumber the destination American Bankers' Association (ABA) Routing Transit Number (RTN)
     * @param string $externalAccountID The ID of an External Account to initiate a transfer to. If this parameter is provided, `destination_account_number` and `destination_routing_number` must be absent.
     * @param bool $requireApproval whether the transfer requires explicit approval via the dashboard or API
     * @param string $ultimateCreditorName The name of the ultimate recipient of the transfer. Set this if the creditor is an intermediary receiving the payment for someone else.
     * @param string $ultimateDebtorName The name of the ultimate sender of the transfer. Set this if the funds are being sent on behalf of someone who is not the account holder at Increase.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        string $creditorName,
        string $remittanceInformation,
        string $sourceAccountNumberID,
        ?string $debtorName = null,
        ?string $destinationAccountNumber = null,
        ?string $destinationRoutingNumber = null,
        ?string $externalAccountID = null,
        ?bool $requireApproval = null,
        ?string $ultimateCreditorName = null,
        ?string $ultimateDebtorName = null,
        RequestOptions|array|null $requestOptions = null,
    ): RealTimePaymentsTransfer {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'creditorName' => $creditorName,
                'remittanceInformation' => $remittanceInformation,
                'sourceAccountNumberID' => $sourceAccountNumberID,
                'debtorName' => $debtorName,
                'destinationAccountNumber' => $destinationAccountNumber,
                'destinationRoutingNumber' => $destinationRoutingNumber,
                'externalAccountID' => $externalAccountID,
                'requireApproval' => $requireApproval,
                'ultimateCreditorName' => $ultimateCreditorName,
                'ultimateDebtorName' => $ultimateDebtorName,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Real-Time Payments Transfer
     *
     * @param string $realTimePaymentsTransferID the identifier of the Real-Time Payments Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $realTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): RealTimePaymentsTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($realTimePaymentsTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Real-Time Payments Transfers
     *
     * @param string $accountID filter Real-Time Payments Transfers to those belonging to the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $externalAccountID filter Real-Time Payments Transfers to those made to the specified External Account
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<RealTimePaymentsTransfer>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $externalAccountID = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'externalAccountID' => $externalAccountID,
                'idempotencyKey' => $idempotencyKey,
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
     * Approves a Real-Time Payments Transfer in a pending_approval state.
     *
     * @param string $realTimePaymentsTransferID the identifier of the Real-Time Payments Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $realTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): RealTimePaymentsTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->approve($realTimePaymentsTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancels a Real-Time Payments Transfer in a pending_approval state.
     *
     * @param string $realTimePaymentsTransferID the identifier of the pending Real-Time Payments Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $realTimePaymentsTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): RealTimePaymentsTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($realTimePaymentsTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

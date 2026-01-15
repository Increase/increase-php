<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\FednowTransfers\FednowTransfer;
use Increase\FednowTransfers\FednowTransferCreateParams\CreditorAddress;
use Increase\FednowTransfers\FednowTransferCreateParams\DebtorAddress;
use Increase\FednowTransfers\FednowTransferListParams\CreatedAt;
use Increase\FednowTransfers\FednowTransferListParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\FednowTransfersContract;

/**
 * @phpstan-import-type CreditorAddressShape from \Increase\FednowTransfers\FednowTransferCreateParams\CreditorAddress
 * @phpstan-import-type DebtorAddressShape from \Increase\FednowTransfers\FednowTransferCreateParams\DebtorAddress
 * @phpstan-import-type CreatedAtShape from \Increase\FednowTransfers\FednowTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\FednowTransfers\FednowTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class FednowTransfersService implements FednowTransfersContract
{
    /**
     * @api
     */
    public FednowTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FednowTransfersRawService($client);
    }

    /**
     * @api
     *
     * Create a FedNow Transfer
     *
     * @param string $accountID the identifier for the account that will send the transfer
     * @param int $amount the amount, in minor units, to send to the creditor
     * @param string $creditorName the creditor's name
     * @param string $debtorName the debtor's name
     * @param string $sourceAccountNumberID the Account Number to include in the transfer as the debtor's account number
     * @param string $unstructuredRemittanceInformation unstructured remittance information to include in the transfer
     * @param string $accountNumber the creditor's account number
     * @param CreditorAddress|CreditorAddressShape $creditorAddress the creditor's address
     * @param DebtorAddress|DebtorAddressShape $debtorAddress the debtor's address
     * @param string $externalAccountID The ID of an External Account to initiate a transfer to. If this parameter is provided, `account_number` and `routing_number` must be absent.
     * @param bool $requireApproval whether the transfer requires explicit approval via the dashboard or API
     * @param string $routingNumber the creditor's bank account routing number
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        int $amount,
        string $creditorName,
        string $debtorName,
        string $sourceAccountNumberID,
        string $unstructuredRemittanceInformation,
        ?string $accountNumber = null,
        CreditorAddress|array|null $creditorAddress = null,
        DebtorAddress|array|null $debtorAddress = null,
        ?string $externalAccountID = null,
        ?bool $requireApproval = null,
        ?string $routingNumber = null,
        RequestOptions|array|null $requestOptions = null,
    ): FednowTransfer {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'amount' => $amount,
                'creditorName' => $creditorName,
                'debtorName' => $debtorName,
                'sourceAccountNumberID' => $sourceAccountNumberID,
                'unstructuredRemittanceInformation' => $unstructuredRemittanceInformation,
                'accountNumber' => $accountNumber,
                'creditorAddress' => $creditorAddress,
                'debtorAddress' => $debtorAddress,
                'externalAccountID' => $externalAccountID,
                'requireApproval' => $requireApproval,
                'routingNumber' => $routingNumber,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a FedNow Transfer
     *
     * @param string $fednowTransferID the identifier of the FedNow Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $fednowTransferID,
        RequestOptions|array|null $requestOptions = null
    ): FednowTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($fednowTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List FedNow Transfers
     *
     * @param string $accountID filter FedNow Transfers to those that originated from the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $externalAccountID filter FedNow Transfers to those made to the specified External Account
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<FednowTransfer>
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
     * Approve a FedNow Transfer
     *
     * @param string $fednowTransferID the identifier of the FedNow Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $fednowTransferID,
        RequestOptions|array|null $requestOptions = null
    ): FednowTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->approve($fednowTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a pending FedNow Transfer
     *
     * @param string $fednowTransferID the identifier of the pending FedNow Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $fednowTransferID,
        RequestOptions|array|null $requestOptions = null
    ): FednowTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($fednowTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

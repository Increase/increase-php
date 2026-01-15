<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\SwiftTransfersContract;
use Increase\SwiftTransfers\SwiftTransfer;
use Increase\SwiftTransfers\SwiftTransferCreateParams\CreditorAddress;
use Increase\SwiftTransfers\SwiftTransferCreateParams\DebtorAddress;
use Increase\SwiftTransfers\SwiftTransferCreateParams\InstructedCurrency;
use Increase\SwiftTransfers\SwiftTransferListParams\CreatedAt;
use Increase\SwiftTransfers\SwiftTransferListParams\Status;

/**
 * @phpstan-import-type CreditorAddressShape from \Increase\SwiftTransfers\SwiftTransferCreateParams\CreditorAddress
 * @phpstan-import-type DebtorAddressShape from \Increase\SwiftTransfers\SwiftTransferCreateParams\DebtorAddress
 * @phpstan-import-type CreatedAtShape from \Increase\SwiftTransfers\SwiftTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\SwiftTransfers\SwiftTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class SwiftTransfersService implements SwiftTransfersContract
{
    /**
     * @api
     */
    public SwiftTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SwiftTransfersRawService($client);
    }

    /**
     * @api
     *
     * Create a Swift Transfer
     *
     * @param string $accountID the identifier for the account that will send the transfer
     * @param string $accountNumber the creditor's account number
     * @param string $bankIdentificationCode The bank identification code (BIC) of the creditor. If it ends with the three-character branch code, this must be 11 characters long. Otherwise this must be 8 characters and the branch code will be assumed to be `XXX`.
     * @param CreditorAddress|CreditorAddressShape $creditorAddress the creditor's address
     * @param string $creditorName the creditor's name
     * @param DebtorAddress|DebtorAddressShape $debtorAddress the debtor's address
     * @param string $debtorName the debtor's name
     * @param int $instructedAmount the amount, in minor units of `instructed_currency`, to send to the creditor
     * @param InstructedCurrency|value-of<InstructedCurrency> $instructedCurrency The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code of the instructed amount.
     * @param string $sourceAccountNumberID the Account Number to include in the transfer as the debtor's account number
     * @param string $unstructuredRemittanceInformation unstructured remittance information to include in the transfer
     * @param bool $requireApproval whether the transfer requires explicit approval via the dashboard or API
     * @param string $routingNumber The creditor's bank account routing or transit number. Required in certain countries.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        string $accountNumber,
        string $bankIdentificationCode,
        CreditorAddress|array $creditorAddress,
        string $creditorName,
        DebtorAddress|array $debtorAddress,
        string $debtorName,
        int $instructedAmount,
        InstructedCurrency|string $instructedCurrency,
        string $sourceAccountNumberID,
        string $unstructuredRemittanceInformation,
        ?bool $requireApproval = null,
        ?string $routingNumber = null,
        RequestOptions|array|null $requestOptions = null,
    ): SwiftTransfer {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'accountNumber' => $accountNumber,
                'bankIdentificationCode' => $bankIdentificationCode,
                'creditorAddress' => $creditorAddress,
                'creditorName' => $creditorName,
                'debtorAddress' => $debtorAddress,
                'debtorName' => $debtorName,
                'instructedAmount' => $instructedAmount,
                'instructedCurrency' => $instructedCurrency,
                'sourceAccountNumberID' => $sourceAccountNumberID,
                'unstructuredRemittanceInformation' => $unstructuredRemittanceInformation,
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
     * Retrieve a Swift Transfer
     *
     * @param string $swiftTransferID the identifier of the Swift Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): SwiftTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($swiftTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Swift Transfers
     *
     * @param string $accountID filter Swift Transfers to those that originated from the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<SwiftTransfer>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
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
     * Approve a Swift Transfer
     *
     * @param string $swiftTransferID the identifier of the Swift Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): SwiftTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->approve($swiftTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a pending Swift Transfer
     *
     * @param string $swiftTransferID the identifier of the pending Swift Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): SwiftTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($swiftTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

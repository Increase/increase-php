<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;
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
interface SwiftTransfersContract
{
    /**
     * @api
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
    ): SwiftTransfer;

    /**
     * @api
     *
     * @param string $swiftTransferID the identifier of the Swift Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): SwiftTransfer;

    /**
     * @api
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
    ): Page;

    /**
     * @api
     *
     * @param string $swiftTransferID the identifier of the Swift Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): SwiftTransfer;

    /**
     * @api
     *
     * @param string $swiftTransferID the identifier of the pending Swift Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $swiftTransferID,
        RequestOptions|array|null $requestOptions = null
    ): SwiftTransfer;
}

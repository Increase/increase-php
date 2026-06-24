<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\ACHTransfers\ACHTransfer;
use Increase\ACHTransfers\ACHTransferCreateParams\Addenda;
use Increase\ACHTransfers\ACHTransferCreateParams\DestinationAccountHolder;
use Increase\ACHTransfers\ACHTransferCreateParams\Funding;
use Increase\ACHTransfers\ACHTransferCreateParams\PreferredEffectiveDate;
use Increase\ACHTransfers\ACHTransferCreateParams\StandardEntryClassCode;
use Increase\ACHTransfers\ACHTransferCreateParams\TransactionTiming;
use Increase\ACHTransfers\ACHTransferListParams\CreatedAt;
use Increase\ACHTransfers\ACHTransferListParams\Status;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type AddendaShape from \Increase\ACHTransfers\ACHTransferCreateParams\Addenda
 * @phpstan-import-type PreferredEffectiveDateShape from \Increase\ACHTransfers\ACHTransferCreateParams\PreferredEffectiveDate
 * @phpstan-import-type CreatedAtShape from \Increase\ACHTransfers\ACHTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\ACHTransfers\ACHTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ACHTransfersContract
{
    /**
     * @api
     *
     * @param string $accountID the Increase identifier for the account that will send the transfer
     * @param int $amount The transfer amount in USD cents. A positive amount originates a credit transfer pushing funds to the receiving account. A negative amount originates a debit transfer pulling funds from the receiving account.
     * @param string $statementDescriptor A description you choose to give the transfer. This will be saved with the transfer details, displayed in the dashboard, and returned by the API. If `individual_name` and `company_name` are not explicitly set by this API, the `statement_descriptor` will be sent in those fields to the receiving bank to help the customer recognize the transfer. You are highly encouraged to pass `individual_name` and `company_name` instead of relying on this fallback.
     * @param string $accountNumber The receiver's account number. For credit transfers (positive `amount`) this is the account that funds will be sent to. For debit transfers (negative `amount`) this is the account that funds will be pulled from.
     * @param Addenda|AddendaShape $addenda Additional information passed through to the receiving bank with the transfer. Most ACH transfers do not need this. Only set this if your recipient has asked for addendum data, typically unstructured remittance information. Corporate Trade Exchange (CTX) flows can carry structured X12 remittance advice instead.
     * @param string $companyDescriptiveDate A description of the transfer date (typically `YYMMDD`), sent in the company batch header. This value is informational and does not affect funds movement, settlement timing, or returns. Only set this if your recipient has asked for it.
     * @param string $companyDiscretionaryData Custom data sent in the company batch header. This value is informational and does not affect funds movement, settlement timing, or returns. Most ACH transfers do not need this. Only set this if your recipient has asked for it.
     * @param string $companyEntryDescription A short description sent in the company batch header. Most receivers do not surface this. Only set this if your recipient has asked for a specific value or if Nacha mandates one for your Standard Entry Class (SEC) code and use case. For example, Prearranged Payment and Deposit (PPD) payroll credits must use `PAYROLL`, and reversals must use `REVERSAL`.
     * @param string $companyName The name by which the recipient knows you, sent in the company batch header. We recommend setting this on every transfer; if you do not, we fall back to the ACH company name configured on your account.
     * @param DestinationAccountHolder|value-of<DestinationAccountHolder> $destinationAccountHolder the type of entity that owns the receiver's account
     * @param string $externalAccountID The ID of an External Account to initiate a transfer to. If this parameter is provided, `account_number`, `routing_number`, and `funding` must be absent.
     * @param Funding|value-of<Funding> $funding the type of the receiver's bank account
     * @param string $individualID Your internal identifier for the transfer recipient. This value is informational and not verified by the recipient's bank. Most callers can leave this unset.
     * @param string $individualName The name of the transfer recipient. This value is informational and not verified by the recipient's bank.
     * @param PreferredEffectiveDate|PreferredEffectiveDateShape $preferredEffectiveDate Configuration for how the effective date of the transfer will be set. This determines same-day vs future-dated settlement timing. If not set, defaults to a `settlement_schedule` of `same_day`. If set, exactly one of the child attributes must be set.
     * @param bool $requireApproval whether the transfer requires explicit approval via the dashboard or API
     * @param string $routingNumber the American Bankers' Association (ABA) Routing Transit Number (RTN) of the receiver's bank
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode> $standardEntryClassCode The [Standard Entry Class (SEC) code](/documentation/ach-standard-entry-class-codes) to use for the transfer. If not provided, the default is `corporate_credit_or_debit`.
     * @param TransactionTiming|value-of<TransactionTiming> $transactionTiming the timing of the transaction
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        int $amount,
        string $statementDescriptor,
        ?string $accountNumber = null,
        Addenda|array|null $addenda = null,
        ?string $companyDescriptiveDate = null,
        ?string $companyDiscretionaryData = null,
        ?string $companyEntryDescription = null,
        ?string $companyName = null,
        DestinationAccountHolder|string|null $destinationAccountHolder = null,
        ?string $externalAccountID = null,
        Funding|string|null $funding = null,
        ?string $individualID = null,
        ?string $individualName = null,
        PreferredEffectiveDate|array|null $preferredEffectiveDate = null,
        ?bool $requireApproval = null,
        ?string $routingNumber = null,
        StandardEntryClassCode|string|null $standardEntryClassCode = null,
        TransactionTiming|string|null $transactionTiming = null,
        RequestOptions|array|null $requestOptions = null,
    ): ACHTransfer;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): ACHTransfer;

    /**
     * @api
     *
     * @param string $accountID filter ACH Transfers to those that originated from the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $externalAccountID filter ACH Transfers to those made to the specified External Account
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<ACHTransfer>
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
    ): Page;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): ACHTransfer;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the pending ACH Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): ACHTransfer;
}

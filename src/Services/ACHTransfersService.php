<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\ACHTransfers\ACHTransfer;
use Increase\ACHTransfers\ACHTransferCreateParams\Addenda;
use Increase\ACHTransfers\ACHTransferCreateParams\DestinationAccountHolder;
use Increase\ACHTransfers\ACHTransferCreateParams\Funding;
use Increase\ACHTransfers\ACHTransferCreateParams\PreferredEffectiveDate;
use Increase\ACHTransfers\ACHTransferCreateParams\StandardEntryClassCode;
use Increase\ACHTransfers\ACHTransferCreateParams\TransactionTiming;
use Increase\ACHTransfers\ACHTransferListParams\CreatedAt;
use Increase\ACHTransfers\ACHTransferListParams\Status;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\ACHTransfersContract;

/**
 * @phpstan-import-type AddendaShape from \Increase\ACHTransfers\ACHTransferCreateParams\Addenda
 * @phpstan-import-type PreferredEffectiveDateShape from \Increase\ACHTransfers\ACHTransferCreateParams\PreferredEffectiveDate
 * @phpstan-import-type CreatedAtShape from \Increase\ACHTransfers\ACHTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\ACHTransfers\ACHTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class ACHTransfersService implements ACHTransfersContract
{
    /**
     * @api
     */
    public ACHTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ACHTransfersRawService($client);
    }

    /**
     * @api
     *
     * Create an ACH Transfer
     *
     * @param string $accountID the Increase identifier for the account that will send the transfer
     * @param int $amount The transfer amount in USD cents. A positive amount originates a credit transfer pushing funds to the receiving account. A negative amount originates a debit transfer pulling funds from the receiving account.
     * @param string $statementDescriptor A description you choose to give the transfer. This will be saved with the transfer details, displayed in the dashboard, and returned by the API. If `individual_name` and `company_name` are not explicitly set by this API, the `statement_descriptor` will be sent in those fields to the receiving bank to help the customer recognize the transfer. You are highly encouraged to pass `individual_name` and `company_name` instead of relying on this fallback.
     * @param string $accountNumber the account number for the destination account
     * @param Addenda|AddendaShape $addenda Additional information that will be sent to the recipient. This is included in the transfer data sent to the receiving bank.
     * @param string $companyDescriptiveDate The description of the date of the transfer, usually in the format `YYMMDD`. This is included in the transfer data sent to the receiving bank.
     * @param string $companyDiscretionaryData The data you choose to associate with the transfer. This is included in the transfer data sent to the receiving bank.
     * @param string $companyEntryDescription A description of the transfer. This is included in the transfer data sent to the receiving bank.
     * @param string $companyName The name by which the recipient knows you. This is included in the transfer data sent to the receiving bank.
     * @param DestinationAccountHolder|value-of<DestinationAccountHolder> $destinationAccountHolder the type of entity that owns the account to which the ACH Transfer is being sent
     * @param string $externalAccountID The ID of an External Account to initiate a transfer to. If this parameter is provided, `account_number`, `routing_number`, and `funding` must be absent.
     * @param Funding|value-of<Funding> $funding the type of the account to which the transfer will be sent
     * @param string $individualID your identifier for the transfer recipient
     * @param string $individualName The name of the transfer recipient. This value is informational and not verified by the recipient's bank.
     * @param PreferredEffectiveDate|PreferredEffectiveDateShape $preferredEffectiveDate Configuration for how the effective date of the transfer will be set. This determines same-day vs future-dated settlement timing. If not set, defaults to a `settlement_schedule` of `same_day`. If set, exactly one of the child attributes must be set.
     * @param bool $requireApproval whether the transfer requires explicit approval via the dashboard or API
     * @param string $routingNumber the American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode> $standardEntryClassCode the Standard Entry Class (SEC) code to use for the transfer
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
    ): ACHTransfer {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'amount' => $amount,
                'statementDescriptor' => $statementDescriptor,
                'accountNumber' => $accountNumber,
                'addenda' => $addenda,
                'companyDescriptiveDate' => $companyDescriptiveDate,
                'companyDiscretionaryData' => $companyDiscretionaryData,
                'companyEntryDescription' => $companyEntryDescription,
                'companyName' => $companyName,
                'destinationAccountHolder' => $destinationAccountHolder,
                'externalAccountID' => $externalAccountID,
                'funding' => $funding,
                'individualID' => $individualID,
                'individualName' => $individualName,
                'preferredEffectiveDate' => $preferredEffectiveDate,
                'requireApproval' => $requireApproval,
                'routingNumber' => $routingNumber,
                'standardEntryClassCode' => $standardEntryClassCode,
                'transactionTiming' => $transactionTiming,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve an ACH Transfer
     *
     * @param string $achTransferID the identifier of the ACH Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): ACHTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($achTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List ACH Transfers
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
     * Approves an ACH Transfer in a pending_approval state.
     *
     * @param string $achTransferID the identifier of the ACH Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): ACHTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->approve($achTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancels an ACH Transfer in a pending_approval state.
     *
     * @param string $achTransferID the identifier of the pending ACH Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): ACHTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($achTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

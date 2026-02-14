<?php

declare(strict_types=1);

namespace Increase\ACHTransfers;

use Increase\ACHTransfers\ACHTransfer\Acknowledgement;
use Increase\ACHTransfers\ACHTransfer\Addenda;
use Increase\ACHTransfers\ACHTransfer\Approval;
use Increase\ACHTransfers\ACHTransfer\Cancellation;
use Increase\ACHTransfers\ACHTransfer\CreatedBy;
use Increase\ACHTransfers\ACHTransfer\Currency;
use Increase\ACHTransfers\ACHTransfer\DestinationAccountHolder;
use Increase\ACHTransfers\ACHTransfer\Funding;
use Increase\ACHTransfers\ACHTransfer\InboundFundsHold;
use Increase\ACHTransfers\ACHTransfer\Network;
use Increase\ACHTransfers\ACHTransfer\NotificationsOfChange;
use Increase\ACHTransfers\ACHTransfer\PreferredEffectiveDate;
use Increase\ACHTransfers\ACHTransfer\Return_;
use Increase\ACHTransfers\ACHTransfer\Settlement;
use Increase\ACHTransfers\ACHTransfer\StandardEntryClassCode;
use Increase\ACHTransfers\ACHTransfer\Status;
use Increase\ACHTransfers\ACHTransfer\Submission;
use Increase\ACHTransfers\ACHTransfer\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * ACH transfers move funds between your Increase account and any other account accessible by the Automated Clearing House (ACH).
 *
 * @phpstan-import-type AcknowledgementShape from \Increase\ACHTransfers\ACHTransfer\Acknowledgement
 * @phpstan-import-type AddendaShape from \Increase\ACHTransfers\ACHTransfer\Addenda
 * @phpstan-import-type ApprovalShape from \Increase\ACHTransfers\ACHTransfer\Approval
 * @phpstan-import-type CancellationShape from \Increase\ACHTransfers\ACHTransfer\Cancellation
 * @phpstan-import-type CreatedByShape from \Increase\ACHTransfers\ACHTransfer\CreatedBy
 * @phpstan-import-type InboundFundsHoldShape from \Increase\ACHTransfers\ACHTransfer\InboundFundsHold
 * @phpstan-import-type NotificationsOfChangeShape from \Increase\ACHTransfers\ACHTransfer\NotificationsOfChange
 * @phpstan-import-type PreferredEffectiveDateShape from \Increase\ACHTransfers\ACHTransfer\PreferredEffectiveDate
 * @phpstan-import-type ReturnShape from \Increase\ACHTransfers\ACHTransfer\Return_
 * @phpstan-import-type SettlementShape from \Increase\ACHTransfers\ACHTransfer\Settlement
 * @phpstan-import-type SubmissionShape from \Increase\ACHTransfers\ACHTransfer\Submission
 *
 * @phpstan-type ACHTransferShape = array{
 *   id: string,
 *   accountID: string,
 *   accountNumber: string,
 *   acknowledgement: null|Acknowledgement|AcknowledgementShape,
 *   addenda: null|Addenda|AddendaShape,
 *   amount: int,
 *   approval: null|Approval|ApprovalShape,
 *   cancellation: null|Cancellation|CancellationShape,
 *   companyDescriptiveDate: string|null,
 *   companyDiscretionaryData: string|null,
 *   companyEntryDescription: string|null,
 *   companyID: string,
 *   companyName: string|null,
 *   createdAt: \DateTimeInterface,
 *   createdBy: null|CreatedBy|CreatedByShape,
 *   currency: Currency|value-of<Currency>,
 *   destinationAccountHolder: DestinationAccountHolder|value-of<DestinationAccountHolder>,
 *   externalAccountID: string|null,
 *   funding: Funding|value-of<Funding>,
 *   idempotencyKey: string|null,
 *   inboundFundsHold: null|InboundFundsHold|InboundFundsHoldShape,
 *   individualID: string|null,
 *   individualName: string|null,
 *   network: Network|value-of<Network>,
 *   notificationsOfChange: list<NotificationsOfChange|NotificationsOfChangeShape>,
 *   pendingTransactionID: string|null,
 *   preferredEffectiveDate: PreferredEffectiveDate|PreferredEffectiveDateShape,
 *   return: null|Return_|ReturnShape,
 *   routingNumber: string,
 *   settlement: null|Settlement|SettlementShape,
 *   standardEntryClassCode: StandardEntryClassCode|value-of<StandardEntryClassCode>,
 *   statementDescriptor: string,
 *   status: Status|value-of<Status>,
 *   submission: null|Submission|SubmissionShape,
 *   transactionID: string|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class ACHTransfer implements BaseModel
{
    /** @use SdkModel<ACHTransferShape> */
    use SdkModel;

    /**
     * The ACH transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The Account to which the transfer belongs.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The destination account number.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * After the transfer is acknowledged by FedACH, this will contain supplemental details. The Federal Reserve sends an acknowledgement message for each file that Increase submits.
     */
    #[Required]
    public ?Acknowledgement $acknowledgement;

    /**
     * Additional information that will be sent to the recipient.
     */
    #[Required]
    public ?Addenda $addenda;

    /**
     * The transfer amount in USD cents. A positive amount indicates a credit transfer pushing funds to the receiving account. A negative amount indicates a debit transfer pulling funds from the receiving account.
     */
    #[Required]
    public int $amount;

    /**
     * If your account requires approvals for transfers and the transfer was approved, this will contain details of the approval.
     */
    #[Required]
    public ?Approval $approval;

    /**
     * If your account requires approvals for transfers and the transfer was not approved, this will contain details of the cancellation.
     */
    #[Required]
    public ?Cancellation $cancellation;

    /**
     * The description of the date of the transfer.
     */
    #[Required('company_descriptive_date')]
    public ?string $companyDescriptiveDate;

    /**
     * The data you chose to associate with the transfer.
     */
    #[Required('company_discretionary_data')]
    public ?string $companyDiscretionaryData;

    /**
     * The description of the transfer you set to be shown to the recipient.
     */
    #[Required('company_entry_description')]
    public ?string $companyEntryDescription;

    /**
     * The company ID associated with the transfer.
     */
    #[Required('company_id')]
    public string $companyID;

    /**
     * The name by which the recipient knows you.
     */
    #[Required('company_name')]
    public ?string $companyName;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * What object created the transfer, either via the API or the dashboard.
     */
    #[Required('created_by')]
    public ?CreatedBy $createdBy;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency. For ACH transfers this is always equal to `usd`.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The type of entity that owns the account to which the ACH Transfer is being sent.
     *
     * @var value-of<DestinationAccountHolder> $destinationAccountHolder
     */
    #[Required(
        'destination_account_holder',
        enum: DestinationAccountHolder::class
    )]
    public string $destinationAccountHolder;

    /**
     * The identifier of the External Account the transfer was made to, if any.
     */
    #[Required('external_account_id')]
    public ?string $externalAccountID;

    /**
     * The type of the account to which the transfer will be sent.
     *
     * @var value-of<Funding> $funding
     */
    #[Required(enum: Funding::class)]
    public string $funding;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * Increase will sometimes hold the funds for ACH debit transfers. If funds are held, this sub-object will contain details of the hold.
     */
    #[Required('inbound_funds_hold')]
    public ?InboundFundsHold $inboundFundsHold;

    /**
     * Your identifier for the transfer recipient.
     */
    #[Required('individual_id')]
    public ?string $individualID;

    /**
     * The name of the transfer recipient. This value is informational and not verified by the recipient's bank.
     */
    #[Required('individual_name')]
    public ?string $individualName;

    /**
     * The transfer's network.
     *
     * @var value-of<Network> $network
     */
    #[Required(enum: Network::class)]
    public string $network;

    /**
     * If the receiving bank accepts the transfer but notifies that future transfers should use different details, this will contain those details.
     *
     * @var list<NotificationsOfChange> $notificationsOfChange
     */
    #[Required('notifications_of_change', list: NotificationsOfChange::class)]
    public array $notificationsOfChange;

    /**
     * The ID for the pending transaction representing the transfer. A pending transaction is created when the transfer [requires approval](https://increase.com/documentation/transfer-approvals#transfer-approvals) by someone else in your organization.
     */
    #[Required('pending_transaction_id')]
    public ?string $pendingTransactionID;

    /**
     * Configuration for how the effective date of the transfer will be set. This determines same-day vs future-dated settlement timing. If not set, defaults to a `settlement_schedule` of `same_day`. If set, exactly one of the child attributes must be set.
     */
    #[Required('preferred_effective_date')]
    public PreferredEffectiveDate $preferredEffectiveDate;

    /**
     * If your transfer is returned, this will contain details of the return.
     */
    #[Required]
    public ?Return_ $return;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * A subhash containing information about when and how the transfer settled at the Federal Reserve.
     */
    #[Required]
    public ?Settlement $settlement;

    /**
     * The [Standard Entry Class (SEC) code](/documentation/ach-standard-entry-class-codes) to use for the transfer.
     *
     * @var value-of<StandardEntryClassCode> $standardEntryClassCode
     */
    #[Required('standard_entry_class_code', enum: StandardEntryClassCode::class)]
    public string $standardEntryClassCode;

    /**
     * The descriptor that will show on the recipient's bank statement.
     */
    #[Required('statement_descriptor')]
    public string $statementDescriptor;

    /**
     * The lifecycle status of the transfer.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * After the transfer is submitted to FedACH, this will contain supplemental details. Increase batches transfers and submits a file to the Federal Reserve roughly every 30 minutes. The Federal Reserve processes ACH transfers during weekdays according to their [posted schedule](https://www.frbservices.org/resources/resource-centers/same-day-ach/fedach-processing-schedule.html).
     */
    #[Required]
    public ?Submission $submission;

    /**
     * The ID for the transaction funding the transfer.
     */
    #[Required('transaction_id')]
    public ?string $transactionID;

    /**
     * A constant representing the object's type. For this resource it will always be `ach_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new ACHTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ACHTransfer::with(
     *   id: ...,
     *   accountID: ...,
     *   accountNumber: ...,
     *   acknowledgement: ...,
     *   addenda: ...,
     *   amount: ...,
     *   approval: ...,
     *   cancellation: ...,
     *   companyDescriptiveDate: ...,
     *   companyDiscretionaryData: ...,
     *   companyEntryDescription: ...,
     *   companyID: ...,
     *   companyName: ...,
     *   createdAt: ...,
     *   createdBy: ...,
     *   currency: ...,
     *   destinationAccountHolder: ...,
     *   externalAccountID: ...,
     *   funding: ...,
     *   idempotencyKey: ...,
     *   inboundFundsHold: ...,
     *   individualID: ...,
     *   individualName: ...,
     *   network: ...,
     *   notificationsOfChange: ...,
     *   pendingTransactionID: ...,
     *   preferredEffectiveDate: ...,
     *   return: ...,
     *   routingNumber: ...,
     *   settlement: ...,
     *   standardEntryClassCode: ...,
     *   statementDescriptor: ...,
     *   status: ...,
     *   submission: ...,
     *   transactionID: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ACHTransfer)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAccountNumber(...)
     *   ->withAcknowledgement(...)
     *   ->withAddenda(...)
     *   ->withAmount(...)
     *   ->withApproval(...)
     *   ->withCancellation(...)
     *   ->withCompanyDescriptiveDate(...)
     *   ->withCompanyDiscretionaryData(...)
     *   ->withCompanyEntryDescription(...)
     *   ->withCompanyID(...)
     *   ->withCompanyName(...)
     *   ->withCreatedAt(...)
     *   ->withCreatedBy(...)
     *   ->withCurrency(...)
     *   ->withDestinationAccountHolder(...)
     *   ->withExternalAccountID(...)
     *   ->withFunding(...)
     *   ->withIdempotencyKey(...)
     *   ->withInboundFundsHold(...)
     *   ->withIndividualID(...)
     *   ->withIndividualName(...)
     *   ->withNetwork(...)
     *   ->withNotificationsOfChange(...)
     *   ->withPendingTransactionID(...)
     *   ->withPreferredEffectiveDate(...)
     *   ->withReturn(...)
     *   ->withRoutingNumber(...)
     *   ->withSettlement(...)
     *   ->withStandardEntryClassCode(...)
     *   ->withStatementDescriptor(...)
     *   ->withStatus(...)
     *   ->withSubmission(...)
     *   ->withTransactionID(...)
     *   ->withType(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Acknowledgement|AcknowledgementShape|null $acknowledgement
     * @param Addenda|AddendaShape|null $addenda
     * @param Approval|ApprovalShape|null $approval
     * @param Cancellation|CancellationShape|null $cancellation
     * @param CreatedBy|CreatedByShape|null $createdBy
     * @param Currency|value-of<Currency> $currency
     * @param DestinationAccountHolder|value-of<DestinationAccountHolder> $destinationAccountHolder
     * @param Funding|value-of<Funding> $funding
     * @param InboundFundsHold|InboundFundsHoldShape|null $inboundFundsHold
     * @param Network|value-of<Network> $network
     * @param list<NotificationsOfChange|NotificationsOfChangeShape> $notificationsOfChange
     * @param PreferredEffectiveDate|PreferredEffectiveDateShape $preferredEffectiveDate
     * @param Return_|ReturnShape|null $return
     * @param Settlement|SettlementShape|null $settlement
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode> $standardEntryClassCode
     * @param Status|value-of<Status> $status
     * @param Submission|SubmissionShape|null $submission
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $accountNumber,
        Acknowledgement|array|null $acknowledgement,
        Addenda|array|null $addenda,
        int $amount,
        Approval|array|null $approval,
        Cancellation|array|null $cancellation,
        ?string $companyDescriptiveDate,
        ?string $companyDiscretionaryData,
        ?string $companyEntryDescription,
        string $companyID,
        ?string $companyName,
        \DateTimeInterface $createdAt,
        CreatedBy|array|null $createdBy,
        Currency|string $currency,
        DestinationAccountHolder|string $destinationAccountHolder,
        ?string $externalAccountID,
        Funding|string $funding,
        ?string $idempotencyKey,
        InboundFundsHold|array|null $inboundFundsHold,
        ?string $individualID,
        ?string $individualName,
        Network|string $network,
        array $notificationsOfChange,
        ?string $pendingTransactionID,
        PreferredEffectiveDate|array $preferredEffectiveDate,
        Return_|array|null $return,
        string $routingNumber,
        Settlement|array|null $settlement,
        StandardEntryClassCode|string $standardEntryClassCode,
        string $statementDescriptor,
        Status|string $status,
        Submission|array|null $submission,
        ?string $transactionID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['accountNumber'] = $accountNumber;
        $self['acknowledgement'] = $acknowledgement;
        $self['addenda'] = $addenda;
        $self['amount'] = $amount;
        $self['approval'] = $approval;
        $self['cancellation'] = $cancellation;
        $self['companyDescriptiveDate'] = $companyDescriptiveDate;
        $self['companyDiscretionaryData'] = $companyDiscretionaryData;
        $self['companyEntryDescription'] = $companyEntryDescription;
        $self['companyID'] = $companyID;
        $self['companyName'] = $companyName;
        $self['createdAt'] = $createdAt;
        $self['createdBy'] = $createdBy;
        $self['currency'] = $currency;
        $self['destinationAccountHolder'] = $destinationAccountHolder;
        $self['externalAccountID'] = $externalAccountID;
        $self['funding'] = $funding;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['inboundFundsHold'] = $inboundFundsHold;
        $self['individualID'] = $individualID;
        $self['individualName'] = $individualName;
        $self['network'] = $network;
        $self['notificationsOfChange'] = $notificationsOfChange;
        $self['pendingTransactionID'] = $pendingTransactionID;
        $self['preferredEffectiveDate'] = $preferredEffectiveDate;
        $self['return'] = $return;
        $self['routingNumber'] = $routingNumber;
        $self['settlement'] = $settlement;
        $self['standardEntryClassCode'] = $standardEntryClassCode;
        $self['statementDescriptor'] = $statementDescriptor;
        $self['status'] = $status;
        $self['submission'] = $submission;
        $self['transactionID'] = $transactionID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The ACH transfer's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The Account to which the transfer belongs.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The destination account number.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * After the transfer is acknowledged by FedACH, this will contain supplemental details. The Federal Reserve sends an acknowledgement message for each file that Increase submits.
     *
     * @param Acknowledgement|AcknowledgementShape|null $acknowledgement
     */
    public function withAcknowledgement(
        Acknowledgement|array|null $acknowledgement
    ): self {
        $self = clone $this;
        $self['acknowledgement'] = $acknowledgement;

        return $self;
    }

    /**
     * Additional information that will be sent to the recipient.
     *
     * @param Addenda|AddendaShape|null $addenda
     */
    public function withAddenda(Addenda|array|null $addenda): self
    {
        $self = clone $this;
        $self['addenda'] = $addenda;

        return $self;
    }

    /**
     * The transfer amount in USD cents. A positive amount indicates a credit transfer pushing funds to the receiving account. A negative amount indicates a debit transfer pulling funds from the receiving account.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * If your account requires approvals for transfers and the transfer was approved, this will contain details of the approval.
     *
     * @param Approval|ApprovalShape|null $approval
     */
    public function withApproval(Approval|array|null $approval): self
    {
        $self = clone $this;
        $self['approval'] = $approval;

        return $self;
    }

    /**
     * If your account requires approvals for transfers and the transfer was not approved, this will contain details of the cancellation.
     *
     * @param Cancellation|CancellationShape|null $cancellation
     */
    public function withCancellation(
        Cancellation|array|null $cancellation
    ): self {
        $self = clone $this;
        $self['cancellation'] = $cancellation;

        return $self;
    }

    /**
     * The description of the date of the transfer.
     */
    public function withCompanyDescriptiveDate(
        ?string $companyDescriptiveDate
    ): self {
        $self = clone $this;
        $self['companyDescriptiveDate'] = $companyDescriptiveDate;

        return $self;
    }

    /**
     * The data you chose to associate with the transfer.
     */
    public function withCompanyDiscretionaryData(
        ?string $companyDiscretionaryData
    ): self {
        $self = clone $this;
        $self['companyDiscretionaryData'] = $companyDiscretionaryData;

        return $self;
    }

    /**
     * The description of the transfer you set to be shown to the recipient.
     */
    public function withCompanyEntryDescription(
        ?string $companyEntryDescription
    ): self {
        $self = clone $this;
        $self['companyEntryDescription'] = $companyEntryDescription;

        return $self;
    }

    /**
     * The company ID associated with the transfer.
     */
    public function withCompanyID(string $companyID): self
    {
        $self = clone $this;
        $self['companyID'] = $companyID;

        return $self;
    }

    /**
     * The name by which the recipient knows you.
     */
    public function withCompanyName(?string $companyName): self
    {
        $self = clone $this;
        $self['companyName'] = $companyName;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the transfer was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * What object created the transfer, either via the API or the dashboard.
     *
     * @param CreatedBy|CreatedByShape|null $createdBy
     */
    public function withCreatedBy(CreatedBy|array|null $createdBy): self
    {
        $self = clone $this;
        $self['createdBy'] = $createdBy;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transfer's currency. For ACH transfers this is always equal to `usd`.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The type of entity that owns the account to which the ACH Transfer is being sent.
     *
     * @param DestinationAccountHolder|value-of<DestinationAccountHolder> $destinationAccountHolder
     */
    public function withDestinationAccountHolder(
        DestinationAccountHolder|string $destinationAccountHolder
    ): self {
        $self = clone $this;
        $self['destinationAccountHolder'] = $destinationAccountHolder;

        return $self;
    }

    /**
     * The identifier of the External Account the transfer was made to, if any.
     */
    public function withExternalAccountID(?string $externalAccountID): self
    {
        $self = clone $this;
        $self['externalAccountID'] = $externalAccountID;

        return $self;
    }

    /**
     * The type of the account to which the transfer will be sent.
     *
     * @param Funding|value-of<Funding> $funding
     */
    public function withFunding(Funding|string $funding): self
    {
        $self = clone $this;
        $self['funding'] = $funding;

        return $self;
    }

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * Increase will sometimes hold the funds for ACH debit transfers. If funds are held, this sub-object will contain details of the hold.
     *
     * @param InboundFundsHold|InboundFundsHoldShape|null $inboundFundsHold
     */
    public function withInboundFundsHold(
        InboundFundsHold|array|null $inboundFundsHold
    ): self {
        $self = clone $this;
        $self['inboundFundsHold'] = $inboundFundsHold;

        return $self;
    }

    /**
     * Your identifier for the transfer recipient.
     */
    public function withIndividualID(?string $individualID): self
    {
        $self = clone $this;
        $self['individualID'] = $individualID;

        return $self;
    }

    /**
     * The name of the transfer recipient. This value is informational and not verified by the recipient's bank.
     */
    public function withIndividualName(?string $individualName): self
    {
        $self = clone $this;
        $self['individualName'] = $individualName;

        return $self;
    }

    /**
     * The transfer's network.
     *
     * @param Network|value-of<Network> $network
     */
    public function withNetwork(Network|string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

        return $self;
    }

    /**
     * If the receiving bank accepts the transfer but notifies that future transfers should use different details, this will contain those details.
     *
     * @param list<NotificationsOfChange|NotificationsOfChangeShape> $notificationsOfChange
     */
    public function withNotificationsOfChange(
        array $notificationsOfChange
    ): self {
        $self = clone $this;
        $self['notificationsOfChange'] = $notificationsOfChange;

        return $self;
    }

    /**
     * The ID for the pending transaction representing the transfer. A pending transaction is created when the transfer [requires approval](https://increase.com/documentation/transfer-approvals#transfer-approvals) by someone else in your organization.
     */
    public function withPendingTransactionID(
        ?string $pendingTransactionID
    ): self {
        $self = clone $this;
        $self['pendingTransactionID'] = $pendingTransactionID;

        return $self;
    }

    /**
     * Configuration for how the effective date of the transfer will be set. This determines same-day vs future-dated settlement timing. If not set, defaults to a `settlement_schedule` of `same_day`. If set, exactly one of the child attributes must be set.
     *
     * @param PreferredEffectiveDate|PreferredEffectiveDateShape $preferredEffectiveDate
     */
    public function withPreferredEffectiveDate(
        PreferredEffectiveDate|array $preferredEffectiveDate
    ): self {
        $self = clone $this;
        $self['preferredEffectiveDate'] = $preferredEffectiveDate;

        return $self;
    }

    /**
     * If your transfer is returned, this will contain details of the return.
     *
     * @param Return_|ReturnShape|null $return
     */
    public function withReturn(Return_|array|null $return): self
    {
        $self = clone $this;
        $self['return'] = $return;

        return $self;
    }

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * A subhash containing information about when and how the transfer settled at the Federal Reserve.
     *
     * @param Settlement|SettlementShape|null $settlement
     */
    public function withSettlement(Settlement|array|null $settlement): self
    {
        $self = clone $this;
        $self['settlement'] = $settlement;

        return $self;
    }

    /**
     * The [Standard Entry Class (SEC) code](/documentation/ach-standard-entry-class-codes) to use for the transfer.
     *
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode> $standardEntryClassCode
     */
    public function withStandardEntryClassCode(
        StandardEntryClassCode|string $standardEntryClassCode
    ): self {
        $self = clone $this;
        $self['standardEntryClassCode'] = $standardEntryClassCode;

        return $self;
    }

    /**
     * The descriptor that will show on the recipient's bank statement.
     */
    public function withStatementDescriptor(string $statementDescriptor): self
    {
        $self = clone $this;
        $self['statementDescriptor'] = $statementDescriptor;

        return $self;
    }

    /**
     * The lifecycle status of the transfer.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * After the transfer is submitted to FedACH, this will contain supplemental details. Increase batches transfers and submits a file to the Federal Reserve roughly every 30 minutes. The Federal Reserve processes ACH transfers during weekdays according to their [posted schedule](https://www.frbservices.org/resources/resource-centers/same-day-ach/fedach-processing-schedule.html).
     *
     * @param Submission|SubmissionShape|null $submission
     */
    public function withSubmission(Submission|array|null $submission): self
    {
        $self = clone $this;
        $self['submission'] = $submission;

        return $self;
    }

    /**
     * The ID for the transaction funding the transfer.
     */
    public function withTransactionID(?string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `ach_transfer`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}

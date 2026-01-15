<?php

declare(strict_types=1);

namespace Increase\ACHTransfers;

use Increase\ACHTransfers\ACHTransferCreateParams\Addenda;
use Increase\ACHTransfers\ACHTransferCreateParams\DestinationAccountHolder;
use Increase\ACHTransfers\ACHTransferCreateParams\Funding;
use Increase\ACHTransfers\ACHTransferCreateParams\PreferredEffectiveDate;
use Increase\ACHTransfers\ACHTransferCreateParams\StandardEntryClassCode;
use Increase\ACHTransfers\ACHTransferCreateParams\TransactionTiming;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create an ACH Transfer.
 *
 * @see Increase\Services\ACHTransfersService::create()
 *
 * @phpstan-import-type AddendaShape from \Increase\ACHTransfers\ACHTransferCreateParams\Addenda
 * @phpstan-import-type PreferredEffectiveDateShape from \Increase\ACHTransfers\ACHTransferCreateParams\PreferredEffectiveDate
 *
 * @phpstan-type ACHTransferCreateParamsShape = array{
 *   accountID: string,
 *   amount: int,
 *   statementDescriptor: string,
 *   accountNumber?: string|null,
 *   addenda?: null|Addenda|AddendaShape,
 *   companyDescriptiveDate?: string|null,
 *   companyDiscretionaryData?: string|null,
 *   companyEntryDescription?: string|null,
 *   companyName?: string|null,
 *   destinationAccountHolder?: null|DestinationAccountHolder|value-of<DestinationAccountHolder>,
 *   externalAccountID?: string|null,
 *   funding?: null|Funding|value-of<Funding>,
 *   individualID?: string|null,
 *   individualName?: string|null,
 *   preferredEffectiveDate?: null|PreferredEffectiveDate|PreferredEffectiveDateShape,
 *   requireApproval?: bool|null,
 *   routingNumber?: string|null,
 *   standardEntryClassCode?: null|StandardEntryClassCode|value-of<StandardEntryClassCode>,
 *   transactionTiming?: null|TransactionTiming|value-of<TransactionTiming>,
 * }
 */
final class ACHTransferCreateParams implements BaseModel
{
    /** @use SdkModel<ACHTransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The Increase identifier for the account that will send the transfer.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The transfer amount in USD cents. A positive amount originates a credit transfer pushing funds to the receiving account. A negative amount originates a debit transfer pulling funds from the receiving account.
     */
    #[Required]
    public int $amount;

    /**
     * A description you choose to give the transfer. This will be saved with the transfer details, displayed in the dashboard, and returned by the API. If `individual_name` and `company_name` are not explicitly set by this API, the `statement_descriptor` will be sent in those fields to the receiving bank to help the customer recognize the transfer. You are highly encouraged to pass `individual_name` and `company_name` instead of relying on this fallback.
     */
    #[Required('statement_descriptor')]
    public string $statementDescriptor;

    /**
     * The account number for the destination account.
     */
    #[Optional('account_number')]
    public ?string $accountNumber;

    /**
     * Additional information that will be sent to the recipient. This is included in the transfer data sent to the receiving bank.
     */
    #[Optional]
    public ?Addenda $addenda;

    /**
     * The description of the date of the transfer, usually in the format `YYMMDD`. This is included in the transfer data sent to the receiving bank.
     */
    #[Optional('company_descriptive_date')]
    public ?string $companyDescriptiveDate;

    /**
     * The data you choose to associate with the transfer. This is included in the transfer data sent to the receiving bank.
     */
    #[Optional('company_discretionary_data')]
    public ?string $companyDiscretionaryData;

    /**
     * A description of the transfer. This is included in the transfer data sent to the receiving bank.
     */
    #[Optional('company_entry_description')]
    public ?string $companyEntryDescription;

    /**
     * The name by which the recipient knows you. This is included in the transfer data sent to the receiving bank.
     */
    #[Optional('company_name')]
    public ?string $companyName;

    /**
     * The type of entity that owns the account to which the ACH Transfer is being sent.
     *
     * @var value-of<DestinationAccountHolder>|null $destinationAccountHolder
     */
    #[Optional(
        'destination_account_holder',
        enum: DestinationAccountHolder::class
    )]
    public ?string $destinationAccountHolder;

    /**
     * The ID of an External Account to initiate a transfer to. If this parameter is provided, `account_number`, `routing_number`, and `funding` must be absent.
     */
    #[Optional('external_account_id')]
    public ?string $externalAccountID;

    /**
     * The type of the account to which the transfer will be sent.
     *
     * @var value-of<Funding>|null $funding
     */
    #[Optional(enum: Funding::class)]
    public ?string $funding;

    /**
     * Your identifier for the transfer recipient.
     */
    #[Optional('individual_id')]
    public ?string $individualID;

    /**
     * The name of the transfer recipient. This value is informational and not verified by the recipient's bank.
     */
    #[Optional('individual_name')]
    public ?string $individualName;

    /**
     * Configuration for how the effective date of the transfer will be set. This determines same-day vs future-dated settlement timing. If not set, defaults to a `settlement_schedule` of `same_day`. If set, exactly one of the child attributes must be set.
     */
    #[Optional('preferred_effective_date')]
    public ?PreferredEffectiveDate $preferredEffectiveDate;

    /**
     * Whether the transfer requires explicit approval via the dashboard or API.
     */
    #[Optional('require_approval')]
    public ?bool $requireApproval;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account.
     */
    #[Optional('routing_number')]
    public ?string $routingNumber;

    /**
     * The Standard Entry Class (SEC) code to use for the transfer.
     *
     * @var value-of<StandardEntryClassCode>|null $standardEntryClassCode
     */
    #[Optional('standard_entry_class_code', enum: StandardEntryClassCode::class)]
    public ?string $standardEntryClassCode;

    /**
     * The timing of the transaction.
     *
     * @var value-of<TransactionTiming>|null $transactionTiming
     */
    #[Optional('transaction_timing', enum: TransactionTiming::class)]
    public ?string $transactionTiming;

    /**
     * `new ACHTransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ACHTransferCreateParams::with(
     *   accountID: ..., amount: ..., statementDescriptor: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ACHTransferCreateParams)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withStatementDescriptor(...)
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
     * @param Addenda|AddendaShape|null $addenda
     * @param DestinationAccountHolder|value-of<DestinationAccountHolder>|null $destinationAccountHolder
     * @param Funding|value-of<Funding>|null $funding
     * @param PreferredEffectiveDate|PreferredEffectiveDateShape|null $preferredEffectiveDate
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode>|null $standardEntryClassCode
     * @param TransactionTiming|value-of<TransactionTiming>|null $transactionTiming
     */
    public static function with(
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
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['statementDescriptor'] = $statementDescriptor;

        null !== $accountNumber && $self['accountNumber'] = $accountNumber;
        null !== $addenda && $self['addenda'] = $addenda;
        null !== $companyDescriptiveDate && $self['companyDescriptiveDate'] = $companyDescriptiveDate;
        null !== $companyDiscretionaryData && $self['companyDiscretionaryData'] = $companyDiscretionaryData;
        null !== $companyEntryDescription && $self['companyEntryDescription'] = $companyEntryDescription;
        null !== $companyName && $self['companyName'] = $companyName;
        null !== $destinationAccountHolder && $self['destinationAccountHolder'] = $destinationAccountHolder;
        null !== $externalAccountID && $self['externalAccountID'] = $externalAccountID;
        null !== $funding && $self['funding'] = $funding;
        null !== $individualID && $self['individualID'] = $individualID;
        null !== $individualName && $self['individualName'] = $individualName;
        null !== $preferredEffectiveDate && $self['preferredEffectiveDate'] = $preferredEffectiveDate;
        null !== $requireApproval && $self['requireApproval'] = $requireApproval;
        null !== $routingNumber && $self['routingNumber'] = $routingNumber;
        null !== $standardEntryClassCode && $self['standardEntryClassCode'] = $standardEntryClassCode;
        null !== $transactionTiming && $self['transactionTiming'] = $transactionTiming;

        return $self;
    }

    /**
     * The Increase identifier for the account that will send the transfer.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The transfer amount in USD cents. A positive amount originates a credit transfer pushing funds to the receiving account. A negative amount originates a debit transfer pulling funds from the receiving account.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * A description you choose to give the transfer. This will be saved with the transfer details, displayed in the dashboard, and returned by the API. If `individual_name` and `company_name` are not explicitly set by this API, the `statement_descriptor` will be sent in those fields to the receiving bank to help the customer recognize the transfer. You are highly encouraged to pass `individual_name` and `company_name` instead of relying on this fallback.
     */
    public function withStatementDescriptor(string $statementDescriptor): self
    {
        $self = clone $this;
        $self['statementDescriptor'] = $statementDescriptor;

        return $self;
    }

    /**
     * The account number for the destination account.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * Additional information that will be sent to the recipient. This is included in the transfer data sent to the receiving bank.
     *
     * @param Addenda|AddendaShape $addenda
     */
    public function withAddenda(Addenda|array $addenda): self
    {
        $self = clone $this;
        $self['addenda'] = $addenda;

        return $self;
    }

    /**
     * The description of the date of the transfer, usually in the format `YYMMDD`. This is included in the transfer data sent to the receiving bank.
     */
    public function withCompanyDescriptiveDate(
        string $companyDescriptiveDate
    ): self {
        $self = clone $this;
        $self['companyDescriptiveDate'] = $companyDescriptiveDate;

        return $self;
    }

    /**
     * The data you choose to associate with the transfer. This is included in the transfer data sent to the receiving bank.
     */
    public function withCompanyDiscretionaryData(
        string $companyDiscretionaryData
    ): self {
        $self = clone $this;
        $self['companyDiscretionaryData'] = $companyDiscretionaryData;

        return $self;
    }

    /**
     * A description of the transfer. This is included in the transfer data sent to the receiving bank.
     */
    public function withCompanyEntryDescription(
        string $companyEntryDescription
    ): self {
        $self = clone $this;
        $self['companyEntryDescription'] = $companyEntryDescription;

        return $self;
    }

    /**
     * The name by which the recipient knows you. This is included in the transfer data sent to the receiving bank.
     */
    public function withCompanyName(string $companyName): self
    {
        $self = clone $this;
        $self['companyName'] = $companyName;

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
     * The ID of an External Account to initiate a transfer to. If this parameter is provided, `account_number`, `routing_number`, and `funding` must be absent.
     */
    public function withExternalAccountID(string $externalAccountID): self
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
     * Your identifier for the transfer recipient.
     */
    public function withIndividualID(string $individualID): self
    {
        $self = clone $this;
        $self['individualID'] = $individualID;

        return $self;
    }

    /**
     * The name of the transfer recipient. This value is informational and not verified by the recipient's bank.
     */
    public function withIndividualName(string $individualName): self
    {
        $self = clone $this;
        $self['individualName'] = $individualName;

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
     * Whether the transfer requires explicit approval via the dashboard or API.
     */
    public function withRequireApproval(bool $requireApproval): self
    {
        $self = clone $this;
        $self['requireApproval'] = $requireApproval;

        return $self;
    }

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * The Standard Entry Class (SEC) code to use for the transfer.
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
     * The timing of the transaction.
     *
     * @param TransactionTiming|value-of<TransactionTiming> $transactionTiming
     */
    public function withTransactionTiming(
        TransactionTiming|string $transactionTiming
    ): self {
        $self = clone $this;
        $self['transactionTiming'] = $transactionTiming;

        return $self;
    }
}

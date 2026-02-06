<?php

declare(strict_types=1);

namespace Increase\ACHPrenotifications;

use Increase\ACHPrenotifications\ACHPrenotificationCreateParams\CreditDebitIndicator;
use Increase\ACHPrenotifications\ACHPrenotificationCreateParams\StandardEntryClassCode;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create an ACH Prenotification.
 *
 * @see Increase\Services\ACHPrenotificationsService::create()
 *
 * @phpstan-type ACHPrenotificationCreateParamsShape = array{
 *   accountID: string,
 *   accountNumber: string,
 *   routingNumber: string,
 *   addendum?: string|null,
 *   companyDescriptiveDate?: string|null,
 *   companyDiscretionaryData?: string|null,
 *   companyEntryDescription?: string|null,
 *   companyName?: string|null,
 *   creditDebitIndicator?: null|CreditDebitIndicator|value-of<CreditDebitIndicator>,
 *   effectiveDate?: string|null,
 *   individualID?: string|null,
 *   individualName?: string|null,
 *   standardEntryClassCode?: null|StandardEntryClassCode|value-of<StandardEntryClassCode>,
 * }
 */
final class ACHPrenotificationCreateParams implements BaseModel
{
    /** @use SdkModel<ACHPrenotificationCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The Increase identifier for the account that will send the ACH Prenotification.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The account number for the destination account.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account.
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * Additional information that will be sent to the recipient.
     */
    #[Optional]
    public ?string $addendum;

    /**
     * The description of the date of the ACH Prenotification.
     */
    #[Optional('company_descriptive_date')]
    public ?string $companyDescriptiveDate;

    /**
     * The data you choose to associate with the ACH Prenotification.
     */
    #[Optional('company_discretionary_data')]
    public ?string $companyDiscretionaryData;

    /**
     * The description you wish to be shown to the recipient.
     */
    #[Optional('company_entry_description')]
    public ?string $companyEntryDescription;

    /**
     * The name by which the recipient knows you.
     */
    #[Optional('company_name')]
    public ?string $companyName;

    /**
     * Whether the Prenotification is for a future debit or credit.
     *
     * @var value-of<CreditDebitIndicator>|null $creditDebitIndicator
     */
    #[Optional('credit_debit_indicator', enum: CreditDebitIndicator::class)]
    public ?string $creditDebitIndicator;

    /**
     * The ACH Prenotification effective date in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format.
     */
    #[Optional('effective_date')]
    public ?string $effectiveDate;

    /**
     * Your identifier for the recipient.
     */
    #[Optional('individual_id')]
    public ?string $individualID;

    /**
     * The name of therecipient. This value is informational and not verified by the recipient's bank.
     */
    #[Optional('individual_name')]
    public ?string $individualName;

    /**
     * The [Standard Entry Class (SEC) code](/documentation/ach-standard-entry-class-codes) to use for the ACH Prenotification.
     *
     * @var value-of<StandardEntryClassCode>|null $standardEntryClassCode
     */
    #[Optional('standard_entry_class_code', enum: StandardEntryClassCode::class)]
    public ?string $standardEntryClassCode;

    /**
     * `new ACHPrenotificationCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ACHPrenotificationCreateParams::with(
     *   accountID: ..., accountNumber: ..., routingNumber: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ACHPrenotificationCreateParams)
     *   ->withAccountID(...)
     *   ->withAccountNumber(...)
     *   ->withRoutingNumber(...)
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
     * @param CreditDebitIndicator|value-of<CreditDebitIndicator>|null $creditDebitIndicator
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode>|null $standardEntryClassCode
     */
    public static function with(
        string $accountID,
        string $accountNumber,
        string $routingNumber,
        ?string $addendum = null,
        ?string $companyDescriptiveDate = null,
        ?string $companyDiscretionaryData = null,
        ?string $companyEntryDescription = null,
        ?string $companyName = null,
        CreditDebitIndicator|string|null $creditDebitIndicator = null,
        ?string $effectiveDate = null,
        ?string $individualID = null,
        ?string $individualName = null,
        StandardEntryClassCode|string|null $standardEntryClassCode = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['accountNumber'] = $accountNumber;
        $self['routingNumber'] = $routingNumber;

        null !== $addendum && $self['addendum'] = $addendum;
        null !== $companyDescriptiveDate && $self['companyDescriptiveDate'] = $companyDescriptiveDate;
        null !== $companyDiscretionaryData && $self['companyDiscretionaryData'] = $companyDiscretionaryData;
        null !== $companyEntryDescription && $self['companyEntryDescription'] = $companyEntryDescription;
        null !== $companyName && $self['companyName'] = $companyName;
        null !== $creditDebitIndicator && $self['creditDebitIndicator'] = $creditDebitIndicator;
        null !== $effectiveDate && $self['effectiveDate'] = $effectiveDate;
        null !== $individualID && $self['individualID'] = $individualID;
        null !== $individualName && $self['individualName'] = $individualName;
        null !== $standardEntryClassCode && $self['standardEntryClassCode'] = $standardEntryClassCode;

        return $self;
    }

    /**
     * The Increase identifier for the account that will send the ACH Prenotification.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

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
     * The American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * Additional information that will be sent to the recipient.
     */
    public function withAddendum(string $addendum): self
    {
        $self = clone $this;
        $self['addendum'] = $addendum;

        return $self;
    }

    /**
     * The description of the date of the ACH Prenotification.
     */
    public function withCompanyDescriptiveDate(
        string $companyDescriptiveDate
    ): self {
        $self = clone $this;
        $self['companyDescriptiveDate'] = $companyDescriptiveDate;

        return $self;
    }

    /**
     * The data you choose to associate with the ACH Prenotification.
     */
    public function withCompanyDiscretionaryData(
        string $companyDiscretionaryData
    ): self {
        $self = clone $this;
        $self['companyDiscretionaryData'] = $companyDiscretionaryData;

        return $self;
    }

    /**
     * The description you wish to be shown to the recipient.
     */
    public function withCompanyEntryDescription(
        string $companyEntryDescription
    ): self {
        $self = clone $this;
        $self['companyEntryDescription'] = $companyEntryDescription;

        return $self;
    }

    /**
     * The name by which the recipient knows you.
     */
    public function withCompanyName(string $companyName): self
    {
        $self = clone $this;
        $self['companyName'] = $companyName;

        return $self;
    }

    /**
     * Whether the Prenotification is for a future debit or credit.
     *
     * @param CreditDebitIndicator|value-of<CreditDebitIndicator> $creditDebitIndicator
     */
    public function withCreditDebitIndicator(
        CreditDebitIndicator|string $creditDebitIndicator
    ): self {
        $self = clone $this;
        $self['creditDebitIndicator'] = $creditDebitIndicator;

        return $self;
    }

    /**
     * The ACH Prenotification effective date in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format.
     */
    public function withEffectiveDate(string $effectiveDate): self
    {
        $self = clone $this;
        $self['effectiveDate'] = $effectiveDate;

        return $self;
    }

    /**
     * Your identifier for the recipient.
     */
    public function withIndividualID(string $individualID): self
    {
        $self = clone $this;
        $self['individualID'] = $individualID;

        return $self;
    }

    /**
     * The name of therecipient. This value is informational and not verified by the recipient's bank.
     */
    public function withIndividualName(string $individualName): self
    {
        $self = clone $this;
        $self['individualName'] = $individualName;

        return $self;
    }

    /**
     * The [Standard Entry Class (SEC) code](/documentation/ach-standard-entry-class-codes) to use for the ACH Prenotification.
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
}

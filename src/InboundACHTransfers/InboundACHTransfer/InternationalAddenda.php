<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers\InboundACHTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundACHTransfers\InboundACHTransfer\InternationalAddenda\ForeignExchangeIndicator;
use Increase\InboundACHTransfers\InboundACHTransfer\InternationalAddenda\ForeignExchangeReferenceIndicator;
use Increase\InboundACHTransfers\InboundACHTransfer\InternationalAddenda\InternationalTransactionTypeCode;
use Increase\InboundACHTransfers\InboundACHTransfer\InternationalAddenda\OriginatingDepositoryFinancialInstitutionIDQualifier;
use Increase\InboundACHTransfers\InboundACHTransfer\InternationalAddenda\ReceivingDepositoryFinancialInstitutionIDQualifier;

/**
 * If the Inbound ACH Transfer has a Standard Entry Class Code of IAT, this will contain fields pertaining to the International ACH Transaction.
 *
 * @phpstan-type InternationalAddendaShape = array{
 *   destinationCountryCode: string,
 *   destinationCurrencyCode: string,
 *   foreignExchangeIndicator: ForeignExchangeIndicator|value-of<ForeignExchangeIndicator>,
 *   foreignExchangeReference: string|null,
 *   foreignExchangeReferenceIndicator: ForeignExchangeReferenceIndicator|value-of<ForeignExchangeReferenceIndicator>,
 *   foreignPaymentAmount: int,
 *   foreignTraceNumber: string|null,
 *   internationalTransactionTypeCode: InternationalTransactionTypeCode|value-of<InternationalTransactionTypeCode>,
 *   originatingCurrencyCode: string,
 *   originatingDepositoryFinancialInstitutionBranchCountry: string,
 *   originatingDepositoryFinancialInstitutionID: string,
 *   originatingDepositoryFinancialInstitutionIDQualifier: OriginatingDepositoryFinancialInstitutionIDQualifier|value-of<OriginatingDepositoryFinancialInstitutionIDQualifier>,
 *   originatingDepositoryFinancialInstitutionName: string,
 *   originatorCity: string,
 *   originatorCountry: string,
 *   originatorIdentification: string,
 *   originatorName: string,
 *   originatorPostalCode: string|null,
 *   originatorStateOrProvince: string|null,
 *   originatorStreetAddress: string,
 *   paymentRelatedInformation: string|null,
 *   paymentRelatedInformation2: string|null,
 *   receiverCity: string,
 *   receiverCountry: string,
 *   receiverIdentificationNumber: string|null,
 *   receiverPostalCode: string|null,
 *   receiverStateOrProvince: string|null,
 *   receiverStreetAddress: string,
 *   receivingCompanyOrIndividualName: string,
 *   receivingDepositoryFinancialInstitutionCountry: string,
 *   receivingDepositoryFinancialInstitutionID: string,
 *   receivingDepositoryFinancialInstitutionIDQualifier: ReceivingDepositoryFinancialInstitutionIDQualifier|value-of<ReceivingDepositoryFinancialInstitutionIDQualifier>,
 *   receivingDepositoryFinancialInstitutionName: string,
 * }
 */
final class InternationalAddenda implements BaseModel
{
    /** @use SdkModel<InternationalAddendaShape> */
    use SdkModel;

    /**
     * The [ISO 3166](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2), Alpha-2 country code of the destination country.
     */
    #[Required('destination_country_code')]
    public string $destinationCountryCode;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code for the destination bank account.
     */
    #[Required('destination_currency_code')]
    public string $destinationCurrencyCode;

    /**
     * A description of how the foreign exchange rate was calculated.
     *
     * @var value-of<ForeignExchangeIndicator> $foreignExchangeIndicator
     */
    #[Required(
        'foreign_exchange_indicator',
        enum: ForeignExchangeIndicator::class
    )]
    public string $foreignExchangeIndicator;

    /**
     * Depending on the `foreign_exchange_reference_indicator`, an exchange rate or a reference to a well-known rate.
     */
    #[Required('foreign_exchange_reference')]
    public ?string $foreignExchangeReference;

    /**
     * An instruction of how to interpret the `foreign_exchange_reference` field for this Transaction.
     *
     * @var value-of<ForeignExchangeReferenceIndicator> $foreignExchangeReferenceIndicator
     */
    #[Required(
        'foreign_exchange_reference_indicator',
        enum: ForeignExchangeReferenceIndicator::class,
    )]
    public string $foreignExchangeReferenceIndicator;

    /**
     * The amount in the minor unit of the foreign payment currency. For dollars, for example, this is cents.
     */
    #[Required('foreign_payment_amount')]
    public int $foreignPaymentAmount;

    /**
     * A reference number in the foreign banking infrastructure.
     */
    #[Required('foreign_trace_number')]
    public ?string $foreignTraceNumber;

    /**
     * The type of transfer. Set by the originator.
     *
     * @var value-of<InternationalTransactionTypeCode> $internationalTransactionTypeCode
     */
    #[Required(
        'international_transaction_type_code',
        enum: InternationalTransactionTypeCode::class,
    )]
    public string $internationalTransactionTypeCode;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code for the originating bank account.
     */
    #[Required('originating_currency_code')]
    public string $originatingCurrencyCode;

    /**
     * The [ISO 3166](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2), Alpha-2 country code of the originating branch country.
     */
    #[Required('originating_depository_financial_institution_branch_country')]
    public string $originatingDepositoryFinancialInstitutionBranchCountry;

    /**
     * An identifier for the originating bank. One of an International Bank Account Number (IBAN) bank identifier, SWIFT Bank Identification Code (BIC), or a domestic identifier like a US Routing Number.
     */
    #[Required('originating_depository_financial_institution_id')]
    public string $originatingDepositoryFinancialInstitutionID;

    /**
     * An instruction of how to interpret the `originating_depository_financial_institution_id` field for this Transaction.
     *
     * @var value-of<OriginatingDepositoryFinancialInstitutionIDQualifier> $originatingDepositoryFinancialInstitutionIDQualifier
     */
    #[Required(
        'originating_depository_financial_institution_id_qualifier',
        enum: OriginatingDepositoryFinancialInstitutionIDQualifier::class,
    )]
    public string $originatingDepositoryFinancialInstitutionIDQualifier;

    /**
     * The name of the originating bank. Sometimes this will refer to an American bank and obscure the correspondent foreign bank.
     */
    #[Required('originating_depository_financial_institution_name')]
    public string $originatingDepositoryFinancialInstitutionName;

    /**
     * A portion of the originator address. This may be incomplete.
     */
    #[Required('originator_city')]
    public string $originatorCity;

    /**
     * A portion of the originator address. The [ISO 3166](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2), Alpha-2 country code of the originator country.
     */
    #[Required('originator_country')]
    public string $originatorCountry;

    /**
     * An identifier for the originating company. This is generally stable across multiple ACH transfers.
     */
    #[Required('originator_identification')]
    public string $originatorIdentification;

    /**
     * Either the name of the originator or an intermediary money transmitter.
     */
    #[Required('originator_name')]
    public string $originatorName;

    /**
     * A portion of the originator address. This may be incomplete.
     */
    #[Required('originator_postal_code')]
    public ?string $originatorPostalCode;

    /**
     * A portion of the originator address. This may be incomplete.
     */
    #[Required('originator_state_or_province')]
    public ?string $originatorStateOrProvince;

    /**
     * A portion of the originator address. This may be incomplete.
     */
    #[Required('originator_street_address')]
    public string $originatorStreetAddress;

    /**
     * A description field set by the originator.
     */
    #[Required('payment_related_information')]
    public ?string $paymentRelatedInformation;

    /**
     * A description field set by the originator.
     */
    #[Required('payment_related_information2')]
    public ?string $paymentRelatedInformation2;

    /**
     * A portion of the receiver address. This may be incomplete.
     */
    #[Required('receiver_city')]
    public string $receiverCity;

    /**
     * A portion of the receiver address. The [ISO 3166](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2), Alpha-2 country code of the receiver country.
     */
    #[Required('receiver_country')]
    public string $receiverCountry;

    /**
     * An identification number the originator uses for the receiver.
     */
    #[Required('receiver_identification_number')]
    public ?string $receiverIdentificationNumber;

    /**
     * A portion of the receiver address. This may be incomplete.
     */
    #[Required('receiver_postal_code')]
    public ?string $receiverPostalCode;

    /**
     * A portion of the receiver address. This may be incomplete.
     */
    #[Required('receiver_state_or_province')]
    public ?string $receiverStateOrProvince;

    /**
     * A portion of the receiver address. This may be incomplete.
     */
    #[Required('receiver_street_address')]
    public string $receiverStreetAddress;

    /**
     * The name of the receiver of the transfer. This is not verified by Increase.
     */
    #[Required('receiving_company_or_individual_name')]
    public string $receivingCompanyOrIndividualName;

    /**
     * The [ISO 3166](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2), Alpha-2 country code of the receiving bank country.
     */
    #[Required('receiving_depository_financial_institution_country')]
    public string $receivingDepositoryFinancialInstitutionCountry;

    /**
     * An identifier for the receiving bank. One of an International Bank Account Number (IBAN) bank identifier, SWIFT Bank Identification Code (BIC), or a domestic identifier like a US Routing Number.
     */
    #[Required('receiving_depository_financial_institution_id')]
    public string $receivingDepositoryFinancialInstitutionID;

    /**
     * An instruction of how to interpret the `receiving_depository_financial_institution_id` field for this Transaction.
     *
     * @var value-of<ReceivingDepositoryFinancialInstitutionIDQualifier> $receivingDepositoryFinancialInstitutionIDQualifier
     */
    #[Required(
        'receiving_depository_financial_institution_id_qualifier',
        enum: ReceivingDepositoryFinancialInstitutionIDQualifier::class,
    )]
    public string $receivingDepositoryFinancialInstitutionIDQualifier;

    /**
     * The name of the receiving bank, as set by the sending financial institution.
     */
    #[Required('receiving_depository_financial_institution_name')]
    public string $receivingDepositoryFinancialInstitutionName;

    /**
     * `new InternationalAddenda()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InternationalAddenda::with(
     *   destinationCountryCode: ...,
     *   destinationCurrencyCode: ...,
     *   foreignExchangeIndicator: ...,
     *   foreignExchangeReference: ...,
     *   foreignExchangeReferenceIndicator: ...,
     *   foreignPaymentAmount: ...,
     *   foreignTraceNumber: ...,
     *   internationalTransactionTypeCode: ...,
     *   originatingCurrencyCode: ...,
     *   originatingDepositoryFinancialInstitutionBranchCountry: ...,
     *   originatingDepositoryFinancialInstitutionID: ...,
     *   originatingDepositoryFinancialInstitutionIDQualifier: ...,
     *   originatingDepositoryFinancialInstitutionName: ...,
     *   originatorCity: ...,
     *   originatorCountry: ...,
     *   originatorIdentification: ...,
     *   originatorName: ...,
     *   originatorPostalCode: ...,
     *   originatorStateOrProvince: ...,
     *   originatorStreetAddress: ...,
     *   paymentRelatedInformation: ...,
     *   paymentRelatedInformation2: ...,
     *   receiverCity: ...,
     *   receiverCountry: ...,
     *   receiverIdentificationNumber: ...,
     *   receiverPostalCode: ...,
     *   receiverStateOrProvince: ...,
     *   receiverStreetAddress: ...,
     *   receivingCompanyOrIndividualName: ...,
     *   receivingDepositoryFinancialInstitutionCountry: ...,
     *   receivingDepositoryFinancialInstitutionID: ...,
     *   receivingDepositoryFinancialInstitutionIDQualifier: ...,
     *   receivingDepositoryFinancialInstitutionName: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InternationalAddenda)
     *   ->withDestinationCountryCode(...)
     *   ->withDestinationCurrencyCode(...)
     *   ->withForeignExchangeIndicator(...)
     *   ->withForeignExchangeReference(...)
     *   ->withForeignExchangeReferenceIndicator(...)
     *   ->withForeignPaymentAmount(...)
     *   ->withForeignTraceNumber(...)
     *   ->withInternationalTransactionTypeCode(...)
     *   ->withOriginatingCurrencyCode(...)
     *   ->withOriginatingDepositoryFinancialInstitutionBranchCountry(...)
     *   ->withOriginatingDepositoryFinancialInstitutionID(...)
     *   ->withOriginatingDepositoryFinancialInstitutionIDQualifier(...)
     *   ->withOriginatingDepositoryFinancialInstitutionName(...)
     *   ->withOriginatorCity(...)
     *   ->withOriginatorCountry(...)
     *   ->withOriginatorIdentification(...)
     *   ->withOriginatorName(...)
     *   ->withOriginatorPostalCode(...)
     *   ->withOriginatorStateOrProvince(...)
     *   ->withOriginatorStreetAddress(...)
     *   ->withPaymentRelatedInformation(...)
     *   ->withPaymentRelatedInformation2(...)
     *   ->withReceiverCity(...)
     *   ->withReceiverCountry(...)
     *   ->withReceiverIdentificationNumber(...)
     *   ->withReceiverPostalCode(...)
     *   ->withReceiverStateOrProvince(...)
     *   ->withReceiverStreetAddress(...)
     *   ->withReceivingCompanyOrIndividualName(...)
     *   ->withReceivingDepositoryFinancialInstitutionCountry(...)
     *   ->withReceivingDepositoryFinancialInstitutionID(...)
     *   ->withReceivingDepositoryFinancialInstitutionIDQualifier(...)
     *   ->withReceivingDepositoryFinancialInstitutionName(...)
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
     * @param ForeignExchangeIndicator|value-of<ForeignExchangeIndicator> $foreignExchangeIndicator
     * @param ForeignExchangeReferenceIndicator|value-of<ForeignExchangeReferenceIndicator> $foreignExchangeReferenceIndicator
     * @param InternationalTransactionTypeCode|value-of<InternationalTransactionTypeCode> $internationalTransactionTypeCode
     * @param OriginatingDepositoryFinancialInstitutionIDQualifier|value-of<OriginatingDepositoryFinancialInstitutionIDQualifier> $originatingDepositoryFinancialInstitutionIDQualifier
     * @param ReceivingDepositoryFinancialInstitutionIDQualifier|value-of<ReceivingDepositoryFinancialInstitutionIDQualifier> $receivingDepositoryFinancialInstitutionIDQualifier
     */
    public static function with(
        string $destinationCountryCode,
        string $destinationCurrencyCode,
        ForeignExchangeIndicator|string $foreignExchangeIndicator,
        ?string $foreignExchangeReference,
        ForeignExchangeReferenceIndicator|string $foreignExchangeReferenceIndicator,
        int $foreignPaymentAmount,
        ?string $foreignTraceNumber,
        InternationalTransactionTypeCode|string $internationalTransactionTypeCode,
        string $originatingCurrencyCode,
        string $originatingDepositoryFinancialInstitutionBranchCountry,
        string $originatingDepositoryFinancialInstitutionID,
        OriginatingDepositoryFinancialInstitutionIDQualifier|string $originatingDepositoryFinancialInstitutionIDQualifier,
        string $originatingDepositoryFinancialInstitutionName,
        string $originatorCity,
        string $originatorCountry,
        string $originatorIdentification,
        string $originatorName,
        ?string $originatorPostalCode,
        ?string $originatorStateOrProvince,
        string $originatorStreetAddress,
        ?string $paymentRelatedInformation,
        ?string $paymentRelatedInformation2,
        string $receiverCity,
        string $receiverCountry,
        ?string $receiverIdentificationNumber,
        ?string $receiverPostalCode,
        ?string $receiverStateOrProvince,
        string $receiverStreetAddress,
        string $receivingCompanyOrIndividualName,
        string $receivingDepositoryFinancialInstitutionCountry,
        string $receivingDepositoryFinancialInstitutionID,
        ReceivingDepositoryFinancialInstitutionIDQualifier|string $receivingDepositoryFinancialInstitutionIDQualifier,
        string $receivingDepositoryFinancialInstitutionName,
    ): self {
        $self = new self;

        $self['destinationCountryCode'] = $destinationCountryCode;
        $self['destinationCurrencyCode'] = $destinationCurrencyCode;
        $self['foreignExchangeIndicator'] = $foreignExchangeIndicator;
        $self['foreignExchangeReference'] = $foreignExchangeReference;
        $self['foreignExchangeReferenceIndicator'] = $foreignExchangeReferenceIndicator;
        $self['foreignPaymentAmount'] = $foreignPaymentAmount;
        $self['foreignTraceNumber'] = $foreignTraceNumber;
        $self['internationalTransactionTypeCode'] = $internationalTransactionTypeCode;
        $self['originatingCurrencyCode'] = $originatingCurrencyCode;
        $self['originatingDepositoryFinancialInstitutionBranchCountry'] = $originatingDepositoryFinancialInstitutionBranchCountry;
        $self['originatingDepositoryFinancialInstitutionID'] = $originatingDepositoryFinancialInstitutionID;
        $self['originatingDepositoryFinancialInstitutionIDQualifier'] = $originatingDepositoryFinancialInstitutionIDQualifier;
        $self['originatingDepositoryFinancialInstitutionName'] = $originatingDepositoryFinancialInstitutionName;
        $self['originatorCity'] = $originatorCity;
        $self['originatorCountry'] = $originatorCountry;
        $self['originatorIdentification'] = $originatorIdentification;
        $self['originatorName'] = $originatorName;
        $self['originatorPostalCode'] = $originatorPostalCode;
        $self['originatorStateOrProvince'] = $originatorStateOrProvince;
        $self['originatorStreetAddress'] = $originatorStreetAddress;
        $self['paymentRelatedInformation'] = $paymentRelatedInformation;
        $self['paymentRelatedInformation2'] = $paymentRelatedInformation2;
        $self['receiverCity'] = $receiverCity;
        $self['receiverCountry'] = $receiverCountry;
        $self['receiverIdentificationNumber'] = $receiverIdentificationNumber;
        $self['receiverPostalCode'] = $receiverPostalCode;
        $self['receiverStateOrProvince'] = $receiverStateOrProvince;
        $self['receiverStreetAddress'] = $receiverStreetAddress;
        $self['receivingCompanyOrIndividualName'] = $receivingCompanyOrIndividualName;
        $self['receivingDepositoryFinancialInstitutionCountry'] = $receivingDepositoryFinancialInstitutionCountry;
        $self['receivingDepositoryFinancialInstitutionID'] = $receivingDepositoryFinancialInstitutionID;
        $self['receivingDepositoryFinancialInstitutionIDQualifier'] = $receivingDepositoryFinancialInstitutionIDQualifier;
        $self['receivingDepositoryFinancialInstitutionName'] = $receivingDepositoryFinancialInstitutionName;

        return $self;
    }

    /**
     * The [ISO 3166](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2), Alpha-2 country code of the destination country.
     */
    public function withDestinationCountryCode(
        string $destinationCountryCode
    ): self {
        $self = clone $this;
        $self['destinationCountryCode'] = $destinationCountryCode;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code for the destination bank account.
     */
    public function withDestinationCurrencyCode(
        string $destinationCurrencyCode
    ): self {
        $self = clone $this;
        $self['destinationCurrencyCode'] = $destinationCurrencyCode;

        return $self;
    }

    /**
     * A description of how the foreign exchange rate was calculated.
     *
     * @param ForeignExchangeIndicator|value-of<ForeignExchangeIndicator> $foreignExchangeIndicator
     */
    public function withForeignExchangeIndicator(
        ForeignExchangeIndicator|string $foreignExchangeIndicator
    ): self {
        $self = clone $this;
        $self['foreignExchangeIndicator'] = $foreignExchangeIndicator;

        return $self;
    }

    /**
     * Depending on the `foreign_exchange_reference_indicator`, an exchange rate or a reference to a well-known rate.
     */
    public function withForeignExchangeReference(
        ?string $foreignExchangeReference
    ): self {
        $self = clone $this;
        $self['foreignExchangeReference'] = $foreignExchangeReference;

        return $self;
    }

    /**
     * An instruction of how to interpret the `foreign_exchange_reference` field for this Transaction.
     *
     * @param ForeignExchangeReferenceIndicator|value-of<ForeignExchangeReferenceIndicator> $foreignExchangeReferenceIndicator
     */
    public function withForeignExchangeReferenceIndicator(
        ForeignExchangeReferenceIndicator|string $foreignExchangeReferenceIndicator
    ): self {
        $self = clone $this;
        $self['foreignExchangeReferenceIndicator'] = $foreignExchangeReferenceIndicator;

        return $self;
    }

    /**
     * The amount in the minor unit of the foreign payment currency. For dollars, for example, this is cents.
     */
    public function withForeignPaymentAmount(int $foreignPaymentAmount): self
    {
        $self = clone $this;
        $self['foreignPaymentAmount'] = $foreignPaymentAmount;

        return $self;
    }

    /**
     * A reference number in the foreign banking infrastructure.
     */
    public function withForeignTraceNumber(?string $foreignTraceNumber): self
    {
        $self = clone $this;
        $self['foreignTraceNumber'] = $foreignTraceNumber;

        return $self;
    }

    /**
     * The type of transfer. Set by the originator.
     *
     * @param InternationalTransactionTypeCode|value-of<InternationalTransactionTypeCode> $internationalTransactionTypeCode
     */
    public function withInternationalTransactionTypeCode(
        InternationalTransactionTypeCode|string $internationalTransactionTypeCode
    ): self {
        $self = clone $this;
        $self['internationalTransactionTypeCode'] = $internationalTransactionTypeCode;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code for the originating bank account.
     */
    public function withOriginatingCurrencyCode(
        string $originatingCurrencyCode
    ): self {
        $self = clone $this;
        $self['originatingCurrencyCode'] = $originatingCurrencyCode;

        return $self;
    }

    /**
     * The [ISO 3166](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2), Alpha-2 country code of the originating branch country.
     */
    public function withOriginatingDepositoryFinancialInstitutionBranchCountry(
        string $originatingDepositoryFinancialInstitutionBranchCountry
    ): self {
        $self = clone $this;
        $self['originatingDepositoryFinancialInstitutionBranchCountry'] = $originatingDepositoryFinancialInstitutionBranchCountry;

        return $self;
    }

    /**
     * An identifier for the originating bank. One of an International Bank Account Number (IBAN) bank identifier, SWIFT Bank Identification Code (BIC), or a domestic identifier like a US Routing Number.
     */
    public function withOriginatingDepositoryFinancialInstitutionID(
        string $originatingDepositoryFinancialInstitutionID
    ): self {
        $self = clone $this;
        $self['originatingDepositoryFinancialInstitutionID'] = $originatingDepositoryFinancialInstitutionID;

        return $self;
    }

    /**
     * An instruction of how to interpret the `originating_depository_financial_institution_id` field for this Transaction.
     *
     * @param OriginatingDepositoryFinancialInstitutionIDQualifier|value-of<OriginatingDepositoryFinancialInstitutionIDQualifier> $originatingDepositoryFinancialInstitutionIDQualifier
     */
    public function withOriginatingDepositoryFinancialInstitutionIDQualifier(
        OriginatingDepositoryFinancialInstitutionIDQualifier|string $originatingDepositoryFinancialInstitutionIDQualifier,
    ): self {
        $self = clone $this;
        $self['originatingDepositoryFinancialInstitutionIDQualifier'] = $originatingDepositoryFinancialInstitutionIDQualifier;

        return $self;
    }

    /**
     * The name of the originating bank. Sometimes this will refer to an American bank and obscure the correspondent foreign bank.
     */
    public function withOriginatingDepositoryFinancialInstitutionName(
        string $originatingDepositoryFinancialInstitutionName
    ): self {
        $self = clone $this;
        $self['originatingDepositoryFinancialInstitutionName'] = $originatingDepositoryFinancialInstitutionName;

        return $self;
    }

    /**
     * A portion of the originator address. This may be incomplete.
     */
    public function withOriginatorCity(string $originatorCity): self
    {
        $self = clone $this;
        $self['originatorCity'] = $originatorCity;

        return $self;
    }

    /**
     * A portion of the originator address. The [ISO 3166](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2), Alpha-2 country code of the originator country.
     */
    public function withOriginatorCountry(string $originatorCountry): self
    {
        $self = clone $this;
        $self['originatorCountry'] = $originatorCountry;

        return $self;
    }

    /**
     * An identifier for the originating company. This is generally stable across multiple ACH transfers.
     */
    public function withOriginatorIdentification(
        string $originatorIdentification
    ): self {
        $self = clone $this;
        $self['originatorIdentification'] = $originatorIdentification;

        return $self;
    }

    /**
     * Either the name of the originator or an intermediary money transmitter.
     */
    public function withOriginatorName(string $originatorName): self
    {
        $self = clone $this;
        $self['originatorName'] = $originatorName;

        return $self;
    }

    /**
     * A portion of the originator address. This may be incomplete.
     */
    public function withOriginatorPostalCode(
        ?string $originatorPostalCode
    ): self {
        $self = clone $this;
        $self['originatorPostalCode'] = $originatorPostalCode;

        return $self;
    }

    /**
     * A portion of the originator address. This may be incomplete.
     */
    public function withOriginatorStateOrProvince(
        ?string $originatorStateOrProvince
    ): self {
        $self = clone $this;
        $self['originatorStateOrProvince'] = $originatorStateOrProvince;

        return $self;
    }

    /**
     * A portion of the originator address. This may be incomplete.
     */
    public function withOriginatorStreetAddress(
        string $originatorStreetAddress
    ): self {
        $self = clone $this;
        $self['originatorStreetAddress'] = $originatorStreetAddress;

        return $self;
    }

    /**
     * A description field set by the originator.
     */
    public function withPaymentRelatedInformation(
        ?string $paymentRelatedInformation
    ): self {
        $self = clone $this;
        $self['paymentRelatedInformation'] = $paymentRelatedInformation;

        return $self;
    }

    /**
     * A description field set by the originator.
     */
    public function withPaymentRelatedInformation2(
        ?string $paymentRelatedInformation2
    ): self {
        $self = clone $this;
        $self['paymentRelatedInformation2'] = $paymentRelatedInformation2;

        return $self;
    }

    /**
     * A portion of the receiver address. This may be incomplete.
     */
    public function withReceiverCity(string $receiverCity): self
    {
        $self = clone $this;
        $self['receiverCity'] = $receiverCity;

        return $self;
    }

    /**
     * A portion of the receiver address. The [ISO 3166](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2), Alpha-2 country code of the receiver country.
     */
    public function withReceiverCountry(string $receiverCountry): self
    {
        $self = clone $this;
        $self['receiverCountry'] = $receiverCountry;

        return $self;
    }

    /**
     * An identification number the originator uses for the receiver.
     */
    public function withReceiverIdentificationNumber(
        ?string $receiverIdentificationNumber
    ): self {
        $self = clone $this;
        $self['receiverIdentificationNumber'] = $receiverIdentificationNumber;

        return $self;
    }

    /**
     * A portion of the receiver address. This may be incomplete.
     */
    public function withReceiverPostalCode(?string $receiverPostalCode): self
    {
        $self = clone $this;
        $self['receiverPostalCode'] = $receiverPostalCode;

        return $self;
    }

    /**
     * A portion of the receiver address. This may be incomplete.
     */
    public function withReceiverStateOrProvince(
        ?string $receiverStateOrProvince
    ): self {
        $self = clone $this;
        $self['receiverStateOrProvince'] = $receiverStateOrProvince;

        return $self;
    }

    /**
     * A portion of the receiver address. This may be incomplete.
     */
    public function withReceiverStreetAddress(
        string $receiverStreetAddress
    ): self {
        $self = clone $this;
        $self['receiverStreetAddress'] = $receiverStreetAddress;

        return $self;
    }

    /**
     * The name of the receiver of the transfer. This is not verified by Increase.
     */
    public function withReceivingCompanyOrIndividualName(
        string $receivingCompanyOrIndividualName
    ): self {
        $self = clone $this;
        $self['receivingCompanyOrIndividualName'] = $receivingCompanyOrIndividualName;

        return $self;
    }

    /**
     * The [ISO 3166](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2), Alpha-2 country code of the receiving bank country.
     */
    public function withReceivingDepositoryFinancialInstitutionCountry(
        string $receivingDepositoryFinancialInstitutionCountry
    ): self {
        $self = clone $this;
        $self['receivingDepositoryFinancialInstitutionCountry'] = $receivingDepositoryFinancialInstitutionCountry;

        return $self;
    }

    /**
     * An identifier for the receiving bank. One of an International Bank Account Number (IBAN) bank identifier, SWIFT Bank Identification Code (BIC), or a domestic identifier like a US Routing Number.
     */
    public function withReceivingDepositoryFinancialInstitutionID(
        string $receivingDepositoryFinancialInstitutionID
    ): self {
        $self = clone $this;
        $self['receivingDepositoryFinancialInstitutionID'] = $receivingDepositoryFinancialInstitutionID;

        return $self;
    }

    /**
     * An instruction of how to interpret the `receiving_depository_financial_institution_id` field for this Transaction.
     *
     * @param ReceivingDepositoryFinancialInstitutionIDQualifier|value-of<ReceivingDepositoryFinancialInstitutionIDQualifier> $receivingDepositoryFinancialInstitutionIDQualifier
     */
    public function withReceivingDepositoryFinancialInstitutionIDQualifier(
        ReceivingDepositoryFinancialInstitutionIDQualifier|string $receivingDepositoryFinancialInstitutionIDQualifier,
    ): self {
        $self = clone $this;
        $self['receivingDepositoryFinancialInstitutionIDQualifier'] = $receivingDepositoryFinancialInstitutionIDQualifier;

        return $self;
    }

    /**
     * The name of the receiving bank, as set by the sending financial institution.
     */
    public function withReceivingDepositoryFinancialInstitutionName(
        string $receivingDepositoryFinancialInstitutionName
    ): self {
        $self = clone $this;
        $self['receivingDepositoryFinancialInstitutionName'] = $receivingDepositoryFinancialInstitutionName;

        return $self;
    }
}

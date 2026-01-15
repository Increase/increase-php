<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\InboundACHTransfer\Addenda;

/**
 * An Inbound ACH Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `inbound_ach_transfer`. An Inbound ACH Transfer Intention is created when an ACH transfer is initiated at another bank and received by Increase.
 *
 * @phpstan-import-type AddendaShape from \Increase\Transactions\Transaction\Source\InboundACHTransfer\Addenda
 *
 * @phpstan-type InboundACHTransferShape = array{
 *   addenda: null|Addenda|AddendaShape,
 *   amount: int,
 *   originatorCompanyDescriptiveDate: string|null,
 *   originatorCompanyDiscretionaryData: string|null,
 *   originatorCompanyEntryDescription: string,
 *   originatorCompanyID: string,
 *   originatorCompanyName: string,
 *   receiverIDNumber: string|null,
 *   receiverName: string|null,
 *   traceNumber: string,
 *   transferID: string,
 * }
 */
final class InboundACHTransfer implements BaseModel
{
    /** @use SdkModel<InboundACHTransferShape> */
    use SdkModel;

    /**
     * Additional information sent from the originator.
     */
    #[Required]
    public ?Addenda $addenda;

    /**
     * The transfer amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The description of the date of the transfer, usually in the format `YYMMDD`.
     */
    #[Required('originator_company_descriptive_date')]
    public ?string $originatorCompanyDescriptiveDate;

    /**
     * Data set by the originator.
     */
    #[Required('originator_company_discretionary_data')]
    public ?string $originatorCompanyDiscretionaryData;

    /**
     * An informational description of the transfer.
     */
    #[Required('originator_company_entry_description')]
    public string $originatorCompanyEntryDescription;

    /**
     * An identifier for the originating company. This is generally, but not always, a stable identifier across multiple transfers.
     */
    #[Required('originator_company_id')]
    public string $originatorCompanyID;

    /**
     * A name set by the originator to identify themselves.
     */
    #[Required('originator_company_name')]
    public string $originatorCompanyName;

    /**
     * The originator's identifier for the transfer recipient.
     */
    #[Required('receiver_id_number')]
    public ?string $receiverIDNumber;

    /**
     * The name of the transfer recipient. This value is informational and not verified by Increase.
     */
    #[Required('receiver_name')]
    public ?string $receiverName;

    /**
     * A 15 digit number recorded in the Nacha file and available to both the originating and receiving bank. Along with the amount, date, and originating routing number, this can be used to identify the ACH transfer at either bank. ACH trace numbers are not unique, but are [used to correlate returns](https://increase.com/documentation/ach-returns#ach-returns).
     */
    #[Required('trace_number')]
    public string $traceNumber;

    /**
     * The Inbound ACH Transfer's identifier.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new InboundACHTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundACHTransfer::with(
     *   addenda: ...,
     *   amount: ...,
     *   originatorCompanyDescriptiveDate: ...,
     *   originatorCompanyDiscretionaryData: ...,
     *   originatorCompanyEntryDescription: ...,
     *   originatorCompanyID: ...,
     *   originatorCompanyName: ...,
     *   receiverIDNumber: ...,
     *   receiverName: ...,
     *   traceNumber: ...,
     *   transferID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundACHTransfer)
     *   ->withAddenda(...)
     *   ->withAmount(...)
     *   ->withOriginatorCompanyDescriptiveDate(...)
     *   ->withOriginatorCompanyDiscretionaryData(...)
     *   ->withOriginatorCompanyEntryDescription(...)
     *   ->withOriginatorCompanyID(...)
     *   ->withOriginatorCompanyName(...)
     *   ->withReceiverIDNumber(...)
     *   ->withReceiverName(...)
     *   ->withTraceNumber(...)
     *   ->withTransferID(...)
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
     */
    public static function with(
        Addenda|array|null $addenda,
        int $amount,
        ?string $originatorCompanyDescriptiveDate,
        ?string $originatorCompanyDiscretionaryData,
        string $originatorCompanyEntryDescription,
        string $originatorCompanyID,
        string $originatorCompanyName,
        ?string $receiverIDNumber,
        ?string $receiverName,
        string $traceNumber,
        string $transferID,
    ): self {
        $self = new self;

        $self['addenda'] = $addenda;
        $self['amount'] = $amount;
        $self['originatorCompanyDescriptiveDate'] = $originatorCompanyDescriptiveDate;
        $self['originatorCompanyDiscretionaryData'] = $originatorCompanyDiscretionaryData;
        $self['originatorCompanyEntryDescription'] = $originatorCompanyEntryDescription;
        $self['originatorCompanyID'] = $originatorCompanyID;
        $self['originatorCompanyName'] = $originatorCompanyName;
        $self['receiverIDNumber'] = $receiverIDNumber;
        $self['receiverName'] = $receiverName;
        $self['traceNumber'] = $traceNumber;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * Additional information sent from the originator.
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
     * The transfer amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The description of the date of the transfer, usually in the format `YYMMDD`.
     */
    public function withOriginatorCompanyDescriptiveDate(
        ?string $originatorCompanyDescriptiveDate
    ): self {
        $self = clone $this;
        $self['originatorCompanyDescriptiveDate'] = $originatorCompanyDescriptiveDate;

        return $self;
    }

    /**
     * Data set by the originator.
     */
    public function withOriginatorCompanyDiscretionaryData(
        ?string $originatorCompanyDiscretionaryData
    ): self {
        $self = clone $this;
        $self['originatorCompanyDiscretionaryData'] = $originatorCompanyDiscretionaryData;

        return $self;
    }

    /**
     * An informational description of the transfer.
     */
    public function withOriginatorCompanyEntryDescription(
        string $originatorCompanyEntryDescription
    ): self {
        $self = clone $this;
        $self['originatorCompanyEntryDescription'] = $originatorCompanyEntryDescription;

        return $self;
    }

    /**
     * An identifier for the originating company. This is generally, but not always, a stable identifier across multiple transfers.
     */
    public function withOriginatorCompanyID(string $originatorCompanyID): self
    {
        $self = clone $this;
        $self['originatorCompanyID'] = $originatorCompanyID;

        return $self;
    }

    /**
     * A name set by the originator to identify themselves.
     */
    public function withOriginatorCompanyName(
        string $originatorCompanyName
    ): self {
        $self = clone $this;
        $self['originatorCompanyName'] = $originatorCompanyName;

        return $self;
    }

    /**
     * The originator's identifier for the transfer recipient.
     */
    public function withReceiverIDNumber(?string $receiverIDNumber): self
    {
        $self = clone $this;
        $self['receiverIDNumber'] = $receiverIDNumber;

        return $self;
    }

    /**
     * The name of the transfer recipient. This value is informational and not verified by Increase.
     */
    public function withReceiverName(?string $receiverName): self
    {
        $self = clone $this;
        $self['receiverName'] = $receiverName;

        return $self;
    }

    /**
     * A 15 digit number recorded in the Nacha file and available to both the originating and receiving bank. Along with the amount, date, and originating routing number, this can be used to identify the ACH transfer at either bank. ACH trace numbers are not unique, but are [used to correlate returns](https://increase.com/documentation/ach-returns#ach-returns).
     */
    public function withTraceNumber(string $traceNumber): self
    {
        $self = clone $this;
        $self['traceNumber'] = $traceNumber;

        return $self;
    }

    /**
     * The Inbound ACH Transfer's identifier.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}

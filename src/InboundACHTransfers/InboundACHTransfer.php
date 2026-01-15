<?php

declare(strict_types=1);

namespace Increase\InboundACHTransfers;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundACHTransfers\InboundACHTransfer\Acceptance;
use Increase\InboundACHTransfers\InboundACHTransfer\Addenda;
use Increase\InboundACHTransfers\InboundACHTransfer\Decline;
use Increase\InboundACHTransfers\InboundACHTransfer\Direction;
use Increase\InboundACHTransfers\InboundACHTransfer\InternationalAddenda;
use Increase\InboundACHTransfers\InboundACHTransfer\NotificationOfChange;
use Increase\InboundACHTransfers\InboundACHTransfer\Settlement;
use Increase\InboundACHTransfers\InboundACHTransfer\StandardEntryClassCode;
use Increase\InboundACHTransfers\InboundACHTransfer\Status;
use Increase\InboundACHTransfers\InboundACHTransfer\TransferReturn;
use Increase\InboundACHTransfers\InboundACHTransfer\Type;

/**
 * An Inbound ACH Transfer is an ACH transfer initiated outside of Increase to your account.
 *
 * @phpstan-import-type AcceptanceShape from \Increase\InboundACHTransfers\InboundACHTransfer\Acceptance
 * @phpstan-import-type AddendaShape from \Increase\InboundACHTransfers\InboundACHTransfer\Addenda
 * @phpstan-import-type DeclineShape from \Increase\InboundACHTransfers\InboundACHTransfer\Decline
 * @phpstan-import-type InternationalAddendaShape from \Increase\InboundACHTransfers\InboundACHTransfer\InternationalAddenda
 * @phpstan-import-type NotificationOfChangeShape from \Increase\InboundACHTransfers\InboundACHTransfer\NotificationOfChange
 * @phpstan-import-type SettlementShape from \Increase\InboundACHTransfers\InboundACHTransfer\Settlement
 * @phpstan-import-type TransferReturnShape from \Increase\InboundACHTransfers\InboundACHTransfer\TransferReturn
 *
 * @phpstan-type InboundACHTransferShape = array{
 *   id: string,
 *   acceptance: null|Acceptance|AcceptanceShape,
 *   accountID: string,
 *   accountNumberID: string,
 *   addenda: null|Addenda|AddendaShape,
 *   amount: int,
 *   automaticallyResolvesAt: \DateTimeInterface,
 *   createdAt: \DateTimeInterface,
 *   decline: null|Decline|DeclineShape,
 *   direction: Direction|value-of<Direction>,
 *   effectiveDate: string,
 *   internationalAddenda: null|InternationalAddenda|InternationalAddendaShape,
 *   notificationOfChange: null|NotificationOfChange|NotificationOfChangeShape,
 *   originatorCompanyDescriptiveDate: string|null,
 *   originatorCompanyDiscretionaryData: string|null,
 *   originatorCompanyEntryDescription: string,
 *   originatorCompanyID: string,
 *   originatorCompanyName: string,
 *   originatorRoutingNumber: string,
 *   receiverIDNumber: string|null,
 *   receiverName: string|null,
 *   settlement: Settlement|SettlementShape,
 *   standardEntryClassCode: StandardEntryClassCode|value-of<StandardEntryClassCode>,
 *   status: Status|value-of<Status>,
 *   traceNumber: string,
 *   transferReturn: null|TransferReturn|TransferReturnShape,
 *   type: Type|value-of<Type>,
 * }
 */
final class InboundACHTransfer implements BaseModel
{
    /** @use SdkModel<InboundACHTransferShape> */
    use SdkModel;

    /**
     * The inbound ACH transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * If your transfer is accepted, this will contain details of the acceptance.
     */
    #[Required]
    public ?Acceptance $acceptance;

    /**
     * The Account to which the transfer belongs.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The identifier of the Account Number to which this transfer was sent.
     */
    #[Required('account_number_id')]
    public string $accountNumberID;

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
     * The time at which the transfer will be automatically resolved.
     */
    #[Required('automatically_resolves_at')]
    public \DateTimeInterface $automaticallyResolvesAt;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the inbound ACH transfer was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * If your transfer is declined, this will contain details of the decline.
     */
    #[Required]
    public ?Decline $decline;

    /**
     * The direction of the transfer.
     *
     * @var value-of<Direction> $direction
     */
    #[Required(enum: Direction::class)]
    public string $direction;

    /**
     * The effective date of the transfer. This is sent by the sending bank and is a factor in determining funds availability.
     */
    #[Required('effective_date')]
    public string $effectiveDate;

    /**
     * If the Inbound ACH Transfer has a Standard Entry Class Code of IAT, this will contain fields pertaining to the International ACH Transaction.
     */
    #[Required('international_addenda')]
    public ?InternationalAddenda $internationalAddenda;

    /**
     * If you initiate a notification of change in response to the transfer, this will contain its details.
     */
    #[Required('notification_of_change')]
    public ?NotificationOfChange $notificationOfChange;

    /**
     * The descriptive date of the transfer.
     */
    #[Required('originator_company_descriptive_date')]
    public ?string $originatorCompanyDescriptiveDate;

    /**
     * The additional information included with the transfer.
     */
    #[Required('originator_company_discretionary_data')]
    public ?string $originatorCompanyDiscretionaryData;

    /**
     * The description of the transfer.
     */
    #[Required('originator_company_entry_description')]
    public string $originatorCompanyEntryDescription;

    /**
     * The id of the company that initiated the transfer.
     */
    #[Required('originator_company_id')]
    public string $originatorCompanyID;

    /**
     * The name of the company that initiated the transfer.
     */
    #[Required('originator_company_name')]
    public string $originatorCompanyName;

    /**
     * The American Banking Association (ABA) routing number of the bank originating the transfer.
     */
    #[Required('originator_routing_number')]
    public string $originatorRoutingNumber;

    /**
     * The id of the receiver of the transfer.
     */
    #[Required('receiver_id_number')]
    public ?string $receiverIDNumber;

    /**
     * The name of the receiver of the transfer.
     */
    #[Required('receiver_name')]
    public ?string $receiverName;

    /**
     * A subhash containing information about when and how the transfer settled at the Federal Reserve.
     */
    #[Required]
    public Settlement $settlement;

    /**
     * The Standard Entry Class (SEC) code of the transfer.
     *
     * @var value-of<StandardEntryClassCode> $standardEntryClassCode
     */
    #[Required('standard_entry_class_code', enum: StandardEntryClassCode::class)]
    public string $standardEntryClassCode;

    /**
     * The status of the transfer.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A 15 digit number set by the sending bank and transmitted to the receiving bank. Along with the amount, date, and originating routing number, this can be used to identify the ACH transfer. ACH trace numbers are not unique, but are [used to correlate returns](https://increase.com/documentation/ach-returns#ach-returns).
     */
    #[Required('trace_number')]
    public string $traceNumber;

    /**
     * If your transfer is returned, this will contain details of the return.
     */
    #[Required('transfer_return')]
    public ?TransferReturn $transferReturn;

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_ach_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new InboundACHTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundACHTransfer::with(
     *   id: ...,
     *   acceptance: ...,
     *   accountID: ...,
     *   accountNumberID: ...,
     *   addenda: ...,
     *   amount: ...,
     *   automaticallyResolvesAt: ...,
     *   createdAt: ...,
     *   decline: ...,
     *   direction: ...,
     *   effectiveDate: ...,
     *   internationalAddenda: ...,
     *   notificationOfChange: ...,
     *   originatorCompanyDescriptiveDate: ...,
     *   originatorCompanyDiscretionaryData: ...,
     *   originatorCompanyEntryDescription: ...,
     *   originatorCompanyID: ...,
     *   originatorCompanyName: ...,
     *   originatorRoutingNumber: ...,
     *   receiverIDNumber: ...,
     *   receiverName: ...,
     *   settlement: ...,
     *   standardEntryClassCode: ...,
     *   status: ...,
     *   traceNumber: ...,
     *   transferReturn: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundACHTransfer)
     *   ->withID(...)
     *   ->withAcceptance(...)
     *   ->withAccountID(...)
     *   ->withAccountNumberID(...)
     *   ->withAddenda(...)
     *   ->withAmount(...)
     *   ->withAutomaticallyResolvesAt(...)
     *   ->withCreatedAt(...)
     *   ->withDecline(...)
     *   ->withDirection(...)
     *   ->withEffectiveDate(...)
     *   ->withInternationalAddenda(...)
     *   ->withNotificationOfChange(...)
     *   ->withOriginatorCompanyDescriptiveDate(...)
     *   ->withOriginatorCompanyDiscretionaryData(...)
     *   ->withOriginatorCompanyEntryDescription(...)
     *   ->withOriginatorCompanyID(...)
     *   ->withOriginatorCompanyName(...)
     *   ->withOriginatorRoutingNumber(...)
     *   ->withReceiverIDNumber(...)
     *   ->withReceiverName(...)
     *   ->withSettlement(...)
     *   ->withStandardEntryClassCode(...)
     *   ->withStatus(...)
     *   ->withTraceNumber(...)
     *   ->withTransferReturn(...)
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
     * @param Acceptance|AcceptanceShape|null $acceptance
     * @param Addenda|AddendaShape|null $addenda
     * @param Decline|DeclineShape|null $decline
     * @param Direction|value-of<Direction> $direction
     * @param InternationalAddenda|InternationalAddendaShape|null $internationalAddenda
     * @param NotificationOfChange|NotificationOfChangeShape|null $notificationOfChange
     * @param Settlement|SettlementShape $settlement
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode> $standardEntryClassCode
     * @param Status|value-of<Status> $status
     * @param TransferReturn|TransferReturnShape|null $transferReturn
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Acceptance|array|null $acceptance,
        string $accountID,
        string $accountNumberID,
        Addenda|array|null $addenda,
        int $amount,
        \DateTimeInterface $automaticallyResolvesAt,
        \DateTimeInterface $createdAt,
        Decline|array|null $decline,
        Direction|string $direction,
        string $effectiveDate,
        InternationalAddenda|array|null $internationalAddenda,
        NotificationOfChange|array|null $notificationOfChange,
        ?string $originatorCompanyDescriptiveDate,
        ?string $originatorCompanyDiscretionaryData,
        string $originatorCompanyEntryDescription,
        string $originatorCompanyID,
        string $originatorCompanyName,
        string $originatorRoutingNumber,
        ?string $receiverIDNumber,
        ?string $receiverName,
        Settlement|array $settlement,
        StandardEntryClassCode|string $standardEntryClassCode,
        Status|string $status,
        string $traceNumber,
        TransferReturn|array|null $transferReturn,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['acceptance'] = $acceptance;
        $self['accountID'] = $accountID;
        $self['accountNumberID'] = $accountNumberID;
        $self['addenda'] = $addenda;
        $self['amount'] = $amount;
        $self['automaticallyResolvesAt'] = $automaticallyResolvesAt;
        $self['createdAt'] = $createdAt;
        $self['decline'] = $decline;
        $self['direction'] = $direction;
        $self['effectiveDate'] = $effectiveDate;
        $self['internationalAddenda'] = $internationalAddenda;
        $self['notificationOfChange'] = $notificationOfChange;
        $self['originatorCompanyDescriptiveDate'] = $originatorCompanyDescriptiveDate;
        $self['originatorCompanyDiscretionaryData'] = $originatorCompanyDiscretionaryData;
        $self['originatorCompanyEntryDescription'] = $originatorCompanyEntryDescription;
        $self['originatorCompanyID'] = $originatorCompanyID;
        $self['originatorCompanyName'] = $originatorCompanyName;
        $self['originatorRoutingNumber'] = $originatorRoutingNumber;
        $self['receiverIDNumber'] = $receiverIDNumber;
        $self['receiverName'] = $receiverName;
        $self['settlement'] = $settlement;
        $self['standardEntryClassCode'] = $standardEntryClassCode;
        $self['status'] = $status;
        $self['traceNumber'] = $traceNumber;
        $self['transferReturn'] = $transferReturn;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The inbound ACH transfer's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * If your transfer is accepted, this will contain details of the acceptance.
     *
     * @param Acceptance|AcceptanceShape|null $acceptance
     */
    public function withAcceptance(Acceptance|array|null $acceptance): self
    {
        $self = clone $this;
        $self['acceptance'] = $acceptance;

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
     * The identifier of the Account Number to which this transfer was sent.
     */
    public function withAccountNumberID(string $accountNumberID): self
    {
        $self = clone $this;
        $self['accountNumberID'] = $accountNumberID;

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
     * The time at which the transfer will be automatically resolved.
     */
    public function withAutomaticallyResolvesAt(
        \DateTimeInterface $automaticallyResolvesAt
    ): self {
        $self = clone $this;
        $self['automaticallyResolvesAt'] = $automaticallyResolvesAt;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the inbound ACH transfer was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * If your transfer is declined, this will contain details of the decline.
     *
     * @param Decline|DeclineShape|null $decline
     */
    public function withDecline(Decline|array|null $decline): self
    {
        $self = clone $this;
        $self['decline'] = $decline;

        return $self;
    }

    /**
     * The direction of the transfer.
     *
     * @param Direction|value-of<Direction> $direction
     */
    public function withDirection(Direction|string $direction): self
    {
        $self = clone $this;
        $self['direction'] = $direction;

        return $self;
    }

    /**
     * The effective date of the transfer. This is sent by the sending bank and is a factor in determining funds availability.
     */
    public function withEffectiveDate(string $effectiveDate): self
    {
        $self = clone $this;
        $self['effectiveDate'] = $effectiveDate;

        return $self;
    }

    /**
     * If the Inbound ACH Transfer has a Standard Entry Class Code of IAT, this will contain fields pertaining to the International ACH Transaction.
     *
     * @param InternationalAddenda|InternationalAddendaShape|null $internationalAddenda
     */
    public function withInternationalAddenda(
        InternationalAddenda|array|null $internationalAddenda
    ): self {
        $self = clone $this;
        $self['internationalAddenda'] = $internationalAddenda;

        return $self;
    }

    /**
     * If you initiate a notification of change in response to the transfer, this will contain its details.
     *
     * @param NotificationOfChange|NotificationOfChangeShape|null $notificationOfChange
     */
    public function withNotificationOfChange(
        NotificationOfChange|array|null $notificationOfChange
    ): self {
        $self = clone $this;
        $self['notificationOfChange'] = $notificationOfChange;

        return $self;
    }

    /**
     * The descriptive date of the transfer.
     */
    public function withOriginatorCompanyDescriptiveDate(
        ?string $originatorCompanyDescriptiveDate
    ): self {
        $self = clone $this;
        $self['originatorCompanyDescriptiveDate'] = $originatorCompanyDescriptiveDate;

        return $self;
    }

    /**
     * The additional information included with the transfer.
     */
    public function withOriginatorCompanyDiscretionaryData(
        ?string $originatorCompanyDiscretionaryData
    ): self {
        $self = clone $this;
        $self['originatorCompanyDiscretionaryData'] = $originatorCompanyDiscretionaryData;

        return $self;
    }

    /**
     * The description of the transfer.
     */
    public function withOriginatorCompanyEntryDescription(
        string $originatorCompanyEntryDescription
    ): self {
        $self = clone $this;
        $self['originatorCompanyEntryDescription'] = $originatorCompanyEntryDescription;

        return $self;
    }

    /**
     * The id of the company that initiated the transfer.
     */
    public function withOriginatorCompanyID(string $originatorCompanyID): self
    {
        $self = clone $this;
        $self['originatorCompanyID'] = $originatorCompanyID;

        return $self;
    }

    /**
     * The name of the company that initiated the transfer.
     */
    public function withOriginatorCompanyName(
        string $originatorCompanyName
    ): self {
        $self = clone $this;
        $self['originatorCompanyName'] = $originatorCompanyName;

        return $self;
    }

    /**
     * The American Banking Association (ABA) routing number of the bank originating the transfer.
     */
    public function withOriginatorRoutingNumber(
        string $originatorRoutingNumber
    ): self {
        $self = clone $this;
        $self['originatorRoutingNumber'] = $originatorRoutingNumber;

        return $self;
    }

    /**
     * The id of the receiver of the transfer.
     */
    public function withReceiverIDNumber(?string $receiverIDNumber): self
    {
        $self = clone $this;
        $self['receiverIDNumber'] = $receiverIDNumber;

        return $self;
    }

    /**
     * The name of the receiver of the transfer.
     */
    public function withReceiverName(?string $receiverName): self
    {
        $self = clone $this;
        $self['receiverName'] = $receiverName;

        return $self;
    }

    /**
     * A subhash containing information about when and how the transfer settled at the Federal Reserve.
     *
     * @param Settlement|SettlementShape $settlement
     */
    public function withSettlement(Settlement|array $settlement): self
    {
        $self = clone $this;
        $self['settlement'] = $settlement;

        return $self;
    }

    /**
     * The Standard Entry Class (SEC) code of the transfer.
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
     * The status of the transfer.
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
     * A 15 digit number set by the sending bank and transmitted to the receiving bank. Along with the amount, date, and originating routing number, this can be used to identify the ACH transfer. ACH trace numbers are not unique, but are [used to correlate returns](https://increase.com/documentation/ach-returns#ach-returns).
     */
    public function withTraceNumber(string $traceNumber): self
    {
        $self = clone $this;
        $self['traceNumber'] = $traceNumber;

        return $self;
    }

    /**
     * If your transfer is returned, this will contain details of the return.
     *
     * @param TransferReturn|TransferReturnShape|null $transferReturn
     */
    public function withTransferReturn(
        TransferReturn|array|null $transferReturn
    ): self {
        $self = clone $this;
        $self['transferReturn'] = $transferReturn;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_ach_transfer`.
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

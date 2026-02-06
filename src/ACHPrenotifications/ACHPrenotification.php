<?php

declare(strict_types=1);

namespace Increase\ACHPrenotifications;

use Increase\ACHPrenotifications\ACHPrenotification\CreditDebitIndicator;
use Increase\ACHPrenotifications\ACHPrenotification\NotificationsOfChange;
use Increase\ACHPrenotifications\ACHPrenotification\PrenotificationReturn;
use Increase\ACHPrenotifications\ACHPrenotification\StandardEntryClassCode;
use Increase\ACHPrenotifications\ACHPrenotification\Status;
use Increase\ACHPrenotifications\ACHPrenotification\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * ACH Prenotifications are one way you can verify account and routing numbers by Automated Clearing House (ACH).
 *
 * @phpstan-import-type NotificationsOfChangeShape from \Increase\ACHPrenotifications\ACHPrenotification\NotificationsOfChange
 * @phpstan-import-type PrenotificationReturnShape from \Increase\ACHPrenotifications\ACHPrenotification\PrenotificationReturn
 *
 * @phpstan-type ACHPrenotificationShape = array{
 *   id: string,
 *   accountID: string|null,
 *   accountNumber: string,
 *   addendum: string|null,
 *   companyDescriptiveDate: string|null,
 *   companyDiscretionaryData: string|null,
 *   companyEntryDescription: string|null,
 *   companyName: string|null,
 *   createdAt: \DateTimeInterface,
 *   creditDebitIndicator: null|CreditDebitIndicator|value-of<CreditDebitIndicator>,
 *   effectiveDate: \DateTimeInterface|null,
 *   idempotencyKey: string|null,
 *   individualID: string|null,
 *   individualName: string|null,
 *   notificationsOfChange: list<NotificationsOfChange|NotificationsOfChangeShape>,
 *   prenotificationReturn: null|PrenotificationReturn|PrenotificationReturnShape,
 *   routingNumber: string,
 *   standardEntryClassCode: null|StandardEntryClassCode|value-of<StandardEntryClassCode>,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class ACHPrenotification implements BaseModel
{
    /** @use SdkModel<ACHPrenotificationShape> */
    use SdkModel;

    /**
     * The ACH Prenotification's identifier.
     */
    #[Required]
    public string $id;

    /**
     * The account that sent the ACH Prenotification.
     */
    #[Required('account_id')]
    public ?string $accountID;

    /**
     * The destination account number.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * Additional information for the recipient.
     */
    #[Required]
    public ?string $addendum;

    /**
     * The description of the date of the notification.
     */
    #[Required('company_descriptive_date')]
    public ?string $companyDescriptiveDate;

    /**
     * Optional data associated with the notification.
     */
    #[Required('company_discretionary_data')]
    public ?string $companyDiscretionaryData;

    /**
     * The description of the notification.
     */
    #[Required('company_entry_description')]
    public ?string $companyEntryDescription;

    /**
     * The name by which you know the company.
     */
    #[Required('company_name')]
    public ?string $companyName;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the prenotification was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * If the notification is for a future credit or debit.
     *
     * @var value-of<CreditDebitIndicator>|null $creditDebitIndicator
     */
    #[Required('credit_debit_indicator', enum: CreditDebitIndicator::class)]
    public ?string $creditDebitIndicator;

    /**
     * The effective date in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format.
     */
    #[Required('effective_date')]
    public ?\DateTimeInterface $effectiveDate;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * Your identifier for the recipient.
     */
    #[Required('individual_id')]
    public ?string $individualID;

    /**
     * The name of the recipient. This value is informational and not verified by the recipient's bank.
     */
    #[Required('individual_name')]
    public ?string $individualName;

    /**
     * If the receiving bank notifies that future transfers should use different details, this will contain those details.
     *
     * @var list<NotificationsOfChange> $notificationsOfChange
     */
    #[Required('notifications_of_change', list: NotificationsOfChange::class)]
    public array $notificationsOfChange;

    /**
     * If your prenotification is returned, this will contain details of the return.
     */
    #[Required('prenotification_return')]
    public ?PrenotificationReturn $prenotificationReturn;

    /**
     * The American Bankers' Association (ABA) Routing Transit Number (RTN).
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * The [Standard Entry Class (SEC) code](/documentation/ach-standard-entry-class-codes) to use for the ACH Prenotification.
     *
     * @var value-of<StandardEntryClassCode>|null $standardEntryClassCode
     */
    #[Required('standard_entry_class_code', enum: StandardEntryClassCode::class)]
    public ?string $standardEntryClassCode;

    /**
     * The lifecycle status of the ACH Prenotification.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `ach_prenotification`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new ACHPrenotification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ACHPrenotification::with(
     *   id: ...,
     *   accountID: ...,
     *   accountNumber: ...,
     *   addendum: ...,
     *   companyDescriptiveDate: ...,
     *   companyDiscretionaryData: ...,
     *   companyEntryDescription: ...,
     *   companyName: ...,
     *   createdAt: ...,
     *   creditDebitIndicator: ...,
     *   effectiveDate: ...,
     *   idempotencyKey: ...,
     *   individualID: ...,
     *   individualName: ...,
     *   notificationsOfChange: ...,
     *   prenotificationReturn: ...,
     *   routingNumber: ...,
     *   standardEntryClassCode: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ACHPrenotification)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAccountNumber(...)
     *   ->withAddendum(...)
     *   ->withCompanyDescriptiveDate(...)
     *   ->withCompanyDiscretionaryData(...)
     *   ->withCompanyEntryDescription(...)
     *   ->withCompanyName(...)
     *   ->withCreatedAt(...)
     *   ->withCreditDebitIndicator(...)
     *   ->withEffectiveDate(...)
     *   ->withIdempotencyKey(...)
     *   ->withIndividualID(...)
     *   ->withIndividualName(...)
     *   ->withNotificationsOfChange(...)
     *   ->withPrenotificationReturn(...)
     *   ->withRoutingNumber(...)
     *   ->withStandardEntryClassCode(...)
     *   ->withStatus(...)
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
     * @param CreditDebitIndicator|value-of<CreditDebitIndicator>|null $creditDebitIndicator
     * @param list<NotificationsOfChange|NotificationsOfChangeShape> $notificationsOfChange
     * @param PrenotificationReturn|PrenotificationReturnShape|null $prenotificationReturn
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode>|null $standardEntryClassCode
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        ?string $accountID,
        string $accountNumber,
        ?string $addendum,
        ?string $companyDescriptiveDate,
        ?string $companyDiscretionaryData,
        ?string $companyEntryDescription,
        ?string $companyName,
        \DateTimeInterface $createdAt,
        CreditDebitIndicator|string|null $creditDebitIndicator,
        ?\DateTimeInterface $effectiveDate,
        ?string $idempotencyKey,
        ?string $individualID,
        ?string $individualName,
        array $notificationsOfChange,
        PrenotificationReturn|array|null $prenotificationReturn,
        string $routingNumber,
        StandardEntryClassCode|string|null $standardEntryClassCode,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['accountNumber'] = $accountNumber;
        $self['addendum'] = $addendum;
        $self['companyDescriptiveDate'] = $companyDescriptiveDate;
        $self['companyDiscretionaryData'] = $companyDiscretionaryData;
        $self['companyEntryDescription'] = $companyEntryDescription;
        $self['companyName'] = $companyName;
        $self['createdAt'] = $createdAt;
        $self['creditDebitIndicator'] = $creditDebitIndicator;
        $self['effectiveDate'] = $effectiveDate;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['individualID'] = $individualID;
        $self['individualName'] = $individualName;
        $self['notificationsOfChange'] = $notificationsOfChange;
        $self['prenotificationReturn'] = $prenotificationReturn;
        $self['routingNumber'] = $routingNumber;
        $self['standardEntryClassCode'] = $standardEntryClassCode;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The ACH Prenotification's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The account that sent the ACH Prenotification.
     */
    public function withAccountID(?string $accountID): self
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
     * Additional information for the recipient.
     */
    public function withAddendum(?string $addendum): self
    {
        $self = clone $this;
        $self['addendum'] = $addendum;

        return $self;
    }

    /**
     * The description of the date of the notification.
     */
    public function withCompanyDescriptiveDate(
        ?string $companyDescriptiveDate
    ): self {
        $self = clone $this;
        $self['companyDescriptiveDate'] = $companyDescriptiveDate;

        return $self;
    }

    /**
     * Optional data associated with the notification.
     */
    public function withCompanyDiscretionaryData(
        ?string $companyDiscretionaryData
    ): self {
        $self = clone $this;
        $self['companyDiscretionaryData'] = $companyDiscretionaryData;

        return $self;
    }

    /**
     * The description of the notification.
     */
    public function withCompanyEntryDescription(
        ?string $companyEntryDescription
    ): self {
        $self = clone $this;
        $self['companyEntryDescription'] = $companyEntryDescription;

        return $self;
    }

    /**
     * The name by which you know the company.
     */
    public function withCompanyName(?string $companyName): self
    {
        $self = clone $this;
        $self['companyName'] = $companyName;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the prenotification was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * If the notification is for a future credit or debit.
     *
     * @param CreditDebitIndicator|value-of<CreditDebitIndicator>|null $creditDebitIndicator
     */
    public function withCreditDebitIndicator(
        CreditDebitIndicator|string|null $creditDebitIndicator
    ): self {
        $self = clone $this;
        $self['creditDebitIndicator'] = $creditDebitIndicator;

        return $self;
    }

    /**
     * The effective date in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format.
     */
    public function withEffectiveDate(?\DateTimeInterface $effectiveDate): self
    {
        $self = clone $this;
        $self['effectiveDate'] = $effectiveDate;

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
     * Your identifier for the recipient.
     */
    public function withIndividualID(?string $individualID): self
    {
        $self = clone $this;
        $self['individualID'] = $individualID;

        return $self;
    }

    /**
     * The name of the recipient. This value is informational and not verified by the recipient's bank.
     */
    public function withIndividualName(?string $individualName): self
    {
        $self = clone $this;
        $self['individualName'] = $individualName;

        return $self;
    }

    /**
     * If the receiving bank notifies that future transfers should use different details, this will contain those details.
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
     * If your prenotification is returned, this will contain details of the return.
     *
     * @param PrenotificationReturn|PrenotificationReturnShape|null $prenotificationReturn
     */
    public function withPrenotificationReturn(
        PrenotificationReturn|array|null $prenotificationReturn
    ): self {
        $self = clone $this;
        $self['prenotificationReturn'] = $prenotificationReturn;

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
     * The [Standard Entry Class (SEC) code](/documentation/ach-standard-entry-class-codes) to use for the ACH Prenotification.
     *
     * @param StandardEntryClassCode|value-of<StandardEntryClassCode>|null $standardEntryClassCode
     */
    public function withStandardEntryClassCode(
        StandardEntryClassCode|string|null $standardEntryClassCode
    ): self {
        $self = clone $this;
        $self['standardEntryClassCode'] = $standardEntryClassCode;

        return $self;
    }

    /**
     * The lifecycle status of the ACH Prenotification.
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
     * A constant representing the object's type. For this resource it will always be `ach_prenotification`.
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

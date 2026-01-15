<?php

declare(strict_types=1);

namespace Increase\CardPushTransfers;

use Increase\CardPushTransfers\CardPushTransfer\Acceptance;
use Increase\CardPushTransfers\CardPushTransfer\Approval;
use Increase\CardPushTransfers\CardPushTransfer\BusinessApplicationIdentifier;
use Increase\CardPushTransfers\CardPushTransfer\Cancellation;
use Increase\CardPushTransfers\CardPushTransfer\CreatedBy;
use Increase\CardPushTransfers\CardPushTransfer\Decline;
use Increase\CardPushTransfers\CardPushTransfer\PresentmentAmount;
use Increase\CardPushTransfers\CardPushTransfer\Status;
use Increase\CardPushTransfers\CardPushTransfer\Submission;
use Increase\CardPushTransfers\CardPushTransfer\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Card Push Transfers send funds to a recipient's payment card in real-time.
 *
 * @phpstan-import-type AcceptanceShape from \Increase\CardPushTransfers\CardPushTransfer\Acceptance
 * @phpstan-import-type ApprovalShape from \Increase\CardPushTransfers\CardPushTransfer\Approval
 * @phpstan-import-type CancellationShape from \Increase\CardPushTransfers\CardPushTransfer\Cancellation
 * @phpstan-import-type CreatedByShape from \Increase\CardPushTransfers\CardPushTransfer\CreatedBy
 * @phpstan-import-type DeclineShape from \Increase\CardPushTransfers\CardPushTransfer\Decline
 * @phpstan-import-type PresentmentAmountShape from \Increase\CardPushTransfers\CardPushTransfer\PresentmentAmount
 * @phpstan-import-type SubmissionShape from \Increase\CardPushTransfers\CardPushTransfer\Submission
 *
 * @phpstan-type CardPushTransferShape = array{
 *   id: string,
 *   acceptance: null|Acceptance|AcceptanceShape,
 *   accountID: string,
 *   approval: null|Approval|ApprovalShape,
 *   businessApplicationIdentifier: BusinessApplicationIdentifier|value-of<BusinessApplicationIdentifier>,
 *   cancellation: null|Cancellation|CancellationShape,
 *   createdAt: \DateTimeInterface,
 *   createdBy: null|CreatedBy|CreatedByShape,
 *   decline: null|Decline|DeclineShape,
 *   idempotencyKey: string|null,
 *   merchantCategoryCode: string,
 *   merchantCityName: string,
 *   merchantName: string,
 *   merchantNamePrefix: string,
 *   merchantPostalCode: string,
 *   merchantState: string,
 *   presentmentAmount: PresentmentAmount|PresentmentAmountShape,
 *   recipientName: string,
 *   senderAddressCity: string,
 *   senderAddressLine1: string,
 *   senderAddressPostalCode: string,
 *   senderAddressState: string,
 *   senderName: string,
 *   sourceAccountNumberID: string,
 *   status: Status|value-of<Status>,
 *   submission: null|Submission|SubmissionShape,
 *   type: Type|value-of<Type>,
 * }
 */
final class CardPushTransfer implements BaseModel
{
    /** @use SdkModel<CardPushTransferShape> */
    use SdkModel;

    /**
     * The Card Push Transfer's identifier.
     */
    #[Required]
    public string $id;

    /**
     * If the transfer is accepted by the recipient bank, this will contain supplemental details.
     */
    #[Required]
    public ?Acceptance $acceptance;

    /**
     * The Account from which the transfer was sent.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * If your account requires approvals for transfers and the transfer was approved, this will contain details of the approval.
     */
    #[Required]
    public ?Approval $approval;

    /**
     * The Business Application Identifier describes the type of transaction being performed. Your program must be approved for the specified Business Application Identifier in order to use it.
     *
     * @var value-of<BusinessApplicationIdentifier> $businessApplicationIdentifier
     */
    #[Required(
        'business_application_identifier',
        enum: BusinessApplicationIdentifier::class,
    )]
    public string $businessApplicationIdentifier;

    /**
     * If your account requires approvals for transfers and the transfer was not approved, this will contain details of the cancellation.
     */
    #[Required]
    public ?Cancellation $cancellation;

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
     * If the transfer is rejected by the card network or the destination financial institution, this will contain supplemental details.
     */
    #[Required]
    public ?Decline $decline;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * The merchant category code (MCC) of the merchant (generally your business) sending the transfer. This is a four-digit code that describes the type of business or service provided by the merchant. Your program must be approved for the specified MCC in order to use it.
     */
    #[Required('merchant_category_code')]
    public string $merchantCategoryCode;

    /**
     * The city name of the merchant (generally your business) sending the transfer.
     */
    #[Required('merchant_city_name')]
    public string $merchantCityName;

    /**
     * The merchant name shows up as the statement descriptor for the transfer. This is typically the name of your business or organization.
     */
    #[Required('merchant_name')]
    public string $merchantName;

    /**
     * For certain Business Application Identifiers, the statement descriptor is `merchant_name_prefix*sender_name`, where the `merchant_name_prefix` is a one to four character prefix that identifies the merchant.
     */
    #[Required('merchant_name_prefix')]
    public string $merchantNamePrefix;

    /**
     * The postal code of the merchant (generally your business) sending the transfer.
     */
    #[Required('merchant_postal_code')]
    public string $merchantPostalCode;

    /**
     * The state of the merchant (generally your business) sending the transfer.
     */
    #[Required('merchant_state')]
    public string $merchantState;

    /**
     * The amount that was transferred. The receiving bank will have converted this to the cardholder's currency. The amount that is applied to your Increase account matches the currency of your account.
     */
    #[Required('presentment_amount')]
    public PresentmentAmount $presentmentAmount;

    /**
     * The name of the funds recipient.
     */
    #[Required('recipient_name')]
    public string $recipientName;

    /**
     * The city of the sender.
     */
    #[Required('sender_address_city')]
    public string $senderAddressCity;

    /**
     * The address line 1 of the sender.
     */
    #[Required('sender_address_line1')]
    public string $senderAddressLine1;

    /**
     * The postal code of the sender.
     */
    #[Required('sender_address_postal_code')]
    public string $senderAddressPostalCode;

    /**
     * The state of the sender.
     */
    #[Required('sender_address_state')]
    public string $senderAddressState;

    /**
     * The name of the funds originator.
     */
    #[Required('sender_name')]
    public string $senderName;

    /**
     * The Account Number the recipient will see as having sent the transfer.
     */
    #[Required('source_account_number_id')]
    public string $sourceAccountNumberID;

    /**
     * The lifecycle status of the transfer.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * After the transfer is submitted to the card network, this will contain supplemental details.
     */
    #[Required]
    public ?Submission $submission;

    /**
     * A constant representing the object's type. For this resource it will always be `card_push_transfer`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardPushTransfer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardPushTransfer::with(
     *   id: ...,
     *   acceptance: ...,
     *   accountID: ...,
     *   approval: ...,
     *   businessApplicationIdentifier: ...,
     *   cancellation: ...,
     *   createdAt: ...,
     *   createdBy: ...,
     *   decline: ...,
     *   idempotencyKey: ...,
     *   merchantCategoryCode: ...,
     *   merchantCityName: ...,
     *   merchantName: ...,
     *   merchantNamePrefix: ...,
     *   merchantPostalCode: ...,
     *   merchantState: ...,
     *   presentmentAmount: ...,
     *   recipientName: ...,
     *   senderAddressCity: ...,
     *   senderAddressLine1: ...,
     *   senderAddressPostalCode: ...,
     *   senderAddressState: ...,
     *   senderName: ...,
     *   sourceAccountNumberID: ...,
     *   status: ...,
     *   submission: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardPushTransfer)
     *   ->withID(...)
     *   ->withAcceptance(...)
     *   ->withAccountID(...)
     *   ->withApproval(...)
     *   ->withBusinessApplicationIdentifier(...)
     *   ->withCancellation(...)
     *   ->withCreatedAt(...)
     *   ->withCreatedBy(...)
     *   ->withDecline(...)
     *   ->withIdempotencyKey(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCityName(...)
     *   ->withMerchantName(...)
     *   ->withMerchantNamePrefix(...)
     *   ->withMerchantPostalCode(...)
     *   ->withMerchantState(...)
     *   ->withPresentmentAmount(...)
     *   ->withRecipientName(...)
     *   ->withSenderAddressCity(...)
     *   ->withSenderAddressLine1(...)
     *   ->withSenderAddressPostalCode(...)
     *   ->withSenderAddressState(...)
     *   ->withSenderName(...)
     *   ->withSourceAccountNumberID(...)
     *   ->withStatus(...)
     *   ->withSubmission(...)
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
     * @param Approval|ApprovalShape|null $approval
     * @param BusinessApplicationIdentifier|value-of<BusinessApplicationIdentifier> $businessApplicationIdentifier
     * @param Cancellation|CancellationShape|null $cancellation
     * @param CreatedBy|CreatedByShape|null $createdBy
     * @param Decline|DeclineShape|null $decline
     * @param PresentmentAmount|PresentmentAmountShape $presentmentAmount
     * @param Status|value-of<Status> $status
     * @param Submission|SubmissionShape|null $submission
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Acceptance|array|null $acceptance,
        string $accountID,
        Approval|array|null $approval,
        BusinessApplicationIdentifier|string $businessApplicationIdentifier,
        Cancellation|array|null $cancellation,
        \DateTimeInterface $createdAt,
        CreatedBy|array|null $createdBy,
        Decline|array|null $decline,
        ?string $idempotencyKey,
        string $merchantCategoryCode,
        string $merchantCityName,
        string $merchantName,
        string $merchantNamePrefix,
        string $merchantPostalCode,
        string $merchantState,
        PresentmentAmount|array $presentmentAmount,
        string $recipientName,
        string $senderAddressCity,
        string $senderAddressLine1,
        string $senderAddressPostalCode,
        string $senderAddressState,
        string $senderName,
        string $sourceAccountNumberID,
        Status|string $status,
        Submission|array|null $submission,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['acceptance'] = $acceptance;
        $self['accountID'] = $accountID;
        $self['approval'] = $approval;
        $self['businessApplicationIdentifier'] = $businessApplicationIdentifier;
        $self['cancellation'] = $cancellation;
        $self['createdAt'] = $createdAt;
        $self['createdBy'] = $createdBy;
        $self['decline'] = $decline;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCityName'] = $merchantCityName;
        $self['merchantName'] = $merchantName;
        $self['merchantNamePrefix'] = $merchantNamePrefix;
        $self['merchantPostalCode'] = $merchantPostalCode;
        $self['merchantState'] = $merchantState;
        $self['presentmentAmount'] = $presentmentAmount;
        $self['recipientName'] = $recipientName;
        $self['senderAddressCity'] = $senderAddressCity;
        $self['senderAddressLine1'] = $senderAddressLine1;
        $self['senderAddressPostalCode'] = $senderAddressPostalCode;
        $self['senderAddressState'] = $senderAddressState;
        $self['senderName'] = $senderName;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;
        $self['status'] = $status;
        $self['submission'] = $submission;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Card Push Transfer's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * If the transfer is accepted by the recipient bank, this will contain supplemental details.
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
     * The Account from which the transfer was sent.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

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
     * The Business Application Identifier describes the type of transaction being performed. Your program must be approved for the specified Business Application Identifier in order to use it.
     *
     * @param BusinessApplicationIdentifier|value-of<BusinessApplicationIdentifier> $businessApplicationIdentifier
     */
    public function withBusinessApplicationIdentifier(
        BusinessApplicationIdentifier|string $businessApplicationIdentifier
    ): self {
        $self = clone $this;
        $self['businessApplicationIdentifier'] = $businessApplicationIdentifier;

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
     * If the transfer is rejected by the card network or the destination financial institution, this will contain supplemental details.
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
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    public function withIdempotencyKey(?string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * The merchant category code (MCC) of the merchant (generally your business) sending the transfer. This is a four-digit code that describes the type of business or service provided by the merchant. Your program must be approved for the specified MCC in order to use it.
     */
    public function withMerchantCategoryCode(string $merchantCategoryCode): self
    {
        $self = clone $this;
        $self['merchantCategoryCode'] = $merchantCategoryCode;

        return $self;
    }

    /**
     * The city name of the merchant (generally your business) sending the transfer.
     */
    public function withMerchantCityName(string $merchantCityName): self
    {
        $self = clone $this;
        $self['merchantCityName'] = $merchantCityName;

        return $self;
    }

    /**
     * The merchant name shows up as the statement descriptor for the transfer. This is typically the name of your business or organization.
     */
    public function withMerchantName(string $merchantName): self
    {
        $self = clone $this;
        $self['merchantName'] = $merchantName;

        return $self;
    }

    /**
     * For certain Business Application Identifiers, the statement descriptor is `merchant_name_prefix*sender_name`, where the `merchant_name_prefix` is a one to four character prefix that identifies the merchant.
     */
    public function withMerchantNamePrefix(string $merchantNamePrefix): self
    {
        $self = clone $this;
        $self['merchantNamePrefix'] = $merchantNamePrefix;

        return $self;
    }

    /**
     * The postal code of the merchant (generally your business) sending the transfer.
     */
    public function withMerchantPostalCode(string $merchantPostalCode): self
    {
        $self = clone $this;
        $self['merchantPostalCode'] = $merchantPostalCode;

        return $self;
    }

    /**
     * The state of the merchant (generally your business) sending the transfer.
     */
    public function withMerchantState(string $merchantState): self
    {
        $self = clone $this;
        $self['merchantState'] = $merchantState;

        return $self;
    }

    /**
     * The amount that was transferred. The receiving bank will have converted this to the cardholder's currency. The amount that is applied to your Increase account matches the currency of your account.
     *
     * @param PresentmentAmount|PresentmentAmountShape $presentmentAmount
     */
    public function withPresentmentAmount(
        PresentmentAmount|array $presentmentAmount
    ): self {
        $self = clone $this;
        $self['presentmentAmount'] = $presentmentAmount;

        return $self;
    }

    /**
     * The name of the funds recipient.
     */
    public function withRecipientName(string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * The city of the sender.
     */
    public function withSenderAddressCity(string $senderAddressCity): self
    {
        $self = clone $this;
        $self['senderAddressCity'] = $senderAddressCity;

        return $self;
    }

    /**
     * The address line 1 of the sender.
     */
    public function withSenderAddressLine1(string $senderAddressLine1): self
    {
        $self = clone $this;
        $self['senderAddressLine1'] = $senderAddressLine1;

        return $self;
    }

    /**
     * The postal code of the sender.
     */
    public function withSenderAddressPostalCode(
        string $senderAddressPostalCode
    ): self {
        $self = clone $this;
        $self['senderAddressPostalCode'] = $senderAddressPostalCode;

        return $self;
    }

    /**
     * The state of the sender.
     */
    public function withSenderAddressState(string $senderAddressState): self
    {
        $self = clone $this;
        $self['senderAddressState'] = $senderAddressState;

        return $self;
    }

    /**
     * The name of the funds originator.
     */
    public function withSenderName(string $senderName): self
    {
        $self = clone $this;
        $self['senderName'] = $senderName;

        return $self;
    }

    /**
     * The Account Number the recipient will see as having sent the transfer.
     */
    public function withSourceAccountNumberID(
        string $sourceAccountNumberID
    ): self {
        $self = clone $this;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;

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
     * After the transfer is submitted to the card network, this will contain supplemental details.
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
     * A constant representing the object's type. For this resource it will always be `card_push_transfer`.
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

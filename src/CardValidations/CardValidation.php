<?php

declare(strict_types=1);

namespace Increase\CardValidations;

use Increase\CardValidations\CardValidation\Acceptance;
use Increase\CardValidations\CardValidation\CreatedBy;
use Increase\CardValidations\CardValidation\Decline;
use Increase\CardValidations\CardValidation\Status;
use Increase\CardValidations\CardValidation\Submission;
use Increase\CardValidations\CardValidation\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Card Validations are used to validate a card and its cardholder before sending funds to or pulling funds from a card.
 *
 * @phpstan-import-type AcceptanceShape from \Increase\CardValidations\CardValidation\Acceptance
 * @phpstan-import-type CreatedByShape from \Increase\CardValidations\CardValidation\CreatedBy
 * @phpstan-import-type DeclineShape from \Increase\CardValidations\CardValidation\Decline
 * @phpstan-import-type SubmissionShape from \Increase\CardValidations\CardValidation\Submission
 *
 * @phpstan-type CardValidationShape = array{
 *   id: string,
 *   acceptance: null|Acceptance|AcceptanceShape,
 *   accountID: string,
 *   cardTokenID: string,
 *   cardholderFirstName: string|null,
 *   cardholderLastName: string|null,
 *   cardholderMiddleName: string|null,
 *   cardholderPostalCode: string|null,
 *   cardholderStreetAddress: string|null,
 *   createdAt: \DateTimeInterface,
 *   createdBy: null|CreatedBy|CreatedByShape,
 *   decline: null|Decline|DeclineShape,
 *   idempotencyKey: string|null,
 *   merchantCategoryCode: string,
 *   merchantCityName: string,
 *   merchantName: string,
 *   merchantPostalCode: string,
 *   merchantState: string,
 *   status: Status|value-of<Status>,
 *   submission: null|Submission|SubmissionShape,
 *   type: Type|value-of<Type>,
 * }
 */
final class CardValidation implements BaseModel
{
    /** @use SdkModel<CardValidationShape> */
    use SdkModel;

    /**
     * The Card Validation's identifier.
     */
    #[Required]
    public string $id;

    /**
     * If the validation is accepted by the recipient bank, this will contain supplemental details.
     */
    #[Required]
    public ?Acceptance $acceptance;

    /**
     * The identifier of the Account from which to send the validation.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The ID of the Card Token that was used to validate the card.
     */
    #[Required('card_token_id')]
    public string $cardTokenID;

    /**
     * The cardholder's first name.
     */
    #[Required('cardholder_first_name')]
    public ?string $cardholderFirstName;

    /**
     * The cardholder's last name.
     */
    #[Required('cardholder_last_name')]
    public ?string $cardholderLastName;

    /**
     * The cardholder's middle name.
     */
    #[Required('cardholder_middle_name')]
    public ?string $cardholderMiddleName;

    /**
     * The postal code of the cardholder's address.
     */
    #[Required('cardholder_postal_code')]
    public ?string $cardholderPostalCode;

    /**
     * The cardholder's street address.
     */
    #[Required('cardholder_street_address')]
    public ?string $cardholderStreetAddress;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the validation was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * What object created the validation, either via the API or the dashboard.
     */
    #[Required('created_by')]
    public ?CreatedBy $createdBy;

    /**
     * If the validation is rejected by the card network or the destination financial institution, this will contain supplemental details.
     */
    #[Required]
    public ?Decline $decline;

    /**
     * The idempotency key you chose for this object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     */
    #[Required('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * A four-digit code (MCC) identifying the type of business or service provided by the merchant.
     */
    #[Required('merchant_category_code')]
    public string $merchantCategoryCode;

    /**
     * The city where the merchant (typically your business) is located.
     */
    #[Required('merchant_city_name')]
    public string $merchantCityName;

    /**
     * The merchant name that will appear in the cardholder’s statement descriptor. Typically your business name.
     */
    #[Required('merchant_name')]
    public string $merchantName;

    /**
     * The postal code for the merchant’s (typically your business’s) location.
     */
    #[Required('merchant_postal_code')]
    public string $merchantPostalCode;

    /**
     * The U.S. state where the merchant (typically your business) is located.
     */
    #[Required('merchant_state')]
    public string $merchantState;

    /**
     * The lifecycle status of the validation.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * After the validation is submitted to the card network, this will contain supplemental details.
     */
    #[Required]
    public ?Submission $submission;

    /**
     * A constant representing the object's type. For this resource it will always be `card_validation`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardValidation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardValidation::with(
     *   id: ...,
     *   acceptance: ...,
     *   accountID: ...,
     *   cardTokenID: ...,
     *   cardholderFirstName: ...,
     *   cardholderLastName: ...,
     *   cardholderMiddleName: ...,
     *   cardholderPostalCode: ...,
     *   cardholderStreetAddress: ...,
     *   createdAt: ...,
     *   createdBy: ...,
     *   decline: ...,
     *   idempotencyKey: ...,
     *   merchantCategoryCode: ...,
     *   merchantCityName: ...,
     *   merchantName: ...,
     *   merchantPostalCode: ...,
     *   merchantState: ...,
     *   status: ...,
     *   submission: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardValidation)
     *   ->withID(...)
     *   ->withAcceptance(...)
     *   ->withAccountID(...)
     *   ->withCardTokenID(...)
     *   ->withCardholderFirstName(...)
     *   ->withCardholderLastName(...)
     *   ->withCardholderMiddleName(...)
     *   ->withCardholderPostalCode(...)
     *   ->withCardholderStreetAddress(...)
     *   ->withCreatedAt(...)
     *   ->withCreatedBy(...)
     *   ->withDecline(...)
     *   ->withIdempotencyKey(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCityName(...)
     *   ->withMerchantName(...)
     *   ->withMerchantPostalCode(...)
     *   ->withMerchantState(...)
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
     * @param CreatedBy|CreatedByShape|null $createdBy
     * @param Decline|DeclineShape|null $decline
     * @param Status|value-of<Status> $status
     * @param Submission|SubmissionShape|null $submission
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Acceptance|array|null $acceptance,
        string $accountID,
        string $cardTokenID,
        ?string $cardholderFirstName,
        ?string $cardholderLastName,
        ?string $cardholderMiddleName,
        ?string $cardholderPostalCode,
        ?string $cardholderStreetAddress,
        \DateTimeInterface $createdAt,
        CreatedBy|array|null $createdBy,
        Decline|array|null $decline,
        ?string $idempotencyKey,
        string $merchantCategoryCode,
        string $merchantCityName,
        string $merchantName,
        string $merchantPostalCode,
        string $merchantState,
        Status|string $status,
        Submission|array|null $submission,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['acceptance'] = $acceptance;
        $self['accountID'] = $accountID;
        $self['cardTokenID'] = $cardTokenID;
        $self['cardholderFirstName'] = $cardholderFirstName;
        $self['cardholderLastName'] = $cardholderLastName;
        $self['cardholderMiddleName'] = $cardholderMiddleName;
        $self['cardholderPostalCode'] = $cardholderPostalCode;
        $self['cardholderStreetAddress'] = $cardholderStreetAddress;
        $self['createdAt'] = $createdAt;
        $self['createdBy'] = $createdBy;
        $self['decline'] = $decline;
        $self['idempotencyKey'] = $idempotencyKey;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCityName'] = $merchantCityName;
        $self['merchantName'] = $merchantName;
        $self['merchantPostalCode'] = $merchantPostalCode;
        $self['merchantState'] = $merchantState;
        $self['status'] = $status;
        $self['submission'] = $submission;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Card Validation's identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * If the validation is accepted by the recipient bank, this will contain supplemental details.
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
     * The identifier of the Account from which to send the validation.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The ID of the Card Token that was used to validate the card.
     */
    public function withCardTokenID(string $cardTokenID): self
    {
        $self = clone $this;
        $self['cardTokenID'] = $cardTokenID;

        return $self;
    }

    /**
     * The cardholder's first name.
     */
    public function withCardholderFirstName(?string $cardholderFirstName): self
    {
        $self = clone $this;
        $self['cardholderFirstName'] = $cardholderFirstName;

        return $self;
    }

    /**
     * The cardholder's last name.
     */
    public function withCardholderLastName(?string $cardholderLastName): self
    {
        $self = clone $this;
        $self['cardholderLastName'] = $cardholderLastName;

        return $self;
    }

    /**
     * The cardholder's middle name.
     */
    public function withCardholderMiddleName(
        ?string $cardholderMiddleName
    ): self {
        $self = clone $this;
        $self['cardholderMiddleName'] = $cardholderMiddleName;

        return $self;
    }

    /**
     * The postal code of the cardholder's address.
     */
    public function withCardholderPostalCode(
        ?string $cardholderPostalCode
    ): self {
        $self = clone $this;
        $self['cardholderPostalCode'] = $cardholderPostalCode;

        return $self;
    }

    /**
     * The cardholder's street address.
     */
    public function withCardholderStreetAddress(
        ?string $cardholderStreetAddress
    ): self {
        $self = clone $this;
        $self['cardholderStreetAddress'] = $cardholderStreetAddress;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the validation was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * What object created the validation, either via the API or the dashboard.
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
     * If the validation is rejected by the card network or the destination financial institution, this will contain supplemental details.
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
     * A four-digit code (MCC) identifying the type of business or service provided by the merchant.
     */
    public function withMerchantCategoryCode(string $merchantCategoryCode): self
    {
        $self = clone $this;
        $self['merchantCategoryCode'] = $merchantCategoryCode;

        return $self;
    }

    /**
     * The city where the merchant (typically your business) is located.
     */
    public function withMerchantCityName(string $merchantCityName): self
    {
        $self = clone $this;
        $self['merchantCityName'] = $merchantCityName;

        return $self;
    }

    /**
     * The merchant name that will appear in the cardholder’s statement descriptor. Typically your business name.
     */
    public function withMerchantName(string $merchantName): self
    {
        $self = clone $this;
        $self['merchantName'] = $merchantName;

        return $self;
    }

    /**
     * The postal code for the merchant’s (typically your business’s) location.
     */
    public function withMerchantPostalCode(string $merchantPostalCode): self
    {
        $self = clone $this;
        $self['merchantPostalCode'] = $merchantPostalCode;

        return $self;
    }

    /**
     * The U.S. state where the merchant (typically your business) is located.
     */
    public function withMerchantState(string $merchantState): self
    {
        $self = clone $this;
        $self['merchantState'] = $merchantState;

        return $self;
    }

    /**
     * The lifecycle status of the validation.
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
     * After the validation is submitted to the card network, this will contain supplemental details.
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
     * A constant representing the object's type. For this resource it will always be `card_validation`.
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

<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element;

use Increase\CardPayments\CardPayment\Element\CardAuthentication\Category;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\Challenge;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\DenyReason;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\RequestorAuthenticationIndicator;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\RequestorChallengeIndicator;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\Status;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Authentication object. This field will be present in the JSON response if and only if `category` is equal to `card_authentication`. Card Authentications are attempts to authenticate a transaction or a card with 3DS.
 *
 * @phpstan-import-type ChallengeShape from \Increase\CardPayments\CardPayment\Element\CardAuthentication\Challenge
 * @phpstan-import-type DeviceChannelShape from \Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel
 *
 * @phpstan-type CardAuthenticationShape = array{
 *   id: string,
 *   billingAddressCity: string|null,
 *   billingAddressCountry: string|null,
 *   billingAddressLine1: string|null,
 *   billingAddressLine2: string|null,
 *   billingAddressLine3: string|null,
 *   billingAddressPostalCode: string|null,
 *   billingAddressState: string|null,
 *   cardID: string,
 *   cardPaymentID: string,
 *   cardholderEmail: string|null,
 *   cardholderName: string|null,
 *   category: null|\Increase\CardPayments\CardPayment\Element\CardAuthentication\Category|value-of<\Increase\CardPayments\CardPayment\Element\CardAuthentication\Category>,
 *   challenge: null|Challenge|ChallengeShape,
 *   createdAt: \DateTimeInterface,
 *   denyReason: null|DenyReason|value-of<DenyReason>,
 *   deviceChannel: DeviceChannel|DeviceChannelShape,
 *   merchantAcceptorID: string,
 *   merchantCategoryCode: string,
 *   merchantCountry: string,
 *   merchantName: string,
 *   priorCardAuthenticationID: string|null,
 *   purchaseAmount: int|null,
 *   purchaseCurrency: string|null,
 *   realTimeDecisionID: string|null,
 *   requestorAuthenticationIndicator: null|RequestorAuthenticationIndicator|value-of<RequestorAuthenticationIndicator>,
 *   requestorChallengeIndicator: null|RequestorChallengeIndicator|value-of<RequestorChallengeIndicator>,
 *   requestorName: string,
 *   requestorURL: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 * }
 */
final class CardAuthentication implements BaseModel
{
    /** @use SdkModel<CardAuthenticationShape> */
    use SdkModel;

    /**
     * The Card Authentication identifier.
     */
    #[Required]
    public string $id;

    /**
     * The city of the cardholder billing address associated with the card used for this purchase.
     */
    #[Required('billing_address_city')]
    public ?string $billingAddressCity;

    /**
     * The country of the cardholder billing address associated with the card used for this purchase.
     */
    #[Required('billing_address_country')]
    public ?string $billingAddressCountry;

    /**
     * The first line of the cardholder billing address associated with the card used for this purchase.
     */
    #[Required('billing_address_line1')]
    public ?string $billingAddressLine1;

    /**
     * The second line of the cardholder billing address associated with the card used for this purchase.
     */
    #[Required('billing_address_line2')]
    public ?string $billingAddressLine2;

    /**
     * The third line of the cardholder billing address associated with the card used for this purchase.
     */
    #[Required('billing_address_line3')]
    public ?string $billingAddressLine3;

    /**
     * The postal code of the cardholder billing address associated with the card used for this purchase.
     */
    #[Required('billing_address_postal_code')]
    public ?string $billingAddressPostalCode;

    /**
     * The US state of the cardholder billing address associated with the card used for this purchase.
     */
    #[Required('billing_address_state')]
    public ?string $billingAddressState;

    /**
     * The identifier of the Card.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * The ID of the Card Payment this transaction belongs to.
     */
    #[Required('card_payment_id')]
    public string $cardPaymentID;

    /**
     * The email address of the cardholder.
     */
    #[Required('cardholder_email')]
    public ?string $cardholderEmail;

    /**
     * The name of the cardholder.
     */
    #[Required('cardholder_name')]
    public ?string $cardholderName;

    /**
     * The category of the card authentication attempt.
     *
     * @var value-of<Category>|null $category
     */
    #[Required(
        enum: Category::class,
    )]
    public ?string $category;

    /**
     * Details about the challenge, if one was requested.
     */
    #[Required]
    public ?Challenge $challenge;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Card Authentication was attempted.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The reason why this authentication attempt was denied, if it was.
     *
     * @var value-of<DenyReason>|null $denyReason
     */
    #[Required('deny_reason', enum: DenyReason::class)]
    public ?string $denyReason;

    /**
     * The device channel of the card authentication attempt.
     */
    #[Required('device_channel')]
    public DeviceChannel $deviceChannel;

    /**
     * The merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with.
     */
    #[Required('merchant_acceptor_id')]
    public string $merchantAcceptorID;

    /**
     * The Merchant Category Code (commonly abbreviated as MCC) of the merchant the card is transacting with.
     */
    #[Required('merchant_category_code')]
    public string $merchantCategoryCode;

    /**
     * The country the merchant resides in.
     */
    #[Required('merchant_country')]
    public string $merchantCountry;

    /**
     * The name of the merchant.
     */
    #[Required('merchant_name')]
    public string $merchantName;

    /**
     * The ID of a prior Card Authentication that the requestor used to authenticate this cardholder for a previous transaction.
     */
    #[Required('prior_card_authentication_id')]
    public ?string $priorCardAuthenticationID;

    /**
     * The purchase amount in minor units.
     */
    #[Required('purchase_amount')]
    public ?int $purchaseAmount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the authentication attempt's purchase currency.
     */
    #[Required('purchase_currency')]
    public ?string $purchaseCurrency;

    /**
     * The identifier of the Real-Time Decision sent to approve or decline this authentication attempt.
     */
    #[Required('real_time_decision_id')]
    public ?string $realTimeDecisionID;

    /**
     * The 3DS requestor authentication indicator describes why the authentication attempt is performed, such as for a recurring transaction.
     *
     * @var value-of<RequestorAuthenticationIndicator>|null $requestorAuthenticationIndicator
     */
    #[Required(
        'requestor_authentication_indicator',
        enum: RequestorAuthenticationIndicator::class,
    )]
    public ?string $requestorAuthenticationIndicator;

    /**
     * Indicates whether a challenge is requested for this transaction.
     *
     * @var value-of<RequestorChallengeIndicator>|null $requestorChallengeIndicator
     */
    #[Required(
        'requestor_challenge_indicator',
        enum: RequestorChallengeIndicator::class
    )]
    public ?string $requestorChallengeIndicator;

    /**
     * The name of the 3DS requestor.
     */
    #[Required('requestor_name')]
    public string $requestorName;

    /**
     * The URL of the 3DS requestor.
     */
    #[Required('requestor_url')]
    public string $requestorURL;

    /**
     * The status of the card authentication.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A constant representing the object's type. For this resource it will always be `card_authentication`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardAuthentication()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthentication::with(
     *   id: ...,
     *   billingAddressCity: ...,
     *   billingAddressCountry: ...,
     *   billingAddressLine1: ...,
     *   billingAddressLine2: ...,
     *   billingAddressLine3: ...,
     *   billingAddressPostalCode: ...,
     *   billingAddressState: ...,
     *   cardID: ...,
     *   cardPaymentID: ...,
     *   cardholderEmail: ...,
     *   cardholderName: ...,
     *   category: ...,
     *   challenge: ...,
     *   createdAt: ...,
     *   denyReason: ...,
     *   deviceChannel: ...,
     *   merchantAcceptorID: ...,
     *   merchantCategoryCode: ...,
     *   merchantCountry: ...,
     *   merchantName: ...,
     *   priorCardAuthenticationID: ...,
     *   purchaseAmount: ...,
     *   purchaseCurrency: ...,
     *   realTimeDecisionID: ...,
     *   requestorAuthenticationIndicator: ...,
     *   requestorChallengeIndicator: ...,
     *   requestorName: ...,
     *   requestorURL: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthentication)
     *   ->withID(...)
     *   ->withBillingAddressCity(...)
     *   ->withBillingAddressCountry(...)
     *   ->withBillingAddressLine1(...)
     *   ->withBillingAddressLine2(...)
     *   ->withBillingAddressLine3(...)
     *   ->withBillingAddressPostalCode(...)
     *   ->withBillingAddressState(...)
     *   ->withCardID(...)
     *   ->withCardPaymentID(...)
     *   ->withCardholderEmail(...)
     *   ->withCardholderName(...)
     *   ->withCategory(...)
     *   ->withChallenge(...)
     *   ->withCreatedAt(...)
     *   ->withDenyReason(...)
     *   ->withDeviceChannel(...)
     *   ->withMerchantAcceptorID(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCountry(...)
     *   ->withMerchantName(...)
     *   ->withPriorCardAuthenticationID(...)
     *   ->withPurchaseAmount(...)
     *   ->withPurchaseCurrency(...)
     *   ->withRealTimeDecisionID(...)
     *   ->withRequestorAuthenticationIndicator(...)
     *   ->withRequestorChallengeIndicator(...)
     *   ->withRequestorName(...)
     *   ->withRequestorURL(...)
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
     * @param Category|value-of<Category>|null $category
     * @param Challenge|ChallengeShape|null $challenge
     * @param DenyReason|value-of<DenyReason>|null $denyReason
     * @param DeviceChannel|DeviceChannelShape $deviceChannel
     * @param RequestorAuthenticationIndicator|value-of<RequestorAuthenticationIndicator>|null $requestorAuthenticationIndicator
     * @param RequestorChallengeIndicator|value-of<RequestorChallengeIndicator>|null $requestorChallengeIndicator
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        ?string $billingAddressCity,
        ?string $billingAddressCountry,
        ?string $billingAddressLine1,
        ?string $billingAddressLine2,
        ?string $billingAddressLine3,
        ?string $billingAddressPostalCode,
        ?string $billingAddressState,
        string $cardID,
        string $cardPaymentID,
        ?string $cardholderEmail,
        ?string $cardholderName,
        Category|string|null $category,
        Challenge|array|null $challenge,
        \DateTimeInterface $createdAt,
        DenyReason|string|null $denyReason,
        DeviceChannel|array $deviceChannel,
        string $merchantAcceptorID,
        string $merchantCategoryCode,
        string $merchantCountry,
        string $merchantName,
        ?string $priorCardAuthenticationID,
        ?int $purchaseAmount,
        ?string $purchaseCurrency,
        ?string $realTimeDecisionID,
        RequestorAuthenticationIndicator|string|null $requestorAuthenticationIndicator,
        RequestorChallengeIndicator|string|null $requestorChallengeIndicator,
        string $requestorName,
        string $requestorURL,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['billingAddressCity'] = $billingAddressCity;
        $self['billingAddressCountry'] = $billingAddressCountry;
        $self['billingAddressLine1'] = $billingAddressLine1;
        $self['billingAddressLine2'] = $billingAddressLine2;
        $self['billingAddressLine3'] = $billingAddressLine3;
        $self['billingAddressPostalCode'] = $billingAddressPostalCode;
        $self['billingAddressState'] = $billingAddressState;
        $self['cardID'] = $cardID;
        $self['cardPaymentID'] = $cardPaymentID;
        $self['cardholderEmail'] = $cardholderEmail;
        $self['cardholderName'] = $cardholderName;
        $self['category'] = $category;
        $self['challenge'] = $challenge;
        $self['createdAt'] = $createdAt;
        $self['denyReason'] = $denyReason;
        $self['deviceChannel'] = $deviceChannel;
        $self['merchantAcceptorID'] = $merchantAcceptorID;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCountry'] = $merchantCountry;
        $self['merchantName'] = $merchantName;
        $self['priorCardAuthenticationID'] = $priorCardAuthenticationID;
        $self['purchaseAmount'] = $purchaseAmount;
        $self['purchaseCurrency'] = $purchaseCurrency;
        $self['realTimeDecisionID'] = $realTimeDecisionID;
        $self['requestorAuthenticationIndicator'] = $requestorAuthenticationIndicator;
        $self['requestorChallengeIndicator'] = $requestorChallengeIndicator;
        $self['requestorName'] = $requestorName;
        $self['requestorURL'] = $requestorURL;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Card Authentication identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The city of the cardholder billing address associated with the card used for this purchase.
     */
    public function withBillingAddressCity(?string $billingAddressCity): self
    {
        $self = clone $this;
        $self['billingAddressCity'] = $billingAddressCity;

        return $self;
    }

    /**
     * The country of the cardholder billing address associated with the card used for this purchase.
     */
    public function withBillingAddressCountry(
        ?string $billingAddressCountry
    ): self {
        $self = clone $this;
        $self['billingAddressCountry'] = $billingAddressCountry;

        return $self;
    }

    /**
     * The first line of the cardholder billing address associated with the card used for this purchase.
     */
    public function withBillingAddressLine1(?string $billingAddressLine1): self
    {
        $self = clone $this;
        $self['billingAddressLine1'] = $billingAddressLine1;

        return $self;
    }

    /**
     * The second line of the cardholder billing address associated with the card used for this purchase.
     */
    public function withBillingAddressLine2(?string $billingAddressLine2): self
    {
        $self = clone $this;
        $self['billingAddressLine2'] = $billingAddressLine2;

        return $self;
    }

    /**
     * The third line of the cardholder billing address associated with the card used for this purchase.
     */
    public function withBillingAddressLine3(?string $billingAddressLine3): self
    {
        $self = clone $this;
        $self['billingAddressLine3'] = $billingAddressLine3;

        return $self;
    }

    /**
     * The postal code of the cardholder billing address associated with the card used for this purchase.
     */
    public function withBillingAddressPostalCode(
        ?string $billingAddressPostalCode
    ): self {
        $self = clone $this;
        $self['billingAddressPostalCode'] = $billingAddressPostalCode;

        return $self;
    }

    /**
     * The US state of the cardholder billing address associated with the card used for this purchase.
     */
    public function withBillingAddressState(?string $billingAddressState): self
    {
        $self = clone $this;
        $self['billingAddressState'] = $billingAddressState;

        return $self;
    }

    /**
     * The identifier of the Card.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * The ID of the Card Payment this transaction belongs to.
     */
    public function withCardPaymentID(string $cardPaymentID): self
    {
        $self = clone $this;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }

    /**
     * The email address of the cardholder.
     */
    public function withCardholderEmail(?string $cardholderEmail): self
    {
        $self = clone $this;
        $self['cardholderEmail'] = $cardholderEmail;

        return $self;
    }

    /**
     * The name of the cardholder.
     */
    public function withCardholderName(?string $cardholderName): self
    {
        $self = clone $this;
        $self['cardholderName'] = $cardholderName;

        return $self;
    }

    /**
     * The category of the card authentication attempt.
     *
     * @param Category|value-of<Category>|null $category
     */
    public function withCategory(
        Category|string|null $category,
    ): self {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Details about the challenge, if one was requested.
     *
     * @param Challenge|ChallengeShape|null $challenge
     */
    public function withChallenge(Challenge|array|null $challenge): self
    {
        $self = clone $this;
        $self['challenge'] = $challenge;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Card Authentication was attempted.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The reason why this authentication attempt was denied, if it was.
     *
     * @param DenyReason|value-of<DenyReason>|null $denyReason
     */
    public function withDenyReason(DenyReason|string|null $denyReason): self
    {
        $self = clone $this;
        $self['denyReason'] = $denyReason;

        return $self;
    }

    /**
     * The device channel of the card authentication attempt.
     *
     * @param DeviceChannel|DeviceChannelShape $deviceChannel
     */
    public function withDeviceChannel(DeviceChannel|array $deviceChannel): self
    {
        $self = clone $this;
        $self['deviceChannel'] = $deviceChannel;

        return $self;
    }

    /**
     * The merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with.
     */
    public function withMerchantAcceptorID(string $merchantAcceptorID): self
    {
        $self = clone $this;
        $self['merchantAcceptorID'] = $merchantAcceptorID;

        return $self;
    }

    /**
     * The Merchant Category Code (commonly abbreviated as MCC) of the merchant the card is transacting with.
     */
    public function withMerchantCategoryCode(string $merchantCategoryCode): self
    {
        $self = clone $this;
        $self['merchantCategoryCode'] = $merchantCategoryCode;

        return $self;
    }

    /**
     * The country the merchant resides in.
     */
    public function withMerchantCountry(string $merchantCountry): self
    {
        $self = clone $this;
        $self['merchantCountry'] = $merchantCountry;

        return $self;
    }

    /**
     * The name of the merchant.
     */
    public function withMerchantName(string $merchantName): self
    {
        $self = clone $this;
        $self['merchantName'] = $merchantName;

        return $self;
    }

    /**
     * The ID of a prior Card Authentication that the requestor used to authenticate this cardholder for a previous transaction.
     */
    public function withPriorCardAuthenticationID(
        ?string $priorCardAuthenticationID
    ): self {
        $self = clone $this;
        $self['priorCardAuthenticationID'] = $priorCardAuthenticationID;

        return $self;
    }

    /**
     * The purchase amount in minor units.
     */
    public function withPurchaseAmount(?int $purchaseAmount): self
    {
        $self = clone $this;
        $self['purchaseAmount'] = $purchaseAmount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the authentication attempt's purchase currency.
     */
    public function withPurchaseCurrency(?string $purchaseCurrency): self
    {
        $self = clone $this;
        $self['purchaseCurrency'] = $purchaseCurrency;

        return $self;
    }

    /**
     * The identifier of the Real-Time Decision sent to approve or decline this authentication attempt.
     */
    public function withRealTimeDecisionID(?string $realTimeDecisionID): self
    {
        $self = clone $this;
        $self['realTimeDecisionID'] = $realTimeDecisionID;

        return $self;
    }

    /**
     * The 3DS requestor authentication indicator describes why the authentication attempt is performed, such as for a recurring transaction.
     *
     * @param RequestorAuthenticationIndicator|value-of<RequestorAuthenticationIndicator>|null $requestorAuthenticationIndicator
     */
    public function withRequestorAuthenticationIndicator(
        RequestorAuthenticationIndicator|string|null $requestorAuthenticationIndicator,
    ): self {
        $self = clone $this;
        $self['requestorAuthenticationIndicator'] = $requestorAuthenticationIndicator;

        return $self;
    }

    /**
     * Indicates whether a challenge is requested for this transaction.
     *
     * @param RequestorChallengeIndicator|value-of<RequestorChallengeIndicator>|null $requestorChallengeIndicator
     */
    public function withRequestorChallengeIndicator(
        RequestorChallengeIndicator|string|null $requestorChallengeIndicator
    ): self {
        $self = clone $this;
        $self['requestorChallengeIndicator'] = $requestorChallengeIndicator;

        return $self;
    }

    /**
     * The name of the 3DS requestor.
     */
    public function withRequestorName(string $requestorName): self
    {
        $self = clone $this;
        $self['requestorName'] = $requestorName;

        return $self;
    }

    /**
     * The URL of the 3DS requestor.
     */
    public function withRequestorURL(string $requestorURL): self
    {
        $self = clone $this;
        $self['requestorURL'] = $requestorURL;

        return $self;
    }

    /**
     * The status of the card authentication.
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
     * A constant representing the object's type. For this resource it will always be `card_authentication`.
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

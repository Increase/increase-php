<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element;

use Increase\CardPayments\CardPayment\Element\CardAuthentication\Category;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\Challenge;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\DenyReason;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\Status;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * A Card Authentication object. This field will be present in the JSON response if and only if `category` is equal to `card_authentication`. Card Authentications are attempts to authenticate a transaction or a card with 3DS.
 *
 * @phpstan-import-type ChallengeShape from \Increase\CardPayments\CardPayment\Element\CardAuthentication\Challenge
 *
 * @phpstan-type CardAuthenticationShape = array{
 *   id: string,
 *   cardID: string,
 *   cardPaymentID: string,
 *   category: null|\Increase\CardPayments\CardPayment\Element\CardAuthentication\Category|value-of<\Increase\CardPayments\CardPayment\Element\CardAuthentication\Category>,
 *   challenge: null|Challenge|ChallengeShape,
 *   createdAt: \DateTimeInterface,
 *   denyReason: null|DenyReason|value-of<DenyReason>,
 *   deviceChannel: null|DeviceChannel|value-of<DeviceChannel>,
 *   merchantAcceptorID: string,
 *   merchantCategoryCode: string,
 *   merchantCountry: string,
 *   merchantName: string,
 *   purchaseAmount: int|null,
 *   purchaseCurrency: string|null,
 *   realTimeDecisionID: string|null,
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
     *
     * @var value-of<DeviceChannel>|null $deviceChannel
     */
    #[Required('device_channel', enum: DeviceChannel::class)]
    public ?string $deviceChannel;

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
     *   cardID: ...,
     *   cardPaymentID: ...,
     *   category: ...,
     *   challenge: ...,
     *   createdAt: ...,
     *   denyReason: ...,
     *   deviceChannel: ...,
     *   merchantAcceptorID: ...,
     *   merchantCategoryCode: ...,
     *   merchantCountry: ...,
     *   merchantName: ...,
     *   purchaseAmount: ...,
     *   purchaseCurrency: ...,
     *   realTimeDecisionID: ...,
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
     *   ->withCardID(...)
     *   ->withCardPaymentID(...)
     *   ->withCategory(...)
     *   ->withChallenge(...)
     *   ->withCreatedAt(...)
     *   ->withDenyReason(...)
     *   ->withDeviceChannel(...)
     *   ->withMerchantAcceptorID(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCountry(...)
     *   ->withMerchantName(...)
     *   ->withPurchaseAmount(...)
     *   ->withPurchaseCurrency(...)
     *   ->withRealTimeDecisionID(...)
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
     * @param DeviceChannel|value-of<DeviceChannel>|null $deviceChannel
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $cardID,
        string $cardPaymentID,
        Category|string|null $category,
        Challenge|array|null $challenge,
        \DateTimeInterface $createdAt,
        DenyReason|string|null $denyReason,
        DeviceChannel|string|null $deviceChannel,
        string $merchantAcceptorID,
        string $merchantCategoryCode,
        string $merchantCountry,
        string $merchantName,
        ?int $purchaseAmount,
        ?string $purchaseCurrency,
        ?string $realTimeDecisionID,
        Status|string $status,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['cardID'] = $cardID;
        $self['cardPaymentID'] = $cardPaymentID;
        $self['category'] = $category;
        $self['challenge'] = $challenge;
        $self['createdAt'] = $createdAt;
        $self['denyReason'] = $denyReason;
        $self['deviceChannel'] = $deviceChannel;
        $self['merchantAcceptorID'] = $merchantAcceptorID;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCountry'] = $merchantCountry;
        $self['merchantName'] = $merchantName;
        $self['purchaseAmount'] = $purchaseAmount;
        $self['purchaseCurrency'] = $purchaseCurrency;
        $self['realTimeDecisionID'] = $realTimeDecisionID;
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
     * @param DeviceChannel|value-of<DeviceChannel>|null $deviceChannel
     */
    public function withDeviceChannel(
        DeviceChannel|string|null $deviceChannel
    ): self {
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

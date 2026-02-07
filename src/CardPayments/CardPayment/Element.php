<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment;

use Increase\CardPayments\CardPayment\Element\CardAuthentication;
use Increase\CardPayments\CardPayment\Element\CardAuthorization;
use Increase\CardPayments\CardPayment\Element\CardAuthorizationExpiration;
use Increase\CardPayments\CardPayment\Element\CardBalanceInquiry;
use Increase\CardPayments\CardPayment\Element\CardDecline;
use Increase\CardPayments\CardPayment\Element\CardFinancial;
use Increase\CardPayments\CardPayment\Element\CardFuelConfirmation;
use Increase\CardPayments\CardPayment\Element\CardIncrement;
use Increase\CardPayments\CardPayment\Element\CardRefund;
use Increase\CardPayments\CardPayment\Element\CardReversal;
use Increase\CardPayments\CardPayment\Element\CardSettlement;
use Increase\CardPayments\CardPayment\Element\CardValidation;
use Increase\CardPayments\CardPayment\Element\Category;
use Increase\CardPayments\CardPayment\Element\Other;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CardAuthenticationShape from \Increase\CardPayments\CardPayment\Element\CardAuthentication
 * @phpstan-import-type CardAuthorizationShape from \Increase\CardPayments\CardPayment\Element\CardAuthorization
 * @phpstan-import-type CardAuthorizationExpirationShape from \Increase\CardPayments\CardPayment\Element\CardAuthorizationExpiration
 * @phpstan-import-type CardBalanceInquiryShape from \Increase\CardPayments\CardPayment\Element\CardBalanceInquiry
 * @phpstan-import-type CardDeclineShape from \Increase\CardPayments\CardPayment\Element\CardDecline
 * @phpstan-import-type CardFinancialShape from \Increase\CardPayments\CardPayment\Element\CardFinancial
 * @phpstan-import-type CardFuelConfirmationShape from \Increase\CardPayments\CardPayment\Element\CardFuelConfirmation
 * @phpstan-import-type CardIncrementShape from \Increase\CardPayments\CardPayment\Element\CardIncrement
 * @phpstan-import-type CardRefundShape from \Increase\CardPayments\CardPayment\Element\CardRefund
 * @phpstan-import-type CardReversalShape from \Increase\CardPayments\CardPayment\Element\CardReversal
 * @phpstan-import-type CardSettlementShape from \Increase\CardPayments\CardPayment\Element\CardSettlement
 * @phpstan-import-type CardValidationShape from \Increase\CardPayments\CardPayment\Element\CardValidation
 * @phpstan-import-type OtherShape from \Increase\CardPayments\CardPayment\Element\Other
 *
 * @phpstan-type ElementShape = array{
 *   category: Category|value-of<Category>,
 *   createdAt: \DateTimeInterface,
 *   cardAuthentication?: null|CardAuthentication|CardAuthenticationShape,
 *   cardAuthorization?: null|CardAuthorization|CardAuthorizationShape,
 *   cardAuthorizationExpiration?: null|CardAuthorizationExpiration|CardAuthorizationExpirationShape,
 *   cardBalanceInquiry?: null|CardBalanceInquiry|CardBalanceInquiryShape,
 *   cardDecline?: null|CardDecline|CardDeclineShape,
 *   cardFinancial?: null|CardFinancial|CardFinancialShape,
 *   cardFuelConfirmation?: null|CardFuelConfirmation|CardFuelConfirmationShape,
 *   cardIncrement?: null|CardIncrement|CardIncrementShape,
 *   cardRefund?: null|CardRefund|CardRefundShape,
 *   cardReversal?: null|CardReversal|CardReversalShape,
 *   cardSettlement?: null|CardSettlement|CardSettlementShape,
 *   cardValidation?: null|CardValidation|CardValidationShape,
 *   other?: null|Other|OtherShape,
 * }
 */
final class Element implements BaseModel
{
    /** @use SdkModel<ElementShape> */
    use SdkModel;

    /**
     * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the card payment element was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * A Card Authentication object. This field will be present in the JSON response if and only if `category` is equal to `card_authentication`. Card Authentications are attempts to authenticate a transaction or a card with 3DS.
     */
    #[Optional('card_authentication', nullable: true)]
    public ?CardAuthentication $cardAuthentication;

    /**
     * A Card Authorization object. This field will be present in the JSON response if and only if `category` is equal to `card_authorization`. Card Authorizations are temporary holds placed on a customers funds with the intent to later clear a transaction.
     */
    #[Optional('card_authorization', nullable: true)]
    public ?CardAuthorization $cardAuthorization;

    /**
     * A Card Authorization Expiration object. This field will be present in the JSON response if and only if `category` is equal to `card_authorization_expiration`. Card Authorization Expirations are cancellations of authorizations that were never settled by the acquirer.
     */
    #[Optional('card_authorization_expiration', nullable: true)]
    public ?CardAuthorizationExpiration $cardAuthorizationExpiration;

    /**
     * A Card Balance Inquiry object. This field will be present in the JSON response if and only if `category` is equal to `card_balance_inquiry`. Card Balance Inquiries are transactions that allow merchants to check the available balance on a card without placing a hold on funds, commonly used when a customer requests their balance at an ATM.
     */
    #[Optional('card_balance_inquiry', nullable: true)]
    public ?CardBalanceInquiry $cardBalanceInquiry;

    /**
     * A Card Decline object. This field will be present in the JSON response if and only if `category` is equal to `card_decline`.
     */
    #[Optional('card_decline', nullable: true)]
    public ?CardDecline $cardDecline;

    /**
     * A Card Financial object. This field will be present in the JSON response if and only if `category` is equal to `card_financial`. Card Financials are temporary holds placed on a customers funds with the intent to later clear a transaction.
     */
    #[Optional('card_financial', nullable: true)]
    public ?CardFinancial $cardFinancial;

    /**
     * A Card Fuel Confirmation object. This field will be present in the JSON response if and only if `category` is equal to `card_fuel_confirmation`. Card Fuel Confirmations update the amount of a Card Authorization after a fuel pump transaction is completed.
     */
    #[Optional('card_fuel_confirmation', nullable: true)]
    public ?CardFuelConfirmation $cardFuelConfirmation;

    /**
     * A Card Increment object. This field will be present in the JSON response if and only if `category` is equal to `card_increment`. Card Increments increase the pending amount of an authorized transaction.
     */
    #[Optional('card_increment', nullable: true)]
    public ?CardIncrement $cardIncrement;

    /**
     * A Card Refund object. This field will be present in the JSON response if and only if `category` is equal to `card_refund`. Card Refunds move money back to the cardholder. While they are usually connected to a Card Settlement an acquirer can also refund money directly to a card without relation to a transaction.
     */
    #[Optional('card_refund', nullable: true)]
    public ?CardRefund $cardRefund;

    /**
     * A Card Reversal object. This field will be present in the JSON response if and only if `category` is equal to `card_reversal`. Card Reversals cancel parts of or the entirety of an existing Card Authorization.
     */
    #[Optional('card_reversal', nullable: true)]
    public ?CardReversal $cardReversal;

    /**
     * A Card Settlement object. This field will be present in the JSON response if and only if `category` is equal to `card_settlement`. Card Settlements are card transactions that have cleared and settled. While a settlement is usually preceded by an authorization, an acquirer can also directly clear a transaction without first authorizing it.
     */
    #[Optional('card_settlement', nullable: true)]
    public ?CardSettlement $cardSettlement;

    /**
     * An Inbound Card Validation object. This field will be present in the JSON response if and only if `category` is equal to `card_validation`. Inbound Card Validations are requests from a merchant to verify that a card number and optionally its address and/or Card Verification Value are valid.
     */
    #[Optional('card_validation', nullable: true)]
    public ?CardValidation $cardValidation;

    /**
     * If the category of this Transaction source is equal to `other`, this field will contain an empty object, otherwise it will contain null.
     */
    #[Optional(nullable: true)]
    public ?Other $other;

    /**
     * `new Element()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Element::with(category: ..., createdAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Element)->withCategory(...)->withCreatedAt(...)
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
     * @param Category|value-of<Category> $category
     * @param CardAuthentication|CardAuthenticationShape|null $cardAuthentication
     * @param CardAuthorization|CardAuthorizationShape|null $cardAuthorization
     * @param CardAuthorizationExpiration|CardAuthorizationExpirationShape|null $cardAuthorizationExpiration
     * @param CardBalanceInquiry|CardBalanceInquiryShape|null $cardBalanceInquiry
     * @param CardDecline|CardDeclineShape|null $cardDecline
     * @param CardFinancial|CardFinancialShape|null $cardFinancial
     * @param CardFuelConfirmation|CardFuelConfirmationShape|null $cardFuelConfirmation
     * @param CardIncrement|CardIncrementShape|null $cardIncrement
     * @param CardRefund|CardRefundShape|null $cardRefund
     * @param CardReversal|CardReversalShape|null $cardReversal
     * @param CardSettlement|CardSettlementShape|null $cardSettlement
     * @param CardValidation|CardValidationShape|null $cardValidation
     * @param Other|OtherShape|null $other
     */
    public static function with(
        Category|string $category,
        \DateTimeInterface $createdAt,
        CardAuthentication|array|null $cardAuthentication = null,
        CardAuthorization|array|null $cardAuthorization = null,
        CardAuthorizationExpiration|array|null $cardAuthorizationExpiration = null,
        CardBalanceInquiry|array|null $cardBalanceInquiry = null,
        CardDecline|array|null $cardDecline = null,
        CardFinancial|array|null $cardFinancial = null,
        CardFuelConfirmation|array|null $cardFuelConfirmation = null,
        CardIncrement|array|null $cardIncrement = null,
        CardRefund|array|null $cardRefund = null,
        CardReversal|array|null $cardReversal = null,
        CardSettlement|array|null $cardSettlement = null,
        CardValidation|array|null $cardValidation = null,
        Other|array|null $other = null,
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['createdAt'] = $createdAt;

        null !== $cardAuthentication && $self['cardAuthentication'] = $cardAuthentication;
        null !== $cardAuthorization && $self['cardAuthorization'] = $cardAuthorization;
        null !== $cardAuthorizationExpiration && $self['cardAuthorizationExpiration'] = $cardAuthorizationExpiration;
        null !== $cardBalanceInquiry && $self['cardBalanceInquiry'] = $cardBalanceInquiry;
        null !== $cardDecline && $self['cardDecline'] = $cardDecline;
        null !== $cardFinancial && $self['cardFinancial'] = $cardFinancial;
        null !== $cardFuelConfirmation && $self['cardFuelConfirmation'] = $cardFuelConfirmation;
        null !== $cardIncrement && $self['cardIncrement'] = $cardIncrement;
        null !== $cardRefund && $self['cardRefund'] = $cardRefund;
        null !== $cardReversal && $self['cardReversal'] = $cardReversal;
        null !== $cardSettlement && $self['cardSettlement'] = $cardSettlement;
        null !== $cardValidation && $self['cardValidation'] = $cardValidation;
        null !== $other && $self['other'] = $other;

        return $self;
    }

    /**
     * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the card payment element was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * A Card Authentication object. This field will be present in the JSON response if and only if `category` is equal to `card_authentication`. Card Authentications are attempts to authenticate a transaction or a card with 3DS.
     *
     * @param CardAuthentication|CardAuthenticationShape|null $cardAuthentication
     */
    public function withCardAuthentication(
        CardAuthentication|array|null $cardAuthentication
    ): self {
        $self = clone $this;
        $self['cardAuthentication'] = $cardAuthentication;

        return $self;
    }

    /**
     * A Card Authorization object. This field will be present in the JSON response if and only if `category` is equal to `card_authorization`. Card Authorizations are temporary holds placed on a customers funds with the intent to later clear a transaction.
     *
     * @param CardAuthorization|CardAuthorizationShape|null $cardAuthorization
     */
    public function withCardAuthorization(
        CardAuthorization|array|null $cardAuthorization
    ): self {
        $self = clone $this;
        $self['cardAuthorization'] = $cardAuthorization;

        return $self;
    }

    /**
     * A Card Authorization Expiration object. This field will be present in the JSON response if and only if `category` is equal to `card_authorization_expiration`. Card Authorization Expirations are cancellations of authorizations that were never settled by the acquirer.
     *
     * @param CardAuthorizationExpiration|CardAuthorizationExpirationShape|null $cardAuthorizationExpiration
     */
    public function withCardAuthorizationExpiration(
        CardAuthorizationExpiration|array|null $cardAuthorizationExpiration
    ): self {
        $self = clone $this;
        $self['cardAuthorizationExpiration'] = $cardAuthorizationExpiration;

        return $self;
    }

    /**
     * A Card Balance Inquiry object. This field will be present in the JSON response if and only if `category` is equal to `card_balance_inquiry`. Card Balance Inquiries are transactions that allow merchants to check the available balance on a card without placing a hold on funds, commonly used when a customer requests their balance at an ATM.
     *
     * @param CardBalanceInquiry|CardBalanceInquiryShape|null $cardBalanceInquiry
     */
    public function withCardBalanceInquiry(
        CardBalanceInquiry|array|null $cardBalanceInquiry
    ): self {
        $self = clone $this;
        $self['cardBalanceInquiry'] = $cardBalanceInquiry;

        return $self;
    }

    /**
     * A Card Decline object. This field will be present in the JSON response if and only if `category` is equal to `card_decline`.
     *
     * @param CardDecline|CardDeclineShape|null $cardDecline
     */
    public function withCardDecline(CardDecline|array|null $cardDecline): self
    {
        $self = clone $this;
        $self['cardDecline'] = $cardDecline;

        return $self;
    }

    /**
     * A Card Financial object. This field will be present in the JSON response if and only if `category` is equal to `card_financial`. Card Financials are temporary holds placed on a customers funds with the intent to later clear a transaction.
     *
     * @param CardFinancial|CardFinancialShape|null $cardFinancial
     */
    public function withCardFinancial(
        CardFinancial|array|null $cardFinancial
    ): self {
        $self = clone $this;
        $self['cardFinancial'] = $cardFinancial;

        return $self;
    }

    /**
     * A Card Fuel Confirmation object. This field will be present in the JSON response if and only if `category` is equal to `card_fuel_confirmation`. Card Fuel Confirmations update the amount of a Card Authorization after a fuel pump transaction is completed.
     *
     * @param CardFuelConfirmation|CardFuelConfirmationShape|null $cardFuelConfirmation
     */
    public function withCardFuelConfirmation(
        CardFuelConfirmation|array|null $cardFuelConfirmation
    ): self {
        $self = clone $this;
        $self['cardFuelConfirmation'] = $cardFuelConfirmation;

        return $self;
    }

    /**
     * A Card Increment object. This field will be present in the JSON response if and only if `category` is equal to `card_increment`. Card Increments increase the pending amount of an authorized transaction.
     *
     * @param CardIncrement|CardIncrementShape|null $cardIncrement
     */
    public function withCardIncrement(
        CardIncrement|array|null $cardIncrement
    ): self {
        $self = clone $this;
        $self['cardIncrement'] = $cardIncrement;

        return $self;
    }

    /**
     * A Card Refund object. This field will be present in the JSON response if and only if `category` is equal to `card_refund`. Card Refunds move money back to the cardholder. While they are usually connected to a Card Settlement an acquirer can also refund money directly to a card without relation to a transaction.
     *
     * @param CardRefund|CardRefundShape|null $cardRefund
     */
    public function withCardRefund(CardRefund|array|null $cardRefund): self
    {
        $self = clone $this;
        $self['cardRefund'] = $cardRefund;

        return $self;
    }

    /**
     * A Card Reversal object. This field will be present in the JSON response if and only if `category` is equal to `card_reversal`. Card Reversals cancel parts of or the entirety of an existing Card Authorization.
     *
     * @param CardReversal|CardReversalShape|null $cardReversal
     */
    public function withCardReversal(
        CardReversal|array|null $cardReversal
    ): self {
        $self = clone $this;
        $self['cardReversal'] = $cardReversal;

        return $self;
    }

    /**
     * A Card Settlement object. This field will be present in the JSON response if and only if `category` is equal to `card_settlement`. Card Settlements are card transactions that have cleared and settled. While a settlement is usually preceded by an authorization, an acquirer can also directly clear a transaction without first authorizing it.
     *
     * @param CardSettlement|CardSettlementShape|null $cardSettlement
     */
    public function withCardSettlement(
        CardSettlement|array|null $cardSettlement
    ): self {
        $self = clone $this;
        $self['cardSettlement'] = $cardSettlement;

        return $self;
    }

    /**
     * An Inbound Card Validation object. This field will be present in the JSON response if and only if `category` is equal to `card_validation`. Inbound Card Validations are requests from a merchant to verify that a card number and optionally its address and/or Card Verification Value are valid.
     *
     * @param CardValidation|CardValidationShape|null $cardValidation
     */
    public function withCardValidation(
        CardValidation|array|null $cardValidation
    ): self {
        $self = clone $this;
        $self['cardValidation'] = $cardValidation;

        return $self;
    }

    /**
     * If the category of this Transaction source is equal to `other`, this field will contain an empty object, otherwise it will contain null.
     *
     * @param Other|OtherShape|null $other
     */
    public function withOther(Other|array|null $other): self
    {
        $self = clone $this;
        $self['other'] = $other;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\Decision;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\DeviceChannel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\MessageCategory;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\RequestorAuthenticationIndicator;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\RequestorChallengeIndicator;

/**
 * Fields related to a 3DS authentication attempt.
 *
 * @phpstan-import-type DeviceChannelShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\DeviceChannel
 * @phpstan-import-type MessageCategoryShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\MessageCategory
 *
 * @phpstan-type CardAuthenticationShape = array{
 *   accessControlServerTransactionIdentifier: string,
 *   accountID: string,
 *   billingAddressCity: string|null,
 *   billingAddressCountry: string|null,
 *   billingAddressLine1: string|null,
 *   billingAddressLine2: string|null,
 *   billingAddressLine3: string|null,
 *   billingAddressPostalCode: string|null,
 *   billingAddressState: string|null,
 *   cardID: string,
 *   cardholderEmail: string|null,
 *   cardholderName: string|null,
 *   decision: null|Decision|value-of<Decision>,
 *   deviceChannel: DeviceChannel|DeviceChannelShape,
 *   directoryServerTransactionIdentifier: string,
 *   merchantAcceptorID: string|null,
 *   merchantCategoryCode: string|null,
 *   merchantCountry: string|null,
 *   merchantName: string|null,
 *   messageCategory: MessageCategory|MessageCategoryShape,
 *   priorAuthenticatedCardPaymentID: string|null,
 *   requestorAuthenticationIndicator: null|RequestorAuthenticationIndicator|value-of<RequestorAuthenticationIndicator>,
 *   requestorChallengeIndicator: null|RequestorChallengeIndicator|value-of<RequestorChallengeIndicator>,
 *   requestorName: string,
 *   requestorURL: string,
 *   shippingAddressCity: string|null,
 *   shippingAddressCountry: string|null,
 *   shippingAddressLine1: string|null,
 *   shippingAddressLine2: string|null,
 *   shippingAddressLine3: string|null,
 *   shippingAddressPostalCode: string|null,
 *   shippingAddressState: string|null,
 *   threeDSecureServerTransactionIdentifier: string,
 *   upcomingCardPaymentID: string,
 * }
 */
final class CardAuthentication implements BaseModel
{
    /** @use SdkModel<CardAuthenticationShape> */
    use SdkModel;

    /**
     * A unique identifier assigned by the Access Control Server (us) for this transaction.
     */
    #[Required('access_control_server_transaction_identifier')]
    public string $accessControlServerTransactionIdentifier;

    /**
     * The identifier of the Account the card belongs to.
     */
    #[Required('account_id')]
    public string $accountID;

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
     * Whether or not the authentication attempt was approved.
     *
     * @var value-of<Decision>|null $decision
     */
    #[Required(enum: Decision::class)]
    public ?string $decision;

    /**
     * The device channel of the card authentication attempt.
     */
    #[Required('device_channel')]
    public DeviceChannel $deviceChannel;

    /**
     * A unique identifier assigned by the Directory Server (the card network) for this transaction.
     */
    #[Required('directory_server_transaction_identifier')]
    public string $directoryServerTransactionIdentifier;

    /**
     * The merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with.
     */
    #[Required('merchant_acceptor_id')]
    public ?string $merchantAcceptorID;

    /**
     * The Merchant Category Code (commonly abbreviated as MCC) of the merchant the card is transacting with.
     */
    #[Required('merchant_category_code')]
    public ?string $merchantCategoryCode;

    /**
     * The country the merchant resides in.
     */
    #[Required('merchant_country')]
    public ?string $merchantCountry;

    /**
     * The name of the merchant.
     */
    #[Required('merchant_name')]
    public ?string $merchantName;

    /**
     * The message category of the card authentication attempt.
     */
    #[Required('message_category')]
    public MessageCategory $messageCategory;

    /**
     * The ID of a prior Card Authentication that the requestor used to authenticate this cardholder for a previous transaction.
     */
    #[Required('prior_authenticated_card_payment_id')]
    public ?string $priorAuthenticatedCardPaymentID;

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
     * The city of the shipping address associated with this purchase.
     */
    #[Required('shipping_address_city')]
    public ?string $shippingAddressCity;

    /**
     * The country of the shipping address associated with this purchase.
     */
    #[Required('shipping_address_country')]
    public ?string $shippingAddressCountry;

    /**
     * The first line of the shipping address associated with this purchase.
     */
    #[Required('shipping_address_line1')]
    public ?string $shippingAddressLine1;

    /**
     * The second line of the shipping address associated with this purchase.
     */
    #[Required('shipping_address_line2')]
    public ?string $shippingAddressLine2;

    /**
     * The third line of the shipping address associated with this purchase.
     */
    #[Required('shipping_address_line3')]
    public ?string $shippingAddressLine3;

    /**
     * The postal code of the shipping address associated with this purchase.
     */
    #[Required('shipping_address_postal_code')]
    public ?string $shippingAddressPostalCode;

    /**
     * The US state of the shipping address associated with this purchase.
     */
    #[Required('shipping_address_state')]
    public ?string $shippingAddressState;

    /**
     * A unique identifier assigned by the 3DS Server initiating the authentication attempt for this transaction.
     */
    #[Required('three_d_secure_server_transaction_identifier')]
    public string $threeDSecureServerTransactionIdentifier;

    /**
     * The identifier of the Card Payment this authentication attempt will belong to. Available in the API once the card authentication has completed.
     */
    #[Required('upcoming_card_payment_id')]
    public string $upcomingCardPaymentID;

    /**
     * `new CardAuthentication()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthentication::with(
     *   accessControlServerTransactionIdentifier: ...,
     *   accountID: ...,
     *   billingAddressCity: ...,
     *   billingAddressCountry: ...,
     *   billingAddressLine1: ...,
     *   billingAddressLine2: ...,
     *   billingAddressLine3: ...,
     *   billingAddressPostalCode: ...,
     *   billingAddressState: ...,
     *   cardID: ...,
     *   cardholderEmail: ...,
     *   cardholderName: ...,
     *   decision: ...,
     *   deviceChannel: ...,
     *   directoryServerTransactionIdentifier: ...,
     *   merchantAcceptorID: ...,
     *   merchantCategoryCode: ...,
     *   merchantCountry: ...,
     *   merchantName: ...,
     *   messageCategory: ...,
     *   priorAuthenticatedCardPaymentID: ...,
     *   requestorAuthenticationIndicator: ...,
     *   requestorChallengeIndicator: ...,
     *   requestorName: ...,
     *   requestorURL: ...,
     *   shippingAddressCity: ...,
     *   shippingAddressCountry: ...,
     *   shippingAddressLine1: ...,
     *   shippingAddressLine2: ...,
     *   shippingAddressLine3: ...,
     *   shippingAddressPostalCode: ...,
     *   shippingAddressState: ...,
     *   threeDSecureServerTransactionIdentifier: ...,
     *   upcomingCardPaymentID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthentication)
     *   ->withAccessControlServerTransactionIdentifier(...)
     *   ->withAccountID(...)
     *   ->withBillingAddressCity(...)
     *   ->withBillingAddressCountry(...)
     *   ->withBillingAddressLine1(...)
     *   ->withBillingAddressLine2(...)
     *   ->withBillingAddressLine3(...)
     *   ->withBillingAddressPostalCode(...)
     *   ->withBillingAddressState(...)
     *   ->withCardID(...)
     *   ->withCardholderEmail(...)
     *   ->withCardholderName(...)
     *   ->withDecision(...)
     *   ->withDeviceChannel(...)
     *   ->withDirectoryServerTransactionIdentifier(...)
     *   ->withMerchantAcceptorID(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCountry(...)
     *   ->withMerchantName(...)
     *   ->withMessageCategory(...)
     *   ->withPriorAuthenticatedCardPaymentID(...)
     *   ->withRequestorAuthenticationIndicator(...)
     *   ->withRequestorChallengeIndicator(...)
     *   ->withRequestorName(...)
     *   ->withRequestorURL(...)
     *   ->withShippingAddressCity(...)
     *   ->withShippingAddressCountry(...)
     *   ->withShippingAddressLine1(...)
     *   ->withShippingAddressLine2(...)
     *   ->withShippingAddressLine3(...)
     *   ->withShippingAddressPostalCode(...)
     *   ->withShippingAddressState(...)
     *   ->withThreeDSecureServerTransactionIdentifier(...)
     *   ->withUpcomingCardPaymentID(...)
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
     * @param Decision|value-of<Decision>|null $decision
     * @param DeviceChannel|DeviceChannelShape $deviceChannel
     * @param MessageCategory|MessageCategoryShape $messageCategory
     * @param RequestorAuthenticationIndicator|value-of<RequestorAuthenticationIndicator>|null $requestorAuthenticationIndicator
     * @param RequestorChallengeIndicator|value-of<RequestorChallengeIndicator>|null $requestorChallengeIndicator
     */
    public static function with(
        string $accessControlServerTransactionIdentifier,
        string $accountID,
        ?string $billingAddressCity,
        ?string $billingAddressCountry,
        ?string $billingAddressLine1,
        ?string $billingAddressLine2,
        ?string $billingAddressLine3,
        ?string $billingAddressPostalCode,
        ?string $billingAddressState,
        string $cardID,
        ?string $cardholderEmail,
        ?string $cardholderName,
        Decision|string|null $decision,
        DeviceChannel|array $deviceChannel,
        string $directoryServerTransactionIdentifier,
        ?string $merchantAcceptorID,
        ?string $merchantCategoryCode,
        ?string $merchantCountry,
        ?string $merchantName,
        MessageCategory|array $messageCategory,
        ?string $priorAuthenticatedCardPaymentID,
        RequestorAuthenticationIndicator|string|null $requestorAuthenticationIndicator,
        RequestorChallengeIndicator|string|null $requestorChallengeIndicator,
        string $requestorName,
        string $requestorURL,
        ?string $shippingAddressCity,
        ?string $shippingAddressCountry,
        ?string $shippingAddressLine1,
        ?string $shippingAddressLine2,
        ?string $shippingAddressLine3,
        ?string $shippingAddressPostalCode,
        ?string $shippingAddressState,
        string $threeDSecureServerTransactionIdentifier,
        string $upcomingCardPaymentID,
    ): self {
        $self = new self;

        $self['accessControlServerTransactionIdentifier'] = $accessControlServerTransactionIdentifier;
        $self['accountID'] = $accountID;
        $self['billingAddressCity'] = $billingAddressCity;
        $self['billingAddressCountry'] = $billingAddressCountry;
        $self['billingAddressLine1'] = $billingAddressLine1;
        $self['billingAddressLine2'] = $billingAddressLine2;
        $self['billingAddressLine3'] = $billingAddressLine3;
        $self['billingAddressPostalCode'] = $billingAddressPostalCode;
        $self['billingAddressState'] = $billingAddressState;
        $self['cardID'] = $cardID;
        $self['cardholderEmail'] = $cardholderEmail;
        $self['cardholderName'] = $cardholderName;
        $self['decision'] = $decision;
        $self['deviceChannel'] = $deviceChannel;
        $self['directoryServerTransactionIdentifier'] = $directoryServerTransactionIdentifier;
        $self['merchantAcceptorID'] = $merchantAcceptorID;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCountry'] = $merchantCountry;
        $self['merchantName'] = $merchantName;
        $self['messageCategory'] = $messageCategory;
        $self['priorAuthenticatedCardPaymentID'] = $priorAuthenticatedCardPaymentID;
        $self['requestorAuthenticationIndicator'] = $requestorAuthenticationIndicator;
        $self['requestorChallengeIndicator'] = $requestorChallengeIndicator;
        $self['requestorName'] = $requestorName;
        $self['requestorURL'] = $requestorURL;
        $self['shippingAddressCity'] = $shippingAddressCity;
        $self['shippingAddressCountry'] = $shippingAddressCountry;
        $self['shippingAddressLine1'] = $shippingAddressLine1;
        $self['shippingAddressLine2'] = $shippingAddressLine2;
        $self['shippingAddressLine3'] = $shippingAddressLine3;
        $self['shippingAddressPostalCode'] = $shippingAddressPostalCode;
        $self['shippingAddressState'] = $shippingAddressState;
        $self['threeDSecureServerTransactionIdentifier'] = $threeDSecureServerTransactionIdentifier;
        $self['upcomingCardPaymentID'] = $upcomingCardPaymentID;

        return $self;
    }

    /**
     * A unique identifier assigned by the Access Control Server (us) for this transaction.
     */
    public function withAccessControlServerTransactionIdentifier(
        string $accessControlServerTransactionIdentifier
    ): self {
        $self = clone $this;
        $self['accessControlServerTransactionIdentifier'] = $accessControlServerTransactionIdentifier;

        return $self;
    }

    /**
     * The identifier of the Account the card belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

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
     * Whether or not the authentication attempt was approved.
     *
     * @param Decision|value-of<Decision>|null $decision
     */
    public function withDecision(Decision|string|null $decision): self
    {
        $self = clone $this;
        $self['decision'] = $decision;

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
     * A unique identifier assigned by the Directory Server (the card network) for this transaction.
     */
    public function withDirectoryServerTransactionIdentifier(
        string $directoryServerTransactionIdentifier
    ): self {
        $self = clone $this;
        $self['directoryServerTransactionIdentifier'] = $directoryServerTransactionIdentifier;

        return $self;
    }

    /**
     * The merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with.
     */
    public function withMerchantAcceptorID(?string $merchantAcceptorID): self
    {
        $self = clone $this;
        $self['merchantAcceptorID'] = $merchantAcceptorID;

        return $self;
    }

    /**
     * The Merchant Category Code (commonly abbreviated as MCC) of the merchant the card is transacting with.
     */
    public function withMerchantCategoryCode(
        ?string $merchantCategoryCode
    ): self {
        $self = clone $this;
        $self['merchantCategoryCode'] = $merchantCategoryCode;

        return $self;
    }

    /**
     * The country the merchant resides in.
     */
    public function withMerchantCountry(?string $merchantCountry): self
    {
        $self = clone $this;
        $self['merchantCountry'] = $merchantCountry;

        return $self;
    }

    /**
     * The name of the merchant.
     */
    public function withMerchantName(?string $merchantName): self
    {
        $self = clone $this;
        $self['merchantName'] = $merchantName;

        return $self;
    }

    /**
     * The message category of the card authentication attempt.
     *
     * @param MessageCategory|MessageCategoryShape $messageCategory
     */
    public function withMessageCategory(
        MessageCategory|array $messageCategory
    ): self {
        $self = clone $this;
        $self['messageCategory'] = $messageCategory;

        return $self;
    }

    /**
     * The ID of a prior Card Authentication that the requestor used to authenticate this cardholder for a previous transaction.
     */
    public function withPriorAuthenticatedCardPaymentID(
        ?string $priorAuthenticatedCardPaymentID
    ): self {
        $self = clone $this;
        $self['priorAuthenticatedCardPaymentID'] = $priorAuthenticatedCardPaymentID;

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
     * The city of the shipping address associated with this purchase.
     */
    public function withShippingAddressCity(?string $shippingAddressCity): self
    {
        $self = clone $this;
        $self['shippingAddressCity'] = $shippingAddressCity;

        return $self;
    }

    /**
     * The country of the shipping address associated with this purchase.
     */
    public function withShippingAddressCountry(
        ?string $shippingAddressCountry
    ): self {
        $self = clone $this;
        $self['shippingAddressCountry'] = $shippingAddressCountry;

        return $self;
    }

    /**
     * The first line of the shipping address associated with this purchase.
     */
    public function withShippingAddressLine1(
        ?string $shippingAddressLine1
    ): self {
        $self = clone $this;
        $self['shippingAddressLine1'] = $shippingAddressLine1;

        return $self;
    }

    /**
     * The second line of the shipping address associated with this purchase.
     */
    public function withShippingAddressLine2(
        ?string $shippingAddressLine2
    ): self {
        $self = clone $this;
        $self['shippingAddressLine2'] = $shippingAddressLine2;

        return $self;
    }

    /**
     * The third line of the shipping address associated with this purchase.
     */
    public function withShippingAddressLine3(
        ?string $shippingAddressLine3
    ): self {
        $self = clone $this;
        $self['shippingAddressLine3'] = $shippingAddressLine3;

        return $self;
    }

    /**
     * The postal code of the shipping address associated with this purchase.
     */
    public function withShippingAddressPostalCode(
        ?string $shippingAddressPostalCode
    ): self {
        $self = clone $this;
        $self['shippingAddressPostalCode'] = $shippingAddressPostalCode;

        return $self;
    }

    /**
     * The US state of the shipping address associated with this purchase.
     */
    public function withShippingAddressState(
        ?string $shippingAddressState
    ): self {
        $self = clone $this;
        $self['shippingAddressState'] = $shippingAddressState;

        return $self;
    }

    /**
     * A unique identifier assigned by the 3DS Server initiating the authentication attempt for this transaction.
     */
    public function withThreeDSecureServerTransactionIdentifier(
        string $threeDSecureServerTransactionIdentifier
    ): self {
        $self = clone $this;
        $self['threeDSecureServerTransactionIdentifier'] = $threeDSecureServerTransactionIdentifier;

        return $self;
    }

    /**
     * The identifier of the Card Payment this authentication attempt will belong to. Available in the API once the card authentication has completed.
     */
    public function withUpcomingCardPaymentID(
        string $upcomingCardPaymentID
    ): self {
        $self = clone $this;
        $self['upcomingCardPaymentID'] = $upcomingCardPaymentID;

        return $self;
    }
}

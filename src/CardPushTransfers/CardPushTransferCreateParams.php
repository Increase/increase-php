<?php

declare(strict_types=1);

namespace Increase\CardPushTransfers;

use Increase\CardPushTransfers\CardPushTransferCreateParams\BusinessApplicationIdentifier;
use Increase\CardPushTransfers\CardPushTransferCreateParams\PresentmentAmount;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Card Push Transfer.
 *
 * @see Increase\Services\CardPushTransfersService::create()
 *
 * @phpstan-import-type PresentmentAmountShape from \Increase\CardPushTransfers\CardPushTransferCreateParams\PresentmentAmount
 *
 * @phpstan-type CardPushTransferCreateParamsShape = array{
 *   businessApplicationIdentifier: BusinessApplicationIdentifier|value-of<BusinessApplicationIdentifier>,
 *   cardTokenID: string,
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
 *   requireApproval?: bool|null,
 * }
 */
final class CardPushTransferCreateParams implements BaseModel
{
    /** @use SdkModel<CardPushTransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * The Increase identifier for the Card Token that represents the card number you're pushing funds to.
     */
    #[Required('card_token_id')]
    public string $cardTokenID;

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
     * The amount to transfer. The receiving bank will convert this to the cardholder's currency. The amount that is applied to your Increase account matches the currency of your account.
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
     * The identifier of the Account Number from which to send the transfer.
     */
    #[Required('source_account_number_id')]
    public string $sourceAccountNumberID;

    /**
     * Whether the transfer requires explicit approval via the dashboard or API.
     */
    #[Optional('require_approval')]
    public ?bool $requireApproval;

    /**
     * `new CardPushTransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardPushTransferCreateParams::with(
     *   businessApplicationIdentifier: ...,
     *   cardTokenID: ...,
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
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardPushTransferCreateParams)
     *   ->withBusinessApplicationIdentifier(...)
     *   ->withCardTokenID(...)
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
     * @param BusinessApplicationIdentifier|value-of<BusinessApplicationIdentifier> $businessApplicationIdentifier
     * @param PresentmentAmount|PresentmentAmountShape $presentmentAmount
     */
    public static function with(
        BusinessApplicationIdentifier|string $businessApplicationIdentifier,
        string $cardTokenID,
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
        ?bool $requireApproval = null,
    ): self {
        $self = new self;

        $self['businessApplicationIdentifier'] = $businessApplicationIdentifier;
        $self['cardTokenID'] = $cardTokenID;
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

        null !== $requireApproval && $self['requireApproval'] = $requireApproval;

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
     * The Increase identifier for the Card Token that represents the card number you're pushing funds to.
     */
    public function withCardTokenID(string $cardTokenID): self
    {
        $self = clone $this;
        $self['cardTokenID'] = $cardTokenID;

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
     * The amount to transfer. The receiving bank will convert this to the cardholder's currency. The amount that is applied to your Increase account matches the currency of your account.
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
     * The identifier of the Account Number from which to send the transfer.
     */
    public function withSourceAccountNumberID(
        string $sourceAccountNumberID
    ): self {
        $self = clone $this;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;

        return $self;
    }

    /**
     * Whether the transfer requires explicit approval via the dashboard or API.
     */
    public function withRequireApproval(bool $requireApproval): self
    {
        $self = clone $this;
        $self['requireApproval'] = $requireApproval;

        return $self;
    }
}

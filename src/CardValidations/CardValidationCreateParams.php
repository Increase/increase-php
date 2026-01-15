<?php

declare(strict_types=1);

namespace Increase\CardValidations;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Card Validation.
 *
 * @see Increase\Services\CardValidationsService::create()
 *
 * @phpstan-type CardValidationCreateParamsShape = array{
 *   accountID: string,
 *   cardTokenID: string,
 *   merchantCategoryCode: string,
 *   merchantCityName: string,
 *   merchantName: string,
 *   merchantPostalCode: string,
 *   merchantState: string,
 *   cardholderFirstName?: string|null,
 *   cardholderLastName?: string|null,
 *   cardholderMiddleName?: string|null,
 *   cardholderPostalCode?: string|null,
 *   cardholderStreetAddress?: string|null,
 * }
 */
final class CardValidationCreateParams implements BaseModel
{
    /** @use SdkModel<CardValidationCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Account from which to send the validation.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The Increase identifier for the Card Token that represents the card number you're validating.
     */
    #[Required('card_token_id')]
    public string $cardTokenID;

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
     * The cardholder's first name.
     */
    #[Optional('cardholder_first_name')]
    public ?string $cardholderFirstName;

    /**
     * The cardholder's last name.
     */
    #[Optional('cardholder_last_name')]
    public ?string $cardholderLastName;

    /**
     * The cardholder's middle name.
     */
    #[Optional('cardholder_middle_name')]
    public ?string $cardholderMiddleName;

    /**
     * The postal code of the cardholder's address.
     */
    #[Optional('cardholder_postal_code')]
    public ?string $cardholderPostalCode;

    /**
     * The cardholder's street address.
     */
    #[Optional('cardholder_street_address')]
    public ?string $cardholderStreetAddress;

    /**
     * `new CardValidationCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardValidationCreateParams::with(
     *   accountID: ...,
     *   cardTokenID: ...,
     *   merchantCategoryCode: ...,
     *   merchantCityName: ...,
     *   merchantName: ...,
     *   merchantPostalCode: ...,
     *   merchantState: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardValidationCreateParams)
     *   ->withAccountID(...)
     *   ->withCardTokenID(...)
     *   ->withMerchantCategoryCode(...)
     *   ->withMerchantCityName(...)
     *   ->withMerchantName(...)
     *   ->withMerchantPostalCode(...)
     *   ->withMerchantState(...)
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
     */
    public static function with(
        string $accountID,
        string $cardTokenID,
        string $merchantCategoryCode,
        string $merchantCityName,
        string $merchantName,
        string $merchantPostalCode,
        string $merchantState,
        ?string $cardholderFirstName = null,
        ?string $cardholderLastName = null,
        ?string $cardholderMiddleName = null,
        ?string $cardholderPostalCode = null,
        ?string $cardholderStreetAddress = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['cardTokenID'] = $cardTokenID;
        $self['merchantCategoryCode'] = $merchantCategoryCode;
        $self['merchantCityName'] = $merchantCityName;
        $self['merchantName'] = $merchantName;
        $self['merchantPostalCode'] = $merchantPostalCode;
        $self['merchantState'] = $merchantState;

        null !== $cardholderFirstName && $self['cardholderFirstName'] = $cardholderFirstName;
        null !== $cardholderLastName && $self['cardholderLastName'] = $cardholderLastName;
        null !== $cardholderMiddleName && $self['cardholderMiddleName'] = $cardholderMiddleName;
        null !== $cardholderPostalCode && $self['cardholderPostalCode'] = $cardholderPostalCode;
        null !== $cardholderStreetAddress && $self['cardholderStreetAddress'] = $cardholderStreetAddress;

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
     * The Increase identifier for the Card Token that represents the card number you're validating.
     */
    public function withCardTokenID(string $cardTokenID): self
    {
        $self = clone $this;
        $self['cardTokenID'] = $cardTokenID;

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
     * The cardholder's first name.
     */
    public function withCardholderFirstName(string $cardholderFirstName): self
    {
        $self = clone $this;
        $self['cardholderFirstName'] = $cardholderFirstName;

        return $self;
    }

    /**
     * The cardholder's last name.
     */
    public function withCardholderLastName(string $cardholderLastName): self
    {
        $self = clone $this;
        $self['cardholderLastName'] = $cardholderLastName;

        return $self;
    }

    /**
     * The cardholder's middle name.
     */
    public function withCardholderMiddleName(string $cardholderMiddleName): self
    {
        $self = clone $this;
        $self['cardholderMiddleName'] = $cardholderMiddleName;

        return $self;
    }

    /**
     * The postal code of the cardholder's address.
     */
    public function withCardholderPostalCode(string $cardholderPostalCode): self
    {
        $self = clone $this;
        $self['cardholderPostalCode'] = $cardholderPostalCode;

        return $self;
    }

    /**
     * The cardholder's street address.
     */
    public function withCardholderStreetAddress(
        string $cardholderStreetAddress
    ): self {
        $self = clone $this;
        $self['cardholderStreetAddress'] = $cardholderStreetAddress;

        return $self;
    }
}

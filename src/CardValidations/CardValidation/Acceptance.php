<?php

declare(strict_types=1);

namespace Increase\CardValidations\CardValidation;

use Increase\CardValidations\CardValidation\Acceptance\CardholderFirstNameResult;
use Increase\CardValidations\CardValidation\Acceptance\CardholderFullNameResult;
use Increase\CardValidations\CardValidation\Acceptance\CardholderLastNameResult;
use Increase\CardValidations\CardValidation\Acceptance\CardholderMiddleNameResult;
use Increase\CardValidations\CardValidation\Acceptance\CardholderPostalCodeResult;
use Increase\CardValidations\CardValidation\Acceptance\CardholderStreetAddressResult;
use Increase\CardValidations\CardValidation\Acceptance\CardVerificationValue2Result;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the validation is accepted by the recipient bank, this will contain supplemental details.
 *
 * @phpstan-type AcceptanceShape = array{
 *   acceptedAt: \DateTimeInterface,
 *   authorizationIdentificationResponse: string,
 *   cardVerificationValue2Result: null|CardVerificationValue2Result|value-of<CardVerificationValue2Result>,
 *   cardholderFirstNameResult: null|CardholderFirstNameResult|value-of<CardholderFirstNameResult>,
 *   cardholderFullNameResult: null|CardholderFullNameResult|value-of<CardholderFullNameResult>,
 *   cardholderLastNameResult: null|CardholderLastNameResult|value-of<CardholderLastNameResult>,
 *   cardholderMiddleNameResult: null|CardholderMiddleNameResult|value-of<CardholderMiddleNameResult>,
 *   cardholderPostalCodeResult: null|CardholderPostalCodeResult|value-of<CardholderPostalCodeResult>,
 *   cardholderStreetAddressResult: null|CardholderStreetAddressResult|value-of<CardholderStreetAddressResult>,
 *   networkTransactionIdentifier: string|null,
 * }
 */
final class Acceptance implements BaseModel
{
    /** @use SdkModel<AcceptanceShape> */
    use SdkModel;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the validation was accepted by the issuing bank.
     */
    #[Required('accepted_at')]
    public \DateTimeInterface $acceptedAt;

    /**
     * The authorization identification response from the issuing bank.
     */
    #[Required('authorization_identification_response')]
    public string $authorizationIdentificationResponse;

    /**
     * The result of the Card Verification Value 2 match.
     *
     * @var value-of<CardVerificationValue2Result>|null $cardVerificationValue2Result
     */
    #[Required(
        'card_verification_value2_result',
        enum: CardVerificationValue2Result::class
    )]
    public ?string $cardVerificationValue2Result;

    /**
     * The result of the cardholder first name match.
     *
     * @var value-of<CardholderFirstNameResult>|null $cardholderFirstNameResult
     */
    #[Required(
        'cardholder_first_name_result',
        enum: CardholderFirstNameResult::class
    )]
    public ?string $cardholderFirstNameResult;

    /**
     * The result of the cardholder full name match.
     *
     * @var value-of<CardholderFullNameResult>|null $cardholderFullNameResult
     */
    #[Required(
        'cardholder_full_name_result',
        enum: CardholderFullNameResult::class
    )]
    public ?string $cardholderFullNameResult;

    /**
     * The result of the cardholder last name match.
     *
     * @var value-of<CardholderLastNameResult>|null $cardholderLastNameResult
     */
    #[Required(
        'cardholder_last_name_result',
        enum: CardholderLastNameResult::class
    )]
    public ?string $cardholderLastNameResult;

    /**
     * The result of the cardholder middle name match.
     *
     * @var value-of<CardholderMiddleNameResult>|null $cardholderMiddleNameResult
     */
    #[Required(
        'cardholder_middle_name_result',
        enum: CardholderMiddleNameResult::class
    )]
    public ?string $cardholderMiddleNameResult;

    /**
     * The result of the cardholder postal code match.
     *
     * @var value-of<CardholderPostalCodeResult>|null $cardholderPostalCodeResult
     */
    #[Required(
        'cardholder_postal_code_result',
        enum: CardholderPostalCodeResult::class
    )]
    public ?string $cardholderPostalCodeResult;

    /**
     * The result of the cardholder street address match.
     *
     * @var value-of<CardholderStreetAddressResult>|null $cardholderStreetAddressResult
     */
    #[Required(
        'cardholder_street_address_result',
        enum: CardholderStreetAddressResult::class,
    )]
    public ?string $cardholderStreetAddressResult;

    /**
     * A unique identifier for the transaction on the card network.
     */
    #[Required('network_transaction_identifier')]
    public ?string $networkTransactionIdentifier;

    /**
     * `new Acceptance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Acceptance::with(
     *   acceptedAt: ...,
     *   authorizationIdentificationResponse: ...,
     *   cardVerificationValue2Result: ...,
     *   cardholderFirstNameResult: ...,
     *   cardholderFullNameResult: ...,
     *   cardholderLastNameResult: ...,
     *   cardholderMiddleNameResult: ...,
     *   cardholderPostalCodeResult: ...,
     *   cardholderStreetAddressResult: ...,
     *   networkTransactionIdentifier: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Acceptance)
     *   ->withAcceptedAt(...)
     *   ->withAuthorizationIdentificationResponse(...)
     *   ->withCardVerificationValue2Result(...)
     *   ->withCardholderFirstNameResult(...)
     *   ->withCardholderFullNameResult(...)
     *   ->withCardholderLastNameResult(...)
     *   ->withCardholderMiddleNameResult(...)
     *   ->withCardholderPostalCodeResult(...)
     *   ->withCardholderStreetAddressResult(...)
     *   ->withNetworkTransactionIdentifier(...)
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
     * @param CardVerificationValue2Result|value-of<CardVerificationValue2Result>|null $cardVerificationValue2Result
     * @param CardholderFirstNameResult|value-of<CardholderFirstNameResult>|null $cardholderFirstNameResult
     * @param CardholderFullNameResult|value-of<CardholderFullNameResult>|null $cardholderFullNameResult
     * @param CardholderLastNameResult|value-of<CardholderLastNameResult>|null $cardholderLastNameResult
     * @param CardholderMiddleNameResult|value-of<CardholderMiddleNameResult>|null $cardholderMiddleNameResult
     * @param CardholderPostalCodeResult|value-of<CardholderPostalCodeResult>|null $cardholderPostalCodeResult
     * @param CardholderStreetAddressResult|value-of<CardholderStreetAddressResult>|null $cardholderStreetAddressResult
     */
    public static function with(
        \DateTimeInterface $acceptedAt,
        string $authorizationIdentificationResponse,
        CardVerificationValue2Result|string|null $cardVerificationValue2Result,
        CardholderFirstNameResult|string|null $cardholderFirstNameResult,
        CardholderFullNameResult|string|null $cardholderFullNameResult,
        CardholderLastNameResult|string|null $cardholderLastNameResult,
        CardholderMiddleNameResult|string|null $cardholderMiddleNameResult,
        CardholderPostalCodeResult|string|null $cardholderPostalCodeResult,
        CardholderStreetAddressResult|string|null $cardholderStreetAddressResult,
        ?string $networkTransactionIdentifier,
    ): self {
        $self = new self;

        $self['acceptedAt'] = $acceptedAt;
        $self['authorizationIdentificationResponse'] = $authorizationIdentificationResponse;
        $self['cardVerificationValue2Result'] = $cardVerificationValue2Result;
        $self['cardholderFirstNameResult'] = $cardholderFirstNameResult;
        $self['cardholderFullNameResult'] = $cardholderFullNameResult;
        $self['cardholderLastNameResult'] = $cardholderLastNameResult;
        $self['cardholderMiddleNameResult'] = $cardholderMiddleNameResult;
        $self['cardholderPostalCodeResult'] = $cardholderPostalCodeResult;
        $self['cardholderStreetAddressResult'] = $cardholderStreetAddressResult;
        $self['networkTransactionIdentifier'] = $networkTransactionIdentifier;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the validation was accepted by the issuing bank.
     */
    public function withAcceptedAt(\DateTimeInterface $acceptedAt): self
    {
        $self = clone $this;
        $self['acceptedAt'] = $acceptedAt;

        return $self;
    }

    /**
     * The authorization identification response from the issuing bank.
     */
    public function withAuthorizationIdentificationResponse(
        string $authorizationIdentificationResponse
    ): self {
        $self = clone $this;
        $self['authorizationIdentificationResponse'] = $authorizationIdentificationResponse;

        return $self;
    }

    /**
     * The result of the Card Verification Value 2 match.
     *
     * @param CardVerificationValue2Result|value-of<CardVerificationValue2Result>|null $cardVerificationValue2Result
     */
    public function withCardVerificationValue2Result(
        CardVerificationValue2Result|string|null $cardVerificationValue2Result
    ): self {
        $self = clone $this;
        $self['cardVerificationValue2Result'] = $cardVerificationValue2Result;

        return $self;
    }

    /**
     * The result of the cardholder first name match.
     *
     * @param CardholderFirstNameResult|value-of<CardholderFirstNameResult>|null $cardholderFirstNameResult
     */
    public function withCardholderFirstNameResult(
        CardholderFirstNameResult|string|null $cardholderFirstNameResult
    ): self {
        $self = clone $this;
        $self['cardholderFirstNameResult'] = $cardholderFirstNameResult;

        return $self;
    }

    /**
     * The result of the cardholder full name match.
     *
     * @param CardholderFullNameResult|value-of<CardholderFullNameResult>|null $cardholderFullNameResult
     */
    public function withCardholderFullNameResult(
        CardholderFullNameResult|string|null $cardholderFullNameResult
    ): self {
        $self = clone $this;
        $self['cardholderFullNameResult'] = $cardholderFullNameResult;

        return $self;
    }

    /**
     * The result of the cardholder last name match.
     *
     * @param CardholderLastNameResult|value-of<CardholderLastNameResult>|null $cardholderLastNameResult
     */
    public function withCardholderLastNameResult(
        CardholderLastNameResult|string|null $cardholderLastNameResult
    ): self {
        $self = clone $this;
        $self['cardholderLastNameResult'] = $cardholderLastNameResult;

        return $self;
    }

    /**
     * The result of the cardholder middle name match.
     *
     * @param CardholderMiddleNameResult|value-of<CardholderMiddleNameResult>|null $cardholderMiddleNameResult
     */
    public function withCardholderMiddleNameResult(
        CardholderMiddleNameResult|string|null $cardholderMiddleNameResult
    ): self {
        $self = clone $this;
        $self['cardholderMiddleNameResult'] = $cardholderMiddleNameResult;

        return $self;
    }

    /**
     * The result of the cardholder postal code match.
     *
     * @param CardholderPostalCodeResult|value-of<CardholderPostalCodeResult>|null $cardholderPostalCodeResult
     */
    public function withCardholderPostalCodeResult(
        CardholderPostalCodeResult|string|null $cardholderPostalCodeResult
    ): self {
        $self = clone $this;
        $self['cardholderPostalCodeResult'] = $cardholderPostalCodeResult;

        return $self;
    }

    /**
     * The result of the cardholder street address match.
     *
     * @param CardholderStreetAddressResult|value-of<CardholderStreetAddressResult>|null $cardholderStreetAddressResult
     */
    public function withCardholderStreetAddressResult(
        CardholderStreetAddressResult|string|null $cardholderStreetAddressResult
    ): self {
        $self = clone $this;
        $self['cardholderStreetAddressResult'] = $cardholderStreetAddressResult;

        return $self;
    }

    /**
     * A unique identifier for the transaction on the card network.
     */
    public function withNetworkTransactionIdentifier(
        ?string $networkTransactionIdentifier
    ): self {
        $self = clone $this;
        $self['networkTransactionIdentifier'] = $networkTransactionIdentifier;

        return $self;
    }
}

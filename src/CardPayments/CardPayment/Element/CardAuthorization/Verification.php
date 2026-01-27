<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthorization;

use Increase\CardPayments\CardPayment\Element\CardAuthorization\Verification\CardholderAddress;
use Increase\CardPayments\CardPayment\Element\CardAuthorization\Verification\CardholderName;
use Increase\CardPayments\CardPayment\Element\CardAuthorization\Verification\CardVerificationCode;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Fields related to verification of cardholder-provided values.
 *
 * @phpstan-import-type CardVerificationCodeShape from \Increase\CardPayments\CardPayment\Element\CardAuthorization\Verification\CardVerificationCode
 * @phpstan-import-type CardholderAddressShape from \Increase\CardPayments\CardPayment\Element\CardAuthorization\Verification\CardholderAddress
 * @phpstan-import-type CardholderNameShape from \Increase\CardPayments\CardPayment\Element\CardAuthorization\Verification\CardholderName
 *
 * @phpstan-type VerificationShape = array{
 *   cardVerificationCode: CardVerificationCode|CardVerificationCodeShape,
 *   cardholderAddress: CardholderAddress|CardholderAddressShape,
 *   cardholderName: null|CardholderName|CardholderNameShape,
 * }
 */
final class Verification implements BaseModel
{
    /** @use SdkModel<VerificationShape> */
    use SdkModel;

    /**
     * Fields related to verification of the Card Verification Code, a 3-digit code on the back of the card.
     */
    #[Required('card_verification_code')]
    public CardVerificationCode $cardVerificationCode;

    /**
     * Cardholder address provided in the authorization request and the address on file we verified it against.
     */
    #[Required('cardholder_address')]
    public CardholderAddress $cardholderAddress;

    /**
     * Cardholder name provided in the authorization request.
     */
    #[Required('cardholder_name')]
    public ?CardholderName $cardholderName;

    /**
     * `new Verification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Verification::with(
     *   cardVerificationCode: ..., cardholderAddress: ..., cardholderName: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Verification)
     *   ->withCardVerificationCode(...)
     *   ->withCardholderAddress(...)
     *   ->withCardholderName(...)
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
     * @param CardVerificationCode|CardVerificationCodeShape $cardVerificationCode
     * @param CardholderAddress|CardholderAddressShape $cardholderAddress
     * @param CardholderName|CardholderNameShape|null $cardholderName
     */
    public static function with(
        CardVerificationCode|array $cardVerificationCode,
        CardholderAddress|array $cardholderAddress,
        CardholderName|array|null $cardholderName,
    ): self {
        $self = new self;

        $self['cardVerificationCode'] = $cardVerificationCode;
        $self['cardholderAddress'] = $cardholderAddress;
        $self['cardholderName'] = $cardholderName;

        return $self;
    }

    /**
     * Fields related to verification of the Card Verification Code, a 3-digit code on the back of the card.
     *
     * @param CardVerificationCode|CardVerificationCodeShape $cardVerificationCode
     */
    public function withCardVerificationCode(
        CardVerificationCode|array $cardVerificationCode
    ): self {
        $self = clone $this;
        $self['cardVerificationCode'] = $cardVerificationCode;

        return $self;
    }

    /**
     * Cardholder address provided in the authorization request and the address on file we verified it against.
     *
     * @param CardholderAddress|CardholderAddressShape $cardholderAddress
     */
    public function withCardholderAddress(
        CardholderAddress|array $cardholderAddress
    ): self {
        $self = clone $this;
        $self['cardholderAddress'] = $cardholderAddress;

        return $self;
    }

    /**
     * Cardholder name provided in the authorization request.
     *
     * @param CardholderName|CardholderNameShape|null $cardholderName
     */
    public function withCardholderName(
        CardholderName|array|null $cardholderName
    ): self {
        $self = clone $this;
        $self['cardholderName'] = $cardholderName;

        return $self;
    }
}

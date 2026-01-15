<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardFinancial;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardFinancial\Verification\CardholderAddress;
use Increase\Transactions\Transaction\Source\CardFinancial\Verification\CardVerificationCode;

/**
 * Fields related to verification of cardholder-provided values.
 *
 * @phpstan-import-type CardVerificationCodeShape from \Increase\Transactions\Transaction\Source\CardFinancial\Verification\CardVerificationCode
 * @phpstan-import-type CardholderAddressShape from \Increase\Transactions\Transaction\Source\CardFinancial\Verification\CardholderAddress
 *
 * @phpstan-type VerificationShape = array{
 *   cardVerificationCode: CardVerificationCode|CardVerificationCodeShape,
 *   cardholderAddress: CardholderAddress|CardholderAddressShape,
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
     * `new Verification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Verification::with(cardVerificationCode: ..., cardholderAddress: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Verification)->withCardVerificationCode(...)->withCardholderAddress(...)
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
     */
    public static function with(
        CardVerificationCode|array $cardVerificationCode,
        CardholderAddress|array $cardholderAddress,
    ): self {
        $self = new self;

        $self['cardVerificationCode'] = $cardVerificationCode;
        $self['cardholderAddress'] = $cardholderAddress;

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
}

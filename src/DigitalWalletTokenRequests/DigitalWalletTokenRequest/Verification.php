<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Verification\CardholderAddress;

/**
 * Fields related to verification of cardholder-provided values.
 *
 * @phpstan-import-type CardholderAddressShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Verification\CardholderAddress
 *
 * @phpstan-type VerificationShape = array{
 *   cardholderAddress: CardholderAddress|CardholderAddressShape
 * }
 */
final class Verification implements BaseModel
{
    /** @use SdkModel<VerificationShape> */
    use SdkModel;

    /**
     * Cardholder address provided in the provisioning request and the address on file we verified it against.
     */
    #[Required('cardholder_address')]
    public CardholderAddress $cardholderAddress;

    /**
     * `new Verification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Verification::with(cardholderAddress: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Verification)->withCardholderAddress(...)
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
     * @param CardholderAddress|CardholderAddressShape $cardholderAddress
     */
    public static function with(
        CardholderAddress|array $cardholderAddress
    ): self {
        $self = new self;

        $self['cardholderAddress'] = $cardholderAddress;

        return $self;
    }

    /**
     * Cardholder address provided in the provisioning request and the address on file we verified it against.
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

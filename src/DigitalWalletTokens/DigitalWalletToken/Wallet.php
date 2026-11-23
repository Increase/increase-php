<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens\DigitalWalletToken;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details about the digital wallet.
 *
 * @phpstan-type WalletShape = array{
 *   accountIdentifier: string|null, emailHash: string|null
 * }
 */
final class Wallet implements BaseModel
{
    /** @use SdkModel<WalletShape> */
    use SdkModel;

    /**
     * An identifier for the cardholder's account with the digital wallet.
     */
    #[Required('account_identifier')]
    public ?string $accountIdentifier;

    /**
     * A hash of the email address on the cardholder's digital wallet account.
     */
    #[Required('email_hash')]
    public ?string $emailHash;

    /**
     * `new Wallet()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Wallet::with(accountIdentifier: ..., emailHash: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Wallet)->withAccountIdentifier(...)->withEmailHash(...)
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
        ?string $accountIdentifier,
        ?string $emailHash
    ): self {
        $self = new self;

        $self['accountIdentifier'] = $accountIdentifier;
        $self['emailHash'] = $emailHash;

        return $self;
    }

    /**
     * An identifier for the cardholder's account with the digital wallet.
     */
    public function withAccountIdentifier(?string $accountIdentifier): self
    {
        $self = clone $this;
        $self['accountIdentifier'] = $accountIdentifier;

        return $self;
    }

    /**
     * A hash of the email address on the cardholder's digital wallet account.
     */
    public function withEmailHash(?string $emailHash): self
    {
        $self = clone $this;
        $self['emailHash'] = $emailHash;

        return $self;
    }
}

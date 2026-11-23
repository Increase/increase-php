<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details about the digital wallet.
 *
 * @phpstan-type WalletShape = array{
 *   accountEmailAgeDays: int|null,
 *   accountIdentifier: string|null,
 *   accountScore: int|null,
 *   deviceScore: int|null,
 *   emailHash: string|null,
 * }
 */
final class Wallet implements BaseModel
{
    /** @use SdkModel<WalletShape> */
    use SdkModel;

    /**
     * The number of days since the email address was added to the cardholder's digital wallet account, up to 999.
     */
    #[Required('account_email_age_days')]
    public ?int $accountEmailAgeDays;

    /**
     * An identifier for the cardholder's account with the digital wallet.
     */
    #[Required('account_identifier')]
    public ?string $accountIdentifier;

    /**
     * How much the digital wallet trusts the cardholder's account, from 1 to 5. A higher score indicates more trust.
     */
    #[Required('account_score')]
    public ?int $accountScore;

    /**
     * How much the digital wallet trusts the device the card is being added to, from 1 to 5. A higher score indicates more trust.
     */
    #[Required('device_score')]
    public ?int $deviceScore;

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
     * Wallet::with(
     *   accountEmailAgeDays: ...,
     *   accountIdentifier: ...,
     *   accountScore: ...,
     *   deviceScore: ...,
     *   emailHash: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Wallet)
     *   ->withAccountEmailAgeDays(...)
     *   ->withAccountIdentifier(...)
     *   ->withAccountScore(...)
     *   ->withDeviceScore(...)
     *   ->withEmailHash(...)
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
        ?int $accountEmailAgeDays,
        ?string $accountIdentifier,
        ?int $accountScore,
        ?int $deviceScore,
        ?string $emailHash,
    ): self {
        $self = new self;

        $self['accountEmailAgeDays'] = $accountEmailAgeDays;
        $self['accountIdentifier'] = $accountIdentifier;
        $self['accountScore'] = $accountScore;
        $self['deviceScore'] = $deviceScore;
        $self['emailHash'] = $emailHash;

        return $self;
    }

    /**
     * The number of days since the email address was added to the cardholder's digital wallet account, up to 999.
     */
    public function withAccountEmailAgeDays(?int $accountEmailAgeDays): self
    {
        $self = clone $this;
        $self['accountEmailAgeDays'] = $accountEmailAgeDays;

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
     * How much the digital wallet trusts the cardholder's account, from 1 to 5. A higher score indicates more trust.
     */
    public function withAccountScore(?int $accountScore): self
    {
        $self = clone $this;
        $self['accountScore'] = $accountScore;

        return $self;
    }

    /**
     * How much the digital wallet trusts the device the card is being added to, from 1 to 5. A higher score indicates more trust.
     */
    public function withDeviceScore(?int $deviceScore): self
    {
        $self = clone $this;
        $self['deviceScore'] = $deviceScore;

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

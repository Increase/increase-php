<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Cardholder;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Decision;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Device;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\DigitalWallet;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Network;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\TokenRequestorDetails;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Verification;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Visa;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Wallet;

/**
 * Fields related to a digital wallet token provisioning attempt.
 *
 * @phpstan-import-type CardholderShape from \Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Cardholder
 * @phpstan-import-type DeviceShape from \Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Device
 * @phpstan-import-type TokenRequestorDetailsShape from \Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\TokenRequestorDetails
 * @phpstan-import-type VerificationShape from \Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Verification
 * @phpstan-import-type VisaShape from \Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Visa
 * @phpstan-import-type WalletShape from \Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Wallet
 *
 * @phpstan-type DigitalWalletTokenShape = array{
 *   cardID: string,
 *   cardholder: Cardholder|CardholderShape,
 *   decision: null|Decision|value-of<Decision>,
 *   device: Device|DeviceShape,
 *   digitalWallet: DigitalWallet|value-of<DigitalWallet>,
 *   network: Network|value-of<Network>,
 *   tokenRequestorDetails: TokenRequestorDetails|TokenRequestorDetailsShape,
 *   verification: Verification|VerificationShape,
 *   visa: null|Visa|VisaShape,
 *   wallet: Wallet|WalletShape,
 * }
 */
final class DigitalWalletToken implements BaseModel
{
    /** @use SdkModel<DigitalWalletTokenShape> */
    use SdkModel;

    /**
     * The identifier of the Card that is being tokenized.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * The cardholder adding the card to the digital wallet.
     */
    #[Required]
    public Cardholder $cardholder;

    /**
     * Whether or not the provisioning request was approved. This will be null until the real time decision is responded to.
     *
     * @var value-of<Decision>|null $decision
     */
    #[Required(enum: Decision::class)]
    public ?string $decision;

    /**
     * Device that is being used to provision the digital wallet token.
     */
    #[Required]
    public Device $device;

    /**
     * The digital wallet app being used.
     *
     * @var value-of<DigitalWallet> $digitalWallet
     */
    #[Required('digital_wallet', enum: DigitalWallet::class)]
    public string $digitalWallet;

    /**
     * The card network the token is being provisioned on.
     *
     * @var value-of<Network> $network
     */
    #[Required(enum: Network::class)]
    public string $network;

    /**
     * The digital wallet or merchant that requested the token.
     */
    #[Required('token_requestor_details')]
    public TokenRequestorDetails $tokenRequestorDetails;

    /**
     * Fields related to verification of cardholder-provided values.
     */
    #[Required]
    public Verification $verification;

    /**
     * Risk scores provided by Visa for the provisioning request. This field will be present in the JSON response if and only if `network` is equal to `visa`.
     */
    #[Required]
    public ?Visa $visa;

    /**
     * Details about the digital wallet.
     */
    #[Required]
    public Wallet $wallet;

    /**
     * `new DigitalWalletToken()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalWalletToken::with(
     *   cardID: ...,
     *   cardholder: ...,
     *   decision: ...,
     *   device: ...,
     *   digitalWallet: ...,
     *   network: ...,
     *   tokenRequestorDetails: ...,
     *   verification: ...,
     *   visa: ...,
     *   wallet: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalWalletToken)
     *   ->withCardID(...)
     *   ->withCardholder(...)
     *   ->withDecision(...)
     *   ->withDevice(...)
     *   ->withDigitalWallet(...)
     *   ->withNetwork(...)
     *   ->withTokenRequestorDetails(...)
     *   ->withVerification(...)
     *   ->withVisa(...)
     *   ->withWallet(...)
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
     * @param Cardholder|CardholderShape $cardholder
     * @param Decision|value-of<Decision>|null $decision
     * @param Device|DeviceShape $device
     * @param DigitalWallet|value-of<DigitalWallet> $digitalWallet
     * @param Network|value-of<Network> $network
     * @param TokenRequestorDetails|TokenRequestorDetailsShape $tokenRequestorDetails
     * @param Verification|VerificationShape $verification
     * @param Visa|VisaShape|null $visa
     * @param Wallet|WalletShape $wallet
     */
    public static function with(
        string $cardID,
        Cardholder|array $cardholder,
        Decision|string|null $decision,
        Device|array $device,
        DigitalWallet|string $digitalWallet,
        Network|string $network,
        TokenRequestorDetails|array $tokenRequestorDetails,
        Verification|array $verification,
        Visa|array|null $visa,
        Wallet|array $wallet,
    ): self {
        $self = new self;

        $self['cardID'] = $cardID;
        $self['cardholder'] = $cardholder;
        $self['decision'] = $decision;
        $self['device'] = $device;
        $self['digitalWallet'] = $digitalWallet;
        $self['network'] = $network;
        $self['tokenRequestorDetails'] = $tokenRequestorDetails;
        $self['verification'] = $verification;
        $self['visa'] = $visa;
        $self['wallet'] = $wallet;

        return $self;
    }

    /**
     * The identifier of the Card that is being tokenized.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * The cardholder adding the card to the digital wallet.
     *
     * @param Cardholder|CardholderShape $cardholder
     */
    public function withCardholder(Cardholder|array $cardholder): self
    {
        $self = clone $this;
        $self['cardholder'] = $cardholder;

        return $self;
    }

    /**
     * Whether or not the provisioning request was approved. This will be null until the real time decision is responded to.
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
     * Device that is being used to provision the digital wallet token.
     *
     * @param Device|DeviceShape $device
     */
    public function withDevice(Device|array $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }

    /**
     * The digital wallet app being used.
     *
     * @param DigitalWallet|value-of<DigitalWallet> $digitalWallet
     */
    public function withDigitalWallet(DigitalWallet|string $digitalWallet): self
    {
        $self = clone $this;
        $self['digitalWallet'] = $digitalWallet;

        return $self;
    }

    /**
     * The card network the token is being provisioned on.
     *
     * @param Network|value-of<Network> $network
     */
    public function withNetwork(Network|string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

        return $self;
    }

    /**
     * The digital wallet or merchant that requested the token.
     *
     * @param TokenRequestorDetails|TokenRequestorDetailsShape $tokenRequestorDetails
     */
    public function withTokenRequestorDetails(
        TokenRequestorDetails|array $tokenRequestorDetails
    ): self {
        $self = clone $this;
        $self['tokenRequestorDetails'] = $tokenRequestorDetails;

        return $self;
    }

    /**
     * Fields related to verification of cardholder-provided values.
     *
     * @param Verification|VerificationShape $verification
     */
    public function withVerification(Verification|array $verification): self
    {
        $self = clone $this;
        $self['verification'] = $verification;

        return $self;
    }

    /**
     * Risk scores provided by Visa for the provisioning request. This field will be present in the JSON response if and only if `network` is equal to `visa`.
     *
     * @param Visa|VisaShape|null $visa
     */
    public function withVisa(Visa|array|null $visa): self
    {
        $self = clone $this;
        $self['visa'] = $visa;

        return $self;
    }

    /**
     * Details about the digital wallet.
     *
     * @param Wallet|WalletShape $wallet
     */
    public function withWallet(Wallet|array $wallet): self
    {
        $self = clone $this;
        $self['wallet'] = $wallet;

        return $self;
    }
}

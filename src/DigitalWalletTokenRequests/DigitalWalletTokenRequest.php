<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokenRequests;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Cardholder;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Declined;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Device;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Network;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Outcome;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Provisioned;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\TokenRequestor;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\TokenRequestorDetails;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Type;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Verification;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Visa;
use Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Wallet;

/**
 * A Digital Wallet Token Request is created each time a digital wallet app, such as Apple Pay or Google Pay, requests to tokenize a Card.
 *
 * @phpstan-import-type CardholderShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Cardholder
 * @phpstan-import-type DeclinedShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Declined
 * @phpstan-import-type DeviceShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Device
 * @phpstan-import-type ProvisionedShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Provisioned
 * @phpstan-import-type TokenRequestorDetailsShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\TokenRequestorDetails
 * @phpstan-import-type VerificationShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Verification
 * @phpstan-import-type VisaShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Visa
 * @phpstan-import-type WalletShape from \Increase\DigitalWalletTokenRequests\DigitalWalletTokenRequest\Wallet
 *
 * @phpstan-type DigitalWalletTokenRequestShape = array{
 *   id: string,
 *   cardID: string,
 *   cardholder: Cardholder|CardholderShape,
 *   createdAt: \DateTimeInterface,
 *   declined: null|Declined|DeclinedShape,
 *   device: Device|DeviceShape,
 *   network: Network|value-of<Network>,
 *   outcome: Outcome|value-of<Outcome>,
 *   provisioned: null|Provisioned|ProvisionedShape,
 *   tokenReferenceIdentifier: string,
 *   tokenRequestor: TokenRequestor|value-of<TokenRequestor>,
 *   tokenRequestorDetails: TokenRequestorDetails|TokenRequestorDetailsShape,
 *   type: Type|value-of<Type>,
 *   verification: Verification|VerificationShape,
 *   visa: null|Visa|VisaShape,
 *   wallet: Wallet|WalletShape,
 * }
 */
final class DigitalWalletTokenRequest implements BaseModel
{
    /** @use SdkModel<DigitalWalletTokenRequestShape> */
    use SdkModel;

    /**
     * The Digital Wallet Token Request identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier of the Card the tokenization was requested for.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * The cardholder adding the card to the digital wallet.
     */
    #[Required]
    public Cardholder $cardholder;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Digital Wallet Token Request was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Details of the decline. Present if and only if `outcome` is `declined`.
     */
    #[Required]
    public ?Declined $declined;

    /**
     * The device that requested the tokenization.
     */
    #[Required]
    public Device $device;

    /**
     * The card network the token is being provisioned on.
     *
     * @var value-of<Network> $network
     */
    #[Required(enum: Network::class)]
    public string $network;

    /**
     * The outcome of the tokenization request.
     *
     * @var value-of<Outcome> $outcome
     */
    #[Required(enum: Outcome::class)]
    public string $outcome;

    /**
     * Details of the provisioned Digital Wallet Token. Present if and only if `outcome` is `provisioned`.
     */
    #[Required]
    public ?Provisioned $provisioned;

    /**
     * The reference identifier assigned by the card network to the token.
     */
    #[Required('token_reference_identifier')]
    public string $tokenReferenceIdentifier;

    /**
     * The digital wallet app being used.
     *
     * @var value-of<TokenRequestor> $tokenRequestor
     */
    #[Required('token_requestor', enum: TokenRequestor::class)]
    public string $tokenRequestor;

    /**
     * The digital wallet or merchant that requested the token.
     */
    #[Required('token_requestor_details')]
    public TokenRequestorDetails $tokenRequestorDetails;

    /**
     * A constant representing the object's type. For this resource it will always be `digital_wallet_token_request`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

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
     * `new DigitalWalletTokenRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalWalletTokenRequest::with(
     *   id: ...,
     *   cardID: ...,
     *   cardholder: ...,
     *   createdAt: ...,
     *   declined: ...,
     *   device: ...,
     *   network: ...,
     *   outcome: ...,
     *   provisioned: ...,
     *   tokenReferenceIdentifier: ...,
     *   tokenRequestor: ...,
     *   tokenRequestorDetails: ...,
     *   type: ...,
     *   verification: ...,
     *   visa: ...,
     *   wallet: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalWalletTokenRequest)
     *   ->withID(...)
     *   ->withCardID(...)
     *   ->withCardholder(...)
     *   ->withCreatedAt(...)
     *   ->withDeclined(...)
     *   ->withDevice(...)
     *   ->withNetwork(...)
     *   ->withOutcome(...)
     *   ->withProvisioned(...)
     *   ->withTokenReferenceIdentifier(...)
     *   ->withTokenRequestor(...)
     *   ->withTokenRequestorDetails(...)
     *   ->withType(...)
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
     * @param Declined|DeclinedShape|null $declined
     * @param Device|DeviceShape $device
     * @param Network|value-of<Network> $network
     * @param Outcome|value-of<Outcome> $outcome
     * @param Provisioned|ProvisionedShape|null $provisioned
     * @param TokenRequestor|value-of<TokenRequestor> $tokenRequestor
     * @param TokenRequestorDetails|TokenRequestorDetailsShape $tokenRequestorDetails
     * @param Type|value-of<Type> $type
     * @param Verification|VerificationShape $verification
     * @param Visa|VisaShape|null $visa
     * @param Wallet|WalletShape $wallet
     */
    public static function with(
        string $id,
        string $cardID,
        Cardholder|array $cardholder,
        \DateTimeInterface $createdAt,
        Declined|array|null $declined,
        Device|array $device,
        Network|string $network,
        Outcome|string $outcome,
        Provisioned|array|null $provisioned,
        string $tokenReferenceIdentifier,
        TokenRequestor|string $tokenRequestor,
        TokenRequestorDetails|array $tokenRequestorDetails,
        Type|string $type,
        Verification|array $verification,
        Visa|array|null $visa,
        Wallet|array $wallet,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['cardID'] = $cardID;
        $self['cardholder'] = $cardholder;
        $self['createdAt'] = $createdAt;
        $self['declined'] = $declined;
        $self['device'] = $device;
        $self['network'] = $network;
        $self['outcome'] = $outcome;
        $self['provisioned'] = $provisioned;
        $self['tokenReferenceIdentifier'] = $tokenReferenceIdentifier;
        $self['tokenRequestor'] = $tokenRequestor;
        $self['tokenRequestorDetails'] = $tokenRequestorDetails;
        $self['type'] = $type;
        $self['verification'] = $verification;
        $self['visa'] = $visa;
        $self['wallet'] = $wallet;

        return $self;
    }

    /**
     * The Digital Wallet Token Request identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier of the Card the tokenization was requested for.
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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Digital Wallet Token Request was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Details of the decline. Present if and only if `outcome` is `declined`.
     *
     * @param Declined|DeclinedShape|null $declined
     */
    public function withDeclined(Declined|array|null $declined): self
    {
        $self = clone $this;
        $self['declined'] = $declined;

        return $self;
    }

    /**
     * The device that requested the tokenization.
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
     * The outcome of the tokenization request.
     *
     * @param Outcome|value-of<Outcome> $outcome
     */
    public function withOutcome(Outcome|string $outcome): self
    {
        $self = clone $this;
        $self['outcome'] = $outcome;

        return $self;
    }

    /**
     * Details of the provisioned Digital Wallet Token. Present if and only if `outcome` is `provisioned`.
     *
     * @param Provisioned|ProvisionedShape|null $provisioned
     */
    public function withProvisioned(Provisioned|array|null $provisioned): self
    {
        $self = clone $this;
        $self['provisioned'] = $provisioned;

        return $self;
    }

    /**
     * The reference identifier assigned by the card network to the token.
     */
    public function withTokenReferenceIdentifier(
        string $tokenReferenceIdentifier
    ): self {
        $self = clone $this;
        $self['tokenReferenceIdentifier'] = $tokenReferenceIdentifier;

        return $self;
    }

    /**
     * The digital wallet app being used.
     *
     * @param TokenRequestor|value-of<TokenRequestor> $tokenRequestor
     */
    public function withTokenRequestor(
        TokenRequestor|string $tokenRequestor
    ): self {
        $self = clone $this;
        $self['tokenRequestor'] = $tokenRequestor;

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
     * A constant representing the object's type. For this resource it will always be `digital_wallet_token_request`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

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

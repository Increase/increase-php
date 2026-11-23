<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalWalletTokens\DigitalWalletToken\Cardholder;
use Increase\DigitalWalletTokens\DigitalWalletToken\Device;
use Increase\DigitalWalletTokens\DigitalWalletToken\DynamicPrimaryAccountNumber;
use Increase\DigitalWalletTokens\DigitalWalletToken\Status;
use Increase\DigitalWalletTokens\DigitalWalletToken\TokenRequestor;
use Increase\DigitalWalletTokens\DigitalWalletToken\TokenRequestorDetails;
use Increase\DigitalWalletTokens\DigitalWalletToken\Type;
use Increase\DigitalWalletTokens\DigitalWalletToken\Update;
use Increase\DigitalWalletTokens\DigitalWalletToken\Wallet;

/**
 * A Digital Wallet Token is created when a user adds a Card to their Apple Pay or Google Pay app. The Digital Wallet Token can be used for purchases just like a Card.
 *
 * @phpstan-import-type CardholderShape from \Increase\DigitalWalletTokens\DigitalWalletToken\Cardholder
 * @phpstan-import-type DeviceShape from \Increase\DigitalWalletTokens\DigitalWalletToken\Device
 * @phpstan-import-type DynamicPrimaryAccountNumberShape from \Increase\DigitalWalletTokens\DigitalWalletToken\DynamicPrimaryAccountNumber
 * @phpstan-import-type TokenRequestorDetailsShape from \Increase\DigitalWalletTokens\DigitalWalletToken\TokenRequestorDetails
 * @phpstan-import-type UpdateShape from \Increase\DigitalWalletTokens\DigitalWalletToken\Update
 * @phpstan-import-type WalletShape from \Increase\DigitalWalletTokens\DigitalWalletToken\Wallet
 *
 * @phpstan-type DigitalWalletTokenShape = array{
 *   id: string,
 *   accountID: string,
 *   cardID: string,
 *   cardholder: Cardholder|CardholderShape,
 *   createdAt: \DateTimeInterface,
 *   device: Device|DeviceShape,
 *   dynamicPrimaryAccountNumber: null|DynamicPrimaryAccountNumber|DynamicPrimaryAccountNumberShape,
 *   primaryAccountNumberReferenceIdentifier: string,
 *   status: Status|value-of<Status>,
 *   tokenReferenceIdentifier: string,
 *   tokenRequestor: TokenRequestor|value-of<TokenRequestor>,
 *   tokenRequestorDetails: TokenRequestorDetails|TokenRequestorDetailsShape,
 *   type: Type|value-of<Type>,
 *   updates: list<Update|UpdateShape>,
 *   wallet: Wallet|WalletShape,
 * }
 */
final class DigitalWalletToken implements BaseModel
{
    /** @use SdkModel<DigitalWalletTokenShape> */
    use SdkModel;

    /**
     * The Digital Wallet Token identifier.
     */
    #[Required]
    public string $id;

    /**
     * The identifier for the Account this Digital Wallet Token belongs to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The identifier for the Card this Digital Wallet Token belongs to.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * The cardholder information given when the Digital Wallet Token was created.
     */
    #[Required]
    public Cardholder $cardholder;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Digital Wallet Token was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The device that was used to create the Digital Wallet Token.
     */
    #[Required]
    public Device $device;

    /**
     * The redacted Dynamic Primary Account Number.
     */
    #[Required('dynamic_primary_account_number')]
    public ?DynamicPrimaryAccountNumber $dynamicPrimaryAccountNumber;

    /**
     * The reference identifier assigned by the card network to the underlying Card.
     */
    #[Required('primary_account_number_reference_identifier')]
    public string $primaryAccountNumberReferenceIdentifier;

    /**
     * This indicates if payments can be made with the Digital Wallet Token.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

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
     * A constant representing the object's type. For this resource it will always be `digital_wallet_token`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Updates to the Digital Wallet Token.
     *
     * @var list<Update> $updates
     */
    #[Required(list: Update::class)]
    public array $updates;

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
     *   id: ...,
     *   accountID: ...,
     *   cardID: ...,
     *   cardholder: ...,
     *   createdAt: ...,
     *   device: ...,
     *   dynamicPrimaryAccountNumber: ...,
     *   primaryAccountNumberReferenceIdentifier: ...,
     *   status: ...,
     *   tokenReferenceIdentifier: ...,
     *   tokenRequestor: ...,
     *   tokenRequestorDetails: ...,
     *   type: ...,
     *   updates: ...,
     *   wallet: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalWalletToken)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withCardID(...)
     *   ->withCardholder(...)
     *   ->withCreatedAt(...)
     *   ->withDevice(...)
     *   ->withDynamicPrimaryAccountNumber(...)
     *   ->withPrimaryAccountNumberReferenceIdentifier(...)
     *   ->withStatus(...)
     *   ->withTokenReferenceIdentifier(...)
     *   ->withTokenRequestor(...)
     *   ->withTokenRequestorDetails(...)
     *   ->withType(...)
     *   ->withUpdates(...)
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
     * @param Device|DeviceShape $device
     * @param DynamicPrimaryAccountNumber|DynamicPrimaryAccountNumberShape|null $dynamicPrimaryAccountNumber
     * @param Status|value-of<Status> $status
     * @param TokenRequestor|value-of<TokenRequestor> $tokenRequestor
     * @param TokenRequestorDetails|TokenRequestorDetailsShape $tokenRequestorDetails
     * @param Type|value-of<Type> $type
     * @param list<Update|UpdateShape> $updates
     * @param Wallet|WalletShape $wallet
     */
    public static function with(
        string $id,
        string $accountID,
        string $cardID,
        Cardholder|array $cardholder,
        \DateTimeInterface $createdAt,
        Device|array $device,
        DynamicPrimaryAccountNumber|array|null $dynamicPrimaryAccountNumber,
        string $primaryAccountNumberReferenceIdentifier,
        Status|string $status,
        string $tokenReferenceIdentifier,
        TokenRequestor|string $tokenRequestor,
        TokenRequestorDetails|array $tokenRequestorDetails,
        Type|string $type,
        array $updates,
        Wallet|array $wallet,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['cardID'] = $cardID;
        $self['cardholder'] = $cardholder;
        $self['createdAt'] = $createdAt;
        $self['device'] = $device;
        $self['dynamicPrimaryAccountNumber'] = $dynamicPrimaryAccountNumber;
        $self['primaryAccountNumberReferenceIdentifier'] = $primaryAccountNumberReferenceIdentifier;
        $self['status'] = $status;
        $self['tokenReferenceIdentifier'] = $tokenReferenceIdentifier;
        $self['tokenRequestor'] = $tokenRequestor;
        $self['tokenRequestorDetails'] = $tokenRequestorDetails;
        $self['type'] = $type;
        $self['updates'] = $updates;
        $self['wallet'] = $wallet;

        return $self;
    }

    /**
     * The Digital Wallet Token identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The identifier for the Account this Digital Wallet Token belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The identifier for the Card this Digital Wallet Token belongs to.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * The cardholder information given when the Digital Wallet Token was created.
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
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Digital Wallet Token was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The device that was used to create the Digital Wallet Token.
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
     * The redacted Dynamic Primary Account Number.
     *
     * @param DynamicPrimaryAccountNumber|DynamicPrimaryAccountNumberShape|null $dynamicPrimaryAccountNumber
     */
    public function withDynamicPrimaryAccountNumber(
        DynamicPrimaryAccountNumber|array|null $dynamicPrimaryAccountNumber
    ): self {
        $self = clone $this;
        $self['dynamicPrimaryAccountNumber'] = $dynamicPrimaryAccountNumber;

        return $self;
    }

    /**
     * The reference identifier assigned by the card network to the underlying Card.
     */
    public function withPrimaryAccountNumberReferenceIdentifier(
        string $primaryAccountNumberReferenceIdentifier
    ): self {
        $self = clone $this;
        $self['primaryAccountNumberReferenceIdentifier'] = $primaryAccountNumberReferenceIdentifier;

        return $self;
    }

    /**
     * This indicates if payments can be made with the Digital Wallet Token.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

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
     * A constant representing the object's type. For this resource it will always be `digital_wallet_token`.
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
     * Updates to the Digital Wallet Token.
     *
     * @param list<Update|UpdateShape> $updates
     */
    public function withUpdates(array $updates): self
    {
        $self = clone $this;
        $self['updates'] = $updates;

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

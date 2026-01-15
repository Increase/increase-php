<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalWalletTokens\DigitalWalletToken\Cardholder;
use Increase\DigitalWalletTokens\DigitalWalletToken\Device;
use Increase\DigitalWalletTokens\DigitalWalletToken\Status;
use Increase\DigitalWalletTokens\DigitalWalletToken\TokenRequestor;
use Increase\DigitalWalletTokens\DigitalWalletToken\Type;
use Increase\DigitalWalletTokens\DigitalWalletToken\Update;

/**
 * A Digital Wallet Token is created when a user adds a Card to their Apple Pay or Google Pay app. The Digital Wallet Token can be used for purchases just like a Card.
 *
 * @phpstan-import-type CardholderShape from \Increase\DigitalWalletTokens\DigitalWalletToken\Cardholder
 * @phpstan-import-type DeviceShape from \Increase\DigitalWalletTokens\DigitalWalletToken\Device
 * @phpstan-import-type UpdateShape from \Increase\DigitalWalletTokens\DigitalWalletToken\Update
 *
 * @phpstan-type DigitalWalletTokenShape = array{
 *   id: string,
 *   cardID: string,
 *   cardholder: Cardholder|CardholderShape,
 *   createdAt: \DateTimeInterface,
 *   device: Device|DeviceShape,
 *   status: Status|value-of<Status>,
 *   tokenRequestor: TokenRequestor|value-of<TokenRequestor>,
 *   type: Type|value-of<Type>,
 *   updates: list<Update|UpdateShape>,
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
     * This indicates if payments can be made with the Digital Wallet Token.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The digital wallet app being used.
     *
     * @var value-of<TokenRequestor> $tokenRequestor
     */
    #[Required('token_requestor', enum: TokenRequestor::class)]
    public string $tokenRequestor;

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
     * `new DigitalWalletToken()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalWalletToken::with(
     *   id: ...,
     *   cardID: ...,
     *   cardholder: ...,
     *   createdAt: ...,
     *   device: ...,
     *   status: ...,
     *   tokenRequestor: ...,
     *   type: ...,
     *   updates: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalWalletToken)
     *   ->withID(...)
     *   ->withCardID(...)
     *   ->withCardholder(...)
     *   ->withCreatedAt(...)
     *   ->withDevice(...)
     *   ->withStatus(...)
     *   ->withTokenRequestor(...)
     *   ->withType(...)
     *   ->withUpdates(...)
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
     * @param Status|value-of<Status> $status
     * @param TokenRequestor|value-of<TokenRequestor> $tokenRequestor
     * @param Type|value-of<Type> $type
     * @param list<Update|UpdateShape> $updates
     */
    public static function with(
        string $id,
        string $cardID,
        Cardholder|array $cardholder,
        \DateTimeInterface $createdAt,
        Device|array $device,
        Status|string $status,
        TokenRequestor|string $tokenRequestor,
        Type|string $type,
        array $updates,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['cardID'] = $cardID;
        $self['cardholder'] = $cardholder;
        $self['createdAt'] = $createdAt;
        $self['device'] = $device;
        $self['status'] = $status;
        $self['tokenRequestor'] = $tokenRequestor;
        $self['type'] = $type;
        $self['updates'] = $updates;

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
}

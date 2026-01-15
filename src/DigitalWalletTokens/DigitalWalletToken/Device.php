<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens\DigitalWalletToken;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalWalletTokens\DigitalWalletToken\Device\DeviceType;

/**
 * The device that was used to create the Digital Wallet Token.
 *
 * @phpstan-type DeviceShape = array{
 *   deviceType: null|DeviceType|value-of<DeviceType>,
 *   identifier: string|null,
 *   ipAddress: string|null,
 *   name: string|null,
 * }
 */
final class Device implements BaseModel
{
    /** @use SdkModel<DeviceShape> */
    use SdkModel;

    /**
     * Device type.
     *
     * @var value-of<DeviceType>|null $deviceType
     */
    #[Required('device_type', enum: DeviceType::class)]
    public ?string $deviceType;

    /**
     * ID assigned to the device by the digital wallet provider.
     */
    #[Required]
    public ?string $identifier;

    /**
     * IP address of the device.
     */
    #[Required('ip_address')]
    public ?string $ipAddress;

    /**
     * Name of the device, for example "My Work Phone".
     */
    #[Required]
    public ?string $name;

    /**
     * `new Device()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Device::with(deviceType: ..., identifier: ..., ipAddress: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Device)
     *   ->withDeviceType(...)
     *   ->withIdentifier(...)
     *   ->withIPAddress(...)
     *   ->withName(...)
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
     * @param DeviceType|value-of<DeviceType>|null $deviceType
     */
    public static function with(
        DeviceType|string|null $deviceType,
        ?string $identifier,
        ?string $ipAddress,
        ?string $name,
    ): self {
        $self = new self;

        $self['deviceType'] = $deviceType;
        $self['identifier'] = $identifier;
        $self['ipAddress'] = $ipAddress;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Device type.
     *
     * @param DeviceType|value-of<DeviceType>|null $deviceType
     */
    public function withDeviceType(DeviceType|string|null $deviceType): self
    {
        $self = clone $this;
        $self['deviceType'] = $deviceType;

        return $self;
    }

    /**
     * ID assigned to the device by the digital wallet provider.
     */
    public function withIdentifier(?string $identifier): self
    {
        $self = clone $this;
        $self['identifier'] = $identifier;

        return $self;
    }

    /**
     * IP address of the device.
     */
    public function withIPAddress(?string $ipAddress): self
    {
        $self = clone $this;
        $self['ipAddress'] = $ipAddress;

        return $self;
    }

    /**
     * Name of the device, for example "My Work Phone".
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}

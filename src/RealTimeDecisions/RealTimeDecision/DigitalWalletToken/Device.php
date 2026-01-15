<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Device that is being used to provision the digital wallet token.
 *
 * @phpstan-type DeviceShape = array{identifier: string|null}
 */
final class Device implements BaseModel
{
    /** @use SdkModel<DeviceShape> */
    use SdkModel;

    /**
     * ID assigned to the device by the digital wallet provider.
     */
    #[Required]
    public ?string $identifier;

    /**
     * `new Device()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Device::with(identifier: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Device)->withIdentifier(...)
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
    public static function with(?string $identifier): self
    {
        $self = new self;

        $self['identifier'] = $identifier;

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
}

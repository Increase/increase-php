<?php

declare(strict_types=1);

namespace Increase\LockboxAddresses;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Lockbox Address.
 *
 * @see Increase\Services\LockboxAddressesService::create()
 *
 * @phpstan-type LockboxAddressCreateParamsShape = array{description?: string|null}
 */
final class LockboxAddressCreateParams implements BaseModel
{
    /** @use SdkModel<LockboxAddressCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The description you choose for the Lockbox Address.
     */
    #[Optional]
    public ?string $description;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $description = null): self
    {
        $self = new self;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * The description you choose for the Lockbox Address.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}

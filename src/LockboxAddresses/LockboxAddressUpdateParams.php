<?php

declare(strict_types=1);

namespace Increase\LockboxAddresses;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\LockboxAddresses\LockboxAddressUpdateParams\Status;

/**
 * Update a Lockbox Address.
 *
 * @see Increase\Services\LockboxAddressesService::update()
 *
 * @phpstan-type LockboxAddressUpdateParamsShape = array{
 *   description?: string|null, status?: null|Status|value-of<Status>
 * }
 */
final class LockboxAddressUpdateParams implements BaseModel
{
    /** @use SdkModel<LockboxAddressUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The description you choose for the Lockbox Address.
     */
    #[Optional]
    public ?string $description;

    /**
     * The status of the Lockbox Address.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $description = null,
        Status|string|null $status = null
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $status && $self['status'] = $status;

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

    /**
     * The status of the Lockbox Address.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}

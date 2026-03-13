<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Validation\Issue;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Validation\Issue\EntityAddress\Reason;

/**
 * Details when the issue is with the entity's address.
 *
 * @phpstan-type EntityAddressShape = array{reason: Reason|value-of<Reason>}
 */
final class EntityAddress implements BaseModel
{
    /** @use SdkModel<EntityAddressShape> */
    use SdkModel;

    /**
     * The reason the address is invalid.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new EntityAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityAddress::with(reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityAddress)->withReason(...)
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
     * @param Reason|value-of<Reason> $reason
     */
    public static function with(Reason|string $reason): self
    {
        $self = new self;

        $self['reason'] = $reason;

        return $self;
    }

    /**
     * The reason the address is invalid.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}

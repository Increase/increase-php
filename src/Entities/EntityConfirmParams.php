<?php

declare(strict_types=1);

namespace Increase\Entities;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Depending on your program, you may be required to re-confirm an Entity's details on a recurring basis. After making any required updates, call this endpoint to record that your user confirmed their details.
 *
 * @see Increase\Services\EntitiesService::confirm()
 *
 * @phpstan-type EntityConfirmParamsShape = array{
 *   confirmedAt?: \DateTimeInterface|null
 * }
 */
final class EntityConfirmParams implements BaseModel
{
    /** @use SdkModel<EntityConfirmParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * When your user confirmed the Entity's details. If not provided, the current time will be used.
     */
    #[Optional('confirmed_at')]
    public ?\DateTimeInterface $confirmedAt;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?\DateTimeInterface $confirmedAt = null): self
    {
        $self = new self;

        null !== $confirmedAt && $self['confirmedAt'] = $confirmedAt;

        return $self;
    }

    /**
     * When your user confirmed the Entity's details. If not provided, the current time will be used.
     */
    public function withConfirmedAt(\DateTimeInterface $confirmedAt): self
    {
        $self = clone $this;
        $self['confirmedAt'] = $confirmedAt;

        return $self;
    }
}

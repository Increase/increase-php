<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Validation\Issue;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details when the issue is with the entity's identity verification.
 *
 * @phpstan-type EntityIdentityShape = array<string,mixed>
 */
final class EntityIdentity implements BaseModel
{
    /** @use SdkModel<EntityIdentityShape> */
    use SdkModel;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }
}

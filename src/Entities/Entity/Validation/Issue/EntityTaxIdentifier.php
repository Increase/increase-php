<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Validation\Issue;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details when the issue is with the entity's tax ID.
 *
 * @phpstan-type EntityTaxIdentifierShape = array<string,mixed>
 */
final class EntityTaxIdentifier implements BaseModel
{
    /** @use SdkModel<EntityTaxIdentifierShape> */
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

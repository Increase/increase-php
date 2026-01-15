<?php

declare(strict_types=1);

namespace Increase\Core\Conversion\Contracts;

use Increase\Core\Conversion\CoerceState;
use Increase\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}

<?php

declare(strict_types=1);

namespace Increase\Core\Conversion;

use Increase\Core\Conversion\Concerns\ArrayOf;
use Increase\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}

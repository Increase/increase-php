<?php

declare(strict_types=1);

namespace Increase\BookkeepingEntries\BookkeepingEntry;

/**
 * A constant representing the object's type. For this resource it will always be `bookkeeping_entry`.
 */
enum Type: string
{
    case BOOKKEEPING_ENTRY = 'bookkeeping_entry';
}

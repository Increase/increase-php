<?php

declare(strict_types=1);

namespace Increase\BookkeepingEntrySets\BookkeepingEntrySet;

/**
 * A constant representing the object's type. For this resource it will always be `bookkeeping_entry_set`.
 */
enum Type: string
{
    case BOOKKEEPING_ENTRY_SET = 'bookkeeping_entry_set';
}

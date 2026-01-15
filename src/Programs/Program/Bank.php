<?php

declare(strict_types=1);

namespace Increase\Programs\Program;

/**
 * The Bank the Program is with.
 */
enum Bank: string
{
    case CORE_BANK = 'core_bank';

    case FIRST_INTERNET_BANK = 'first_internet_bank';

    case GRASSHOPPER_BANK = 'grasshopper_bank';
}

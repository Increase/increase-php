<?php

declare(strict_types=1);

namespace Increase\Simulations\Programs\ProgramCreateParams;

/**
 * The bank for the program's accounts, defaults to First Internet Bank.
 */
enum Bank: string
{
    case CORE_BANK = 'core_bank';

    case FIRST_INTERNET_BANK = 'first_internet_bank';

    case GRASSHOPPER_BANK = 'grasshopper_bank';

    case TWIN_CITY_BANK = 'twin_city_bank';
}

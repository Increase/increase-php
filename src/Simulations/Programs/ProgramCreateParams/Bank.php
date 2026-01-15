<?php

declare(strict_types=1);

namespace Increase\Simulations\Programs\ProgramCreateParams;

/**
 * The bank for the program's accounts, defaults to First Internet Bank.
 */
enum Bank: string
{
    case BLUE_RIDGE_BANK = 'blue_ridge_bank';

    case CORE_BANK = 'core_bank';

    case FIRST_INTERNET_BANK = 'first_internet_bank';

    case GLOBAL_INNOVATIONS_BANK = 'global_innovations_bank';

    case GRASSHOPPER_BANK = 'grasshopper_bank';

    case TWIN_CITY_BANK = 'twin_city_bank';
}

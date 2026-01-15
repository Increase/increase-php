<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\GovernmentAuthority;

/**
 * The category of the government authority.
 */
enum Category: string
{
    case MUNICIPALITY = 'municipality';

    case STATE_AGENCY = 'state_agency';

    case STATE_GOVERNMENT = 'state_government';

    case FEDERAL_AGENCY = 'federal_agency';
}

<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Corporation\LegalIdentifier;

/**
 * The category of the legal identifier.
 */
enum Category: string
{
    case US_EMPLOYER_IDENTIFICATION_NUMBER = 'us_employer_identification_number';

    case OTHER = 'other';
}

<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\Corporation\LegalIdentifier;

/**
 * The category of the legal identifier. If not provided, the default is `us_employer_identification_number`.
 */
enum Category: string
{
    case US_EMPLOYER_IDENTIFICATION_NUMBER = 'us_employer_identification_number';

    case OTHER = 'other';
}
